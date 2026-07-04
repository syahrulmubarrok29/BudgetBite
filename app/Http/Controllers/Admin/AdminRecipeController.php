<?php

namespace App\Http\Controllers\Admin;

use App\Models\Recipe;
use App\Models\Ingredient;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AdminRecipeController extends Controller
{
    /**
     * GET /api/admin/recipes - Ambil semua resep
     */
    public function index(): JsonResponse
    {
        $recipes = Recipe::with(['category', 'ingredients' => function ($query) {
            $query->select('ingredients.id', 'ingredients.name', 'ingredients.unit', 'ingredients.price_per_unit')
                ->withPivot('quantity', 'total_price_for_this_recipe');
        }])->orderBy('created_at', 'desc')->get();

        // Hitung total price untuk setiap resep
        $recipes = $recipes->map(function ($recipe) {
            $recipe->total_price = $recipe->ingredients->sum('pivot.total_price_for_this_recipe');
            return $recipe;
        });

        return response()->json([
            'success' => true,
            'data' => $recipes
        ], 200);
    }

    /**
     * GET /api/admin/recipes/{id} - Ambil satu resep
     */
    public function show(int $id): JsonResponse
    {
        $recipe = Recipe::with(['category', 'ingredients' => function ($query) {
            $query->withPivot('quantity', 'total_price_for_this_recipe');
        }])->find($id);

        if (!$recipe) {
            return response()->json([
                'success' => false,
                'message' => 'Resep tidak ditemukan'
            ], 404);
        }

        $recipe->total_price = $recipe->ingredients->sum('pivot.total_price_for_this_recipe');

        return response()->json([
            'success' => true,
            'data' => $recipe
        ], 200);
    }

    /**
     * POST /api/admin/recipes - Tambah resep baru dengan ingredients
     */
    public function store(Request $request): JsonResponse
    {
        // Decode manual ingredients_data dari FormData (karena via JS multipart)
        if ($request->has('ingredients_data')) {
            $decoded = json_decode($request->input('ingredients_data'), true);
            $request->merge(['ingredients' => $decoded]);
        }

        // Validasi data utama resep
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'category_id' => 'required|integer|exists:categories,id',
            'description' => 'nullable|string',
            'cooking_time' => 'nullable|integer|min:1',
            'portions' => 'nullable|integer|min:1',
            'instructions' => 'required|string',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
            'ingredients' => 'required|array|min:1',
            'ingredients.*.ingredient_id' => 'required|integer|exists:ingredients,id',
            'ingredients.*.quantity'      => 'required|numeric|min:0.01',
            'ingredients.*.required_qty'  => 'nullable|integer|min:1'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        // Validasi ingredients tidak duplikat
        $ingredientIds = array_column($request->ingredients, 'ingredient_id');
        if (count($ingredientIds) !== count(array_unique($ingredientIds))) {
            return response()->json([
                'success' => false,
                'message' => 'Ingredient tidak boleh duplikat'
            ], 422);
        }

        try {
            DB::beginTransaction();

            // Handle Image Upload
            $imagePath = null;
            if ($request->hasFile('image_file')) {
                $imagePath = '/storage/' . $request->file('image_file')->store('recipes', 'public');
            }

            // Buat resep baru
            $recipe = Recipe::create([
                'title' => $request->title,
                'category_id' => $request->category_id,
                'description' => $request->description,
                'cooking_time' => $request->cooking_time,
                'portions' => $request->portions,
                'instructions' => $request->instructions,
                'image_url' => $imagePath
            ]);

            // Attach ingredients ke pivot table (termasuk required_qty untuk DSS)
            $recipeIngredients = [];
            foreach ($request->ingredients as $item) {
                $ingredient   = Ingredient::find($item['ingredient_id']);
                $quantity     = (float) $item['quantity'];
                $requiredQty  = isset($item['required_qty']) ? (int) $item['required_qty'] : 100;
                $pricePerUnit = (float) $ingredient->price_per_unit;
                $totalPrice   = $quantity * $pricePerUnit;

                $recipeIngredients[$item['ingredient_id']] = [
                    'quantity'                    => $quantity,
                    'required_qty'                => $requiredQty,
                    'total_price_for_this_recipe' => $totalPrice,
                    'created_at'                  => now(),
                    'updated_at'                  => now()
                ];
            }

            $recipe->ingredients()->attach($recipeIngredients);

            // Load relasi untuk response
            $recipe->load(['category', 'ingredients' => function ($query) {
                $query->withPivot('quantity', 'required_qty', 'total_price_for_this_recipe');
            }]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Resep berhasil ditambahkan',
                'data' => $recipe
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan resep',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $recipe = Recipe::find($id);

        if (!$recipe) {
            return response()->json([
                'success' => false,
                'message' => 'Resep tidak ditemukan'
            ], 404);
        }

        // Decode manual ingredients_data dari FormData (karena via JS multipart)
        if ($request->has('ingredients_data')) {
            $decoded = json_decode($request->input('ingredients_data'), true);
            $request->merge(['ingredients' => $decoded]);
        }

        // Validasi data utama resep
        $validator = Validator::make($request->all(), [
            'title' => 'sometimes|string|max:255',
            'category_id' => 'sometimes|integer|exists:categories,id',
            'description' => 'nullable|string',
            'cooking_time' => 'nullable|integer|min:1',
            'portions' => 'nullable|integer|min:1',
            'instructions' => 'sometimes|string',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
            'ingredients' => 'sometimes|array|min:1',
            'ingredients.*.ingredient_id' => 'required_with:ingredients|integer|exists:ingredients,id',
            'ingredients.*.quantity'      => 'required_with:ingredients|numeric|min:0.01',
            'ingredients.*.required_qty'  => 'nullable|integer|min:1'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            DB::beginTransaction();

            // Handle Image Upload
            $imagePath = $recipe->image_url; // Keep old image by default
            if ($request->hasFile('image_file')) {
                $imagePath = '/storage/' . $request->file('image_file')->store('recipes', 'public');
            }

            // Update data resep
            $recipeData = [
                'title' => $request->input('title', $recipe->title),
                'category_id' => $request->input('category_id', $recipe->category_id),
                'description' => $request->input('description', $recipe->description),
                'cooking_time' => $request->input('cooking_time', $recipe->cooking_time),
                'portions' => $request->input('portions', $recipe->portions),
                'instructions' => $request->input('instructions', $recipe->instructions),
                'image_url' => $imagePath
            ];
            
            // Remove nulls to mimic array_filter if they are actually empty, except if user intentionally empties it
            // array_filter might strip '0' so it's safer to just pass it
            $recipe->update($recipeData);

            // Update ingredients jika ada
            if ($request->has('ingredients')) {
                // Validasi ingredients tidak duplikat
                $ingredientIds = array_column($request->ingredients, 'ingredient_id');
                if (count($ingredientIds) !== count(array_unique($ingredientIds))) {
                    DB::rollBack();
                    return response()->json([
                        'success' => false,
                        'message' => 'Ingredient tidak boleh duplikat'
                    ], 422);
                }

                // Hapus semua ingredients lama
                $recipe->ingredients()->detach();

                // Attach ingredients baru (termasuk required_qty untuk DSS)
                $recipeIngredients = [];
                foreach ($request->ingredients as $item) {
                    $ingredient   = Ingredient::find($item['ingredient_id']);
                    $quantity     = (float) $item['quantity'];
                    $requiredQty  = isset($item['required_qty']) ? (int) $item['required_qty'] : 100;
                    $pricePerUnit = (float) $ingredient->price_per_unit;
                    $totalPrice   = $quantity * $pricePerUnit;

                    $recipeIngredients[$item['ingredient_id']] = [
                        'quantity'                    => $quantity,
                        'required_qty'                => $requiredQty,
                        'total_price_for_this_recipe' => $totalPrice,
                        'created_at'                  => now(),
                        'updated_at'                  => now()
                    ];
                }

                $recipe->ingredients()->attach($recipeIngredients);
            }

            // Load relasi untuk response
            $recipe->load(['category', 'ingredients' => function ($query) {
                $query->withPivot('quantity', 'required_qty', 'total_price_for_this_recipe');
            }]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Resep berhasil diperbarui',
                'data' => $recipe
            ], 200);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui resep',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * DELETE /api/admin/recipes/{id} - Hapus resep
     */
    public function destroy(int $id): JsonResponse
    {
        $recipe = Recipe::find($id);

        if (!$recipe) {
            return response()->json([
                'success' => false,
                'message' => 'Resep tidak ditemukan'
            ], 404);
        }

        try {
            // Hapus dulu pivot table (akan otomatis karena onDelete cascade)
            $recipe->ingredients()->detach();
            $recipe->delete();

            return response()->json([
                'success' => true,
                'message' => 'Resep berhasil dihapus'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus resep',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
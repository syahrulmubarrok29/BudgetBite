<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class RecipeController extends Controller
{
    /**
     * API Pencarian Resep Berdasarkan Budget dan Kategori (DSS Proporsional)
     *
     * Endpoint: GET /api/recipes/search
     * Parameters:
     * - max_budget (required): Budget maksimal (integer)
     * - category_id (optional): ID kategori makanan
     *
     * Rumus DSS: (recipe_ingredients.required_qty / ingredients.base_qty) * ingredients.price_per_unit
     * Fallback (data lama): pakai total_price_for_this_recipe bila required_qty = 0
     */
    public function searchByBudget(Request $request): JsonResponse
    {
        // Validasi input
        $request->validate([
            'max_budget'  => 'nullable|numeric|min:0',
            'category_id' => 'nullable|integer|exists:categories,id'
        ]);

        $maxBudget  = $request->input('max_budget');
        $categoryId = $request->input('category_id');

        // ========================================================
        // QUERY DSS PROPORSIONAL
        // Rumus per bahan: (required_qty / base_qty) * price_per_unit
        // Fallback data lama: jika required_qty = 0, pakai total_price_for_this_recipe
        // ========================================================
        $query = DB::table('recipes')
            ->select(
                'recipes.id',
                'recipes.title',
                'recipes.image_url',
                'recipes.instructions',
                'categories.name as category_name'
            )
            ->selectRaw('
                SUM(
                    CASE
                        WHEN recipe_ingredients.required_qty > 0 AND ingredients.base_qty > 0
                        THEN (recipe_ingredients.required_qty / ingredients.base_qty) * ingredients.price_per_unit
                        ELSE recipe_ingredients.total_price_for_this_recipe
                    END
                ) as total_dynamic_price
            ')
            ->join('recipe_ingredients', 'recipes.id', '=', 'recipe_ingredients.recipe_id')
            ->join('ingredients', 'recipe_ingredients.ingredient_id', '=', 'ingredients.id')
            ->leftJoin('categories', 'recipes.category_id', '=', 'categories.id')
            ->groupBy(
                'recipes.id',
                'recipes.title',
                'recipes.image_url',
                'recipes.instructions',
                'categories.name'
            );

        // Filter berdasarkan kategori jika ada
        if ($categoryId) {
            $query->where('recipes.category_id', $categoryId);
        }

        // Filter berdasarkan budget DSS
        if ($maxBudget !== null && $maxBudget !== '') {
            $query->having('total_dynamic_price', '<=', $maxBudget);
        }
        
        $query->orderBy('total_dynamic_price', 'asc');

        $recipes = $query->get();

        // Ambil detail ingredients untuk setiap resep dengan harga dinamis
        $results = $recipes->map(function ($recipe) {
            $ingredients = DB::table('recipe_ingredients')
                ->select(
                    'ingredients.name',
                    'ingredients.unit',
                    'recipe_ingredients.quantity',
                    'recipe_ingredients.required_qty'
                )
                ->selectRaw('
                    CASE
                        WHEN recipe_ingredients.required_qty > 0 AND ingredients.base_qty > 0
                        THEN (recipe_ingredients.required_qty / ingredients.base_qty) * ingredients.price_per_unit
                        ELSE recipe_ingredients.total_price_for_this_recipe
                    END as dynamic_price_per_ingredient
                ')
                ->join('ingredients', 'recipe_ingredients.ingredient_id', '=', 'ingredients.id')
                ->where('recipe_ingredients.recipe_id', $recipe->id)
                ->get();

            return [
                'id'                  => $recipe->id,
                'title'               => $recipe->title,
                'image_url'           => $recipe->image_url,
                'category_name'       => $recipe->category_name ?? 'Tanpa Kategori',
                // total_dynamic_price = hasil kalkulasi DSS
                'total_dynamic_price' => (float) $recipe->total_dynamic_price,
                // total_price = alias agar frontend lama (yang pakai total_price) tidak error
                'total_price'         => (float) $recipe->total_dynamic_price,
                'ingredients'         => $ingredients->map(function ($ing) {
                    return [
                        'name'         => $ing->name,
                        'quantity'     => (float) $ing->quantity,
                        'required_qty' => (int) $ing->required_qty,
                        'unit'         => $ing->unit,
                    ];
                })
            ];
        });

        return response()->json([
            'success' => true,
            'message' => 'Data resep berhasil ditemukan',
            'data'    => $results,
            'meta'    => [
                'total_results'   => $results->count(),
                'max_budget'      => (float) $maxBudget,
                'category_filter' => $categoryId ? (int) $categoryId : null,
                'calculation'     => 'DSS Proporsional: (required_qty / base_qty) x price_per_unit'
            ]
        ], 200);
    }

    /**
     * Get all recipes (tanpa filter budget) — Kompatibel dengan data lama
     */
    public function index(): JsonResponse
    {
        $recipes = Recipe::with(['category', 'ingredients' => function ($query) {
            $query->withPivot('quantity', 'required_qty', 'total_price_for_this_recipe');
        }])->get();

        return response()->json([
            'success' => true,
            'data'    => $recipes
        ], 200);
    }

    /**
     * Get single recipe — Kompatibel dengan data lama
     */
    public function show(int $id): JsonResponse
    {
        $recipe = Recipe::with(['category', 'ingredients' => function ($query) {
            $query->withPivot('quantity', 'required_qty', 'total_price_for_this_recipe');
        }])->find($id);

        if (!$recipe) {
            return response()->json([
                'success' => false,
                'message' => 'Resep tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data'    => $recipe
        ], 200);
    }
}
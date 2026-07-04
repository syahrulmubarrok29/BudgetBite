<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

class IngredientController extends Controller
{
    /**
     * GET /api/admin/ingredients - Ambil semua ingredients
     */
    public function index(): JsonResponse
    {
        $ingredients = Ingredient::orderBy('name')->get();
        
        return response()->json([
            'success' => true,
            'data' => $ingredients
        ], 200);
    }

    /**
     * POST /api/admin/ingredients - Tambah ingredient baru
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name'           => 'required|string|max:255',
            'unit'           => 'required|string|max:50',
            'price_per_unit' => 'required|numeric|min:0',
            'base_qty'       => 'nullable|integer|min:1'  // Takaran master (gram/ml/pcs)
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        $ingredient = Ingredient::create([
            'name'           => $request->name,
            'unit'           => $request->unit,
            'price_per_unit' => $request->price_per_unit,
            'base_qty'       => $request->base_qty ?? 1000, // Default 1000 (misal: harga per 1000 gram = 1 kg)
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Bahan berhasil ditambahkan',
            'data' => $ingredient
        ], 201);
    }

    /**
     * GET /api/admin/ingredients/{id} - Ambil satu ingredient
     */
    public function show(int $id): JsonResponse
    {
        $ingredient = Ingredient::find($id);

        if (!$ingredient) {
            return response()->json([
                'success' => false,
                'message' => 'Bahan tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $ingredient
        ], 200);
    }

    /**
     * PUT /api/admin/ingredients/{id} - Update ingredient
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $ingredient = Ingredient::find($id);

        if (!$ingredient) {
            return response()->json([
                'success' => false,
                'message' => 'Bahan tidak ditemukan'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name'           => 'sometimes|string|max:255',
            'unit'           => 'sometimes|string|max:50',
            'price_per_unit' => 'sometimes|numeric|min:0',
            'base_qty'       => 'nullable|integer|min:1'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        $ingredient->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Bahan berhasil diperbarui',
            'data' => $ingredient
        ], 200);
    }

    /**
     * DELETE /api/admin/ingredients/{id} - Hapus ingredient
     */
    public function destroy(int $id): JsonResponse
    {
        $ingredient = Ingredient::find($id);

        if (!$ingredient) {
            return response()->json([
                'success' => false,
                'message' => 'Bahan tidak ditemukan'
            ], 404);
        }

        // Cek apakah ingredient digunakan di recipe_ingredients
        if ($ingredient->recipes()->count() > 0) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak dapat menghapus bahan yang digunakan dalam resep'
            ], 400);
        }

        $ingredient->delete();

        return response()->json([
            'success' => true,
            'message' => 'Bahan berhasil dihapus'
        ], 200);
    }
}
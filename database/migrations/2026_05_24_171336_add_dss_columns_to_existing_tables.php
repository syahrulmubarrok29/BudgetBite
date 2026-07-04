<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * DSS Proportional Calculation - Safe ALTER TABLE
     * 
     * SAFE: Tidak ada DROP TABLE, tidak ada TRUNCATE, tidak ada migrate:fresh.
     * Hanya menambahkan kolom baru dengan default value agar data lama tidak error.
     * 
     * Prompt 1 - Perubahan:
     * - ingredients: tambah 'base_qty' (integer, default 1000)
     *   CATATAN: Kolom 'unit' sudah ADA, tidak perlu ditambah lagi.
     *   Kolom 'price_per_unit' sudah ADA dan digunakan sebagai 'base_price' dalam rumus DSS.
     * 
     * - recipe_ingredients: tambah 'required_qty' (integer, default 100)
     *   CATATAN: Kolom 'quantity' yang lama TETAP ADA untuk kompatibilitas data lama.
     */
    public function up(): void
    {
        // =============================================
        // TABEL: ingredients
        // Tambah kolom base_qty untuk takaran master (misal: harga per 1000 gram)
        // =============================================
        if (!Schema::hasColumn('ingredients', 'base_qty')) {
            Schema::table('ingredients', function (Blueprint $table) {
                // base_qty = jumlah unit yang menjadi acuan harga (misal: 1000 = harga per 1000 gram)
                $table->integer('base_qty')->default(1000)->after('price_per_unit')
                      ->comment('Jumlah unit acuan harga. Misal: 1000 = harga per 1000 gram. Digunakan dalam rumus DSS: (required_qty / base_qty) * price_per_unit');
            });
        }

        // =============================================
        // TABEL: recipe_ingredients (pivot)
        // Tambah kolom required_qty untuk takaran per resep spesifik
        // =============================================
        if (!Schema::hasColumn('recipe_ingredients', 'required_qty')) {
            Schema::table('recipe_ingredients', function (Blueprint $table) {
                // required_qty = jumlah yang dibutuhkan resep ini (misal: 250 gram)
                // Default 100 agar data lama tidak error (akan ada nilai, bukan NULL)
                $table->integer('required_qty')->default(100)->after('quantity')
                      ->comment('Takaran bahan yang dibutuhkan resep ini. Digunakan dalam rumus DSS: (required_qty / base_qty) * price_per_unit');
            });
        }
    }

    /**
     * Rollback: hapus kolom yang baru saja ditambahkan.
     * Data lama (quantity, total_price_for_this_recipe, unit, price_per_unit) TIDAK terganggu.
     */
    public function down(): void
    {
        Schema::table('ingredients', function (Blueprint $table) {
            if (Schema::hasColumn('ingredients', 'base_qty')) {
                $table->dropColumn('base_qty');
            }
        });

        Schema::table('recipe_ingredients', function (Blueprint $table) {
            if (Schema::hasColumn('recipe_ingredients', 'required_qty')) {
                $table->dropColumn('required_qty');
            }
        });
    }
};

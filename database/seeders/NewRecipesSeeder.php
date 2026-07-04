<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Recipe;
use App\Models\Category;
use App\Models\Ingredient;

class NewRecipesSeeder extends Seeder
{
    public function run(): void
    {
        $recipesData = [
            [
                'title' => 'Sate Ayam Madura Spesial',
                'description' => 'Sate ayam khas Madura dengan bumbu kacang yang kaya rasa, gurih, dan manis, disajikan dengan irisan bawang merah dan perasan jeruk nipis.',
                'image_url' => '/images/recipes/sate_ayam_madura.png',
                'category_id' => 1, // Makanan Berat
                'ingredients' => [
                    ['name' => 'Ayam', 'required_qty' => 500, 'unit' => 'gram', 'price' => 35000],
                    ['name' => 'Kacang Tanah', 'required_qty' => 200, 'unit' => 'gram', 'price' => 15000],
                    ['name' => 'Bawang Merah', 'required_qty' => 50, 'unit' => 'gram', 'price' => 20000],
                    ['name' => 'Bawang Putih', 'required_qty' => 30, 'unit' => 'gram', 'price' => 25000],
                    ['name' => 'Kecap Manis', 'required_qty' => 50, 'unit' => 'ml', 'price' => 15000],
                    ['name' => 'Jeruk Nipis', 'required_qty' => 20, 'unit' => 'gram', 'price' => 10000],
                    ['name' => 'Garam', 'required_qty' => 5, 'unit' => 'gram', 'price' => 5000],
                    ['name' => 'Gula Merah', 'required_qty' => 20, 'unit' => 'gram', 'price' => 15000],
                ]
            ],
            [
                'title' => 'Soto Betawi Kuah Susu',
                'description' => 'Soto khas Betawi dengan kuah campuran santan dan susu yang gurih, berisi potongan daging sapi empuk, kentang, dan tomat segar.',
                'image_url' => '/images/recipes/soto_betawi.png',
                'category_id' => 1, // Makanan Berat
                'ingredients' => [
                    ['name' => 'Daging Sapi', 'required_qty' => 500, 'unit' => 'gram', 'price' => 120000],
                    ['name' => 'Susu Cair', 'required_qty' => 250, 'unit' => 'ml', 'price' => 25000],
                    ['name' => 'Santan', 'required_qty' => 250, 'unit' => 'ml', 'price' => 15000],
                    ['name' => 'Kentang', 'required_qty' => 300, 'unit' => 'gram', 'price' => 15000],
                    ['name' => 'Tomat', 'required_qty' => 200, 'unit' => 'gram', 'price' => 12000],
                    ['name' => 'Bawang Merah', 'required_qty' => 50, 'unit' => 'gram', 'price' => 20000],
                    ['name' => 'Bawang Putih', 'required_qty' => 30, 'unit' => 'gram', 'price' => 25000],
                    ['name' => 'Daun Salam', 'required_qty' => 5, 'unit' => 'lembar', 'price' => 2000],
                    ['name' => 'Serai', 'required_qty' => 10, 'unit' => 'batang', 'price' => 3000],
                ]
            ],
            [
                'title' => 'Martabak Manis Keju Coklat',
                'description' => 'Cemilan manis favorit keluarga dengan tekstur bersarang, diisi dengan lelehan keju parut, meses coklat, dan susu kental manis yang melimpah.',
                'image_url' => '/images/recipes/martabak_manis.png',
                'category_id' => 2, // Cemilan
                'ingredients' => [
                    ['name' => 'Tepung Terigu', 'required_qty' => 250, 'unit' => 'gram', 'price' => 12000],
                    ['name' => 'Gula Pasir', 'required_qty' => 50, 'unit' => 'gram', 'price' => 15000],
                    ['name' => 'Telur Ayam', 'required_qty' => 100, 'unit' => 'gram', 'price' => 25000],
                    ['name' => 'Susu Cair', 'required_qty' => 300, 'unit' => 'ml', 'price' => 25000],
                    ['name' => 'Baking Powder', 'required_qty' => 5, 'unit' => 'gram', 'price' => 10000],
                    ['name' => 'Keju', 'required_qty' => 100, 'unit' => 'gram', 'price' => 45000],
                    ['name' => 'Susu Kental Manis', 'required_qty' => 50, 'unit' => 'ml', 'price' => 15000],
                    ['name' => 'Margarin', 'required_qty' => 30, 'unit' => 'gram', 'price' => 20000],
                ]
            ],
            [
                'title' => 'Es Campur Segar Spesial',
                'description' => 'Pencuci mulut yang segar dengan campuran buah alpukat, nangka, cincau hijau, kolang-kaling, disiram sirup merah muda dan susu kental manis.',
                'image_url' => '/images/recipes/es_campur.png',
                'category_id' => 3, // Penutup
                'ingredients' => [
                    ['name' => 'Alpukat', 'required_qty' => 200, 'unit' => 'gram', 'price' => 30000],
                    ['name' => 'Nangka', 'required_qty' => 100, 'unit' => 'gram', 'price' => 25000],
                    ['name' => 'Kelapa Muda', 'required_qty' => 200, 'unit' => 'gram', 'price' => 15000],
                    ['name' => 'Susu Kental Manis', 'required_qty' => 50, 'unit' => 'ml', 'price' => 15000],
                    ['name' => 'Sirup Merah', 'required_qty' => 50, 'unit' => 'ml', 'price' => 20000],
                    ['name' => 'Es Batu', 'required_qty' => 500, 'unit' => 'gram', 'price' => 5000],
                ]
            ]
        ];

        foreach ($recipesData as $data) {
            $recipe = Recipe::create([
                'title' => $data['title'],
                'description' => $data['description'],
                'instructions' => 'Cara membuat ' . strtolower($data['title']) . ' dapat dilihat di video berikut atau buku resep keluarga Anda.',
                'image_url' => $data['image_url'],
                'category_id' => $data['category_id'],
                'cooking_time' => 30, // Default 30 mins
                'portions' => 4, // Default 4 portions
            ]);

            foreach ($data['ingredients'] as $ingData) {
                // Cari ingredient di database
                $ingredient = Ingredient::where('name', 'like', '%' . $ingData['name'] . '%')->first();
                if (!$ingredient) {
                    $ingredient = Ingredient::create([
                        'name' => ucwords($ingData['name']),
                        'unit' => $ingData['unit'],
                        'price_per_unit' => $ingData['price'],
                        'base_qty' => 1000, // Semua kita anggap per 1000 unit agar tidak ada desimal
                    ]);
                } else {
                    // Update the base_qty if it's 1 for kg, change it to 1000 for uniform math
                    if ($ingredient->base_qty == 1 && $ingredient->unit == 'kg') {
                        $ingredient->update(['base_qty' => 1000, 'unit' => 'gram']);
                    }
                }

                $priceForThisRecipe = ($ingData['required_qty'] / $ingredient->base_qty) * $ingredient->price_per_unit;

                $recipe->ingredients()->attach($ingredient->id, [
                    'quantity' => $ingData['required_qty'],
                    'required_qty' => (int) $ingData['required_qty'],
                    'total_price_for_this_recipe' => $priceForThisRecipe,
                ]);
            }
        }
    }
}

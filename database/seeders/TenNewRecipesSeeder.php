<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Recipe;
use App\Models\Ingredient;

class TenNewRecipesSeeder extends Seeder
{
    public function run(): void
    {
        $recipesData = [
            [
                'title' => 'Nasi Goreng Spesial',
                'description' => 'Nasi goreng khas Indonesia dengan tambahan udang, ayam suwir, dan telur mata sapi, disajikan dengan kerupuk dan acar segar.',
                'image_url' => '/images/recipes/nasi_goreng.png',
                'category_id' => 1, // Makanan Berat
                'ingredients' => [
                    ['name' => 'Beras Kualitas Super', 'required_qty' => 300, 'unit' => 'gram', 'price' => 15000],
                    ['name' => 'Telur Ayam', 'required_qty' => 100, 'unit' => 'gram', 'price' => 25000],
                    ['name' => 'Ayam', 'required_qty' => 150, 'unit' => 'gram', 'price' => 35000],
                    ['name' => 'Kecap Manis', 'required_qty' => 30, 'unit' => 'ml', 'price' => 15000],
                    ['name' => 'Bawang Merah', 'required_qty' => 30, 'unit' => 'gram', 'price' => 20000],
                    ['name' => 'Bawang Putih', 'required_qty' => 15, 'unit' => 'gram', 'price' => 25000],
                    ['name' => 'Cabai Merah', 'required_qty' => 20, 'unit' => 'gram', 'price' => 30000],
                ]
            ],
            [
                'title' => 'Rendang Daging Sapi',
                'description' => 'Olahan daging sapi khas Minang yang dimasak perlahan dalam santan dan rempah-rempah yang kaya hingga menghasilkan bumbu yang meresap sempurna.',
                'image_url' => '/images/recipes/rendang_daging.png',
                'category_id' => 1, // Makanan Berat
                'ingredients' => [
                    ['name' => 'Daging Sapi', 'required_qty' => 500, 'unit' => 'gram', 'price' => 120000],
                    ['name' => 'Santan', 'required_qty' => 500, 'unit' => 'ml', 'price' => 15000],
                    ['name' => 'Bawang Merah', 'required_qty' => 50, 'unit' => 'gram', 'price' => 20000],
                    ['name' => 'Bawang Putih', 'required_qty' => 30, 'unit' => 'gram', 'price' => 25000],
                    ['name' => 'Cabai Merah', 'required_qty' => 50, 'unit' => 'gram', 'price' => 30000],
                    ['name' => 'Jahe', 'required_qty' => 10, 'unit' => 'gram', 'price' => 10000],
                    ['name' => 'Lengkuas', 'required_qty' => 15, 'unit' => 'gram', 'price' => 10000],
                    ['name' => 'Serai', 'required_qty' => 15, 'unit' => 'gram', 'price' => 5000],
                ]
            ],
            [
                'title' => 'Gado-Gado Betawi',
                'description' => 'Salad sayuran rebus tradisional Indonesia lengkap dengan tahu, tempe, telur rebus, dan siraman bumbu kacang yang legit.',
                'image_url' => '/images/recipes/gado_gado.png',
                'category_id' => 1, // Makanan Berat
                'ingredients' => [
                    ['name' => 'Kacang Panjang', 'required_qty' => 150, 'unit' => 'gram', 'price' => 12000],
                    ['name' => 'Tauge', 'required_qty' => 100, 'unit' => 'gram', 'price' => 10000],
                    ['name' => 'Tahu', 'required_qty' => 200, 'unit' => 'gram', 'price' => 10000],
                    ['name' => 'Tempe', 'required_qty' => 200, 'unit' => 'gram', 'price' => 10000],
                    ['name' => 'Kacang Tanah', 'required_qty' => 150, 'unit' => 'gram', 'price' => 25000],
                    ['name' => 'Telur Ayam', 'required_qty' => 100, 'unit' => 'gram', 'price' => 25000],
                    ['name' => 'Gula Merah', 'required_qty' => 30, 'unit' => 'gram', 'price' => 15000],
                ]
            ],
            [
                'title' => 'Pempek Palembang',
                'description' => 'Kue ikan khas Palembang yang digoreng renyah, disajikan dengan siraman cuko yang manis, asam, dan pedas menyegarkan.',
                'image_url' => '/images/recipes/pempek_palembang.png',
                'category_id' => 2, // Cemilan
                'ingredients' => [
                    ['name' => 'Ikan Tenggiri', 'required_qty' => 300, 'unit' => 'gram', 'price' => 80000],
                    ['name' => 'Tepung Sagu', 'required_qty' => 200, 'unit' => 'gram', 'price' => 15000],
                    ['name' => 'Telur Ayam', 'required_qty' => 100, 'unit' => 'gram', 'price' => 25000],
                    ['name' => 'Bawang Putih', 'required_qty' => 20, 'unit' => 'gram', 'price' => 25000],
                    ['name' => 'Gula Merah', 'required_qty' => 100, 'unit' => 'gram', 'price' => 15000],
                    ['name' => 'Asam Jawa', 'required_qty' => 30, 'unit' => 'gram', 'price' => 10000],
                ]
            ],
            [
                'title' => 'Pisang Goreng Keju',
                'description' => 'Pisang goreng renyah yang ditaburi dengan parutan keju melimpah, meses coklat, dan susu kental manis sebagai hidangan penutup santai.',
                'image_url' => '/images/recipes/pisang_goreng_keju.png',
                'category_id' => 2, // Cemilan
                'ingredients' => [
                    ['name' => 'Pisang Kepok', 'required_qty' => 500, 'unit' => 'gram', 'price' => 15000],
                    ['name' => 'Tepung Terigu', 'required_qty' => 100, 'unit' => 'gram', 'price' => 12000],
                    ['name' => 'Keju', 'required_qty' => 100, 'unit' => 'gram', 'price' => 45000],
                    ['name' => 'Susu Kental Manis', 'required_qty' => 40, 'unit' => 'ml', 'price' => 15000],
                    ['name' => 'Meses Coklat', 'required_qty' => 30, 'unit' => 'gram', 'price' => 20000],
                    ['name' => 'Minyak Goreng', 'required_qty' => 300, 'unit' => 'ml', 'price' => 15000],
                ]
            ],
            [
                'title' => 'Onde-Onde Wijen',
                'description' => 'Kue tradisional kenyal berbalut wijen dengan isian pasta kacang hijau manis yang lezat, digoreng hingga kuning keemasan.',
                'image_url' => '/images/recipes/onde_onde.png',
                'category_id' => 2, // Cemilan
                'ingredients' => [
                    ['name' => 'Tepung Ketan', 'required_qty' => 250, 'unit' => 'gram', 'price' => 20000],
                    ['name' => 'Kacang Hijau Kupas', 'required_qty' => 150, 'unit' => 'gram', 'price' => 25000],
                    ['name' => 'Gula Pasir', 'required_qty' => 100, 'unit' => 'gram', 'price' => 15000],
                    ['name' => 'Wijen Putih', 'required_qty' => 100, 'unit' => 'gram', 'price' => 30000],
                    ['name' => 'Santan', 'required_qty' => 100, 'unit' => 'ml', 'price' => 15000],
                    ['name' => 'Minyak Goreng', 'required_qty' => 400, 'unit' => 'ml', 'price' => 15000],
                ]
            ],
            [
                'title' => 'Es Dawet Ayu',
                'description' => 'Minuman segar tradisional dari tepung beras (dawet) beraroma pandan, disajikan dengan santan dan siraman gula aren cair.',
                'image_url' => '/images/recipes/es_dawet_ayu.png',
                'category_id' => 3, // Penutup
                'ingredients' => [
                    ['name' => 'Tepung Beras', 'required_qty' => 100, 'unit' => 'gram', 'price' => 12000],
                    ['name' => 'Tepung Sagu', 'required_qty' => 50, 'unit' => 'gram', 'price' => 15000],
                    ['name' => 'Daun Pandan', 'required_qty' => 10, 'unit' => 'lembar', 'price' => 2000],
                    ['name' => 'Santan', 'required_qty' => 300, 'unit' => 'ml', 'price' => 15000],
                    ['name' => 'Gula Merah', 'required_qty' => 200, 'unit' => 'gram', 'price' => 15000],
                    ['name' => 'Es Batu', 'required_qty' => 400, 'unit' => 'gram', 'price' => 5000],
                ]
            ],
            [
                'title' => 'Klepon Pandan',
                'description' => 'Jajanan pasar khas Indonesia berbentuk bola-bola ketan pandan berisi kejutan lelehan gula merah, dibalur dengan kelapa parut.',
                'image_url' => '/images/recipes/klepon_pandan.png',
                'category_id' => 3, // Penutup
                'ingredients' => [
                    ['name' => 'Tepung Ketan', 'required_qty' => 250, 'unit' => 'gram', 'price' => 20000],
                    ['name' => 'Tepung Beras', 'required_qty' => 50, 'unit' => 'gram', 'price' => 12000],
                    ['name' => 'Daun Pandan', 'required_qty' => 5, 'unit' => 'lembar', 'price' => 2000],
                    ['name' => 'Gula Merah', 'required_qty' => 100, 'unit' => 'gram', 'price' => 15000],
                    ['name' => 'Kelapa Parut', 'required_qty' => 150, 'unit' => 'gram', 'price' => 10000],
                ]
            ],
            [
                'title' => 'Ayam Penyet Sambal Ijo',
                'description' => 'Ayam goreng khas yang dipenyet di atas cobek bersama sambal cabai hijau super pedas, lengkap dengan lalapan segar.',
                'image_url' => '/images/recipes/ayam_penyet.png',
                'category_id' => 1, // Makanan Berat
                'ingredients' => [
                    ['name' => 'Ayam', 'required_qty' => 500, 'unit' => 'gram', 'price' => 35000],
                    ['name' => 'Cabai Hijau', 'required_qty' => 100, 'unit' => 'gram', 'price' => 30000],
                    ['name' => 'Bawang Merah', 'required_qty' => 30, 'unit' => 'gram', 'price' => 20000],
                    ['name' => 'Bawang Putih', 'required_qty' => 15, 'unit' => 'gram', 'price' => 25000],
                    ['name' => 'Tomat Hijau', 'required_qty' => 50, 'unit' => 'gram', 'price' => 15000],
                    ['name' => 'Kemiri', 'required_qty' => 10, 'unit' => 'gram', 'price' => 15000],
                ]
            ],
            [
                'title' => 'Sop Buntut',
                'description' => 'Sup kaldu bening nan gurih dengan isian daging buntut sapi yang sangat empuk, dipadu dengan potongan sayuran kentang dan wortel.',
                'image_url' => '/images/recipes/sop_buntut.png',
                'category_id' => 1, // Makanan Berat
                'ingredients' => [
                    ['name' => 'Buntut Sapi', 'required_qty' => 500, 'unit' => 'gram', 'price' => 150000],
                    ['name' => 'Wortel', 'required_qty' => 150, 'unit' => 'gram', 'price' => 15000],
                    ['name' => 'Kentang', 'required_qty' => 200, 'unit' => 'gram', 'price' => 15000],
                    ['name' => 'Daun Bawang', 'required_qty' => 20, 'unit' => 'gram', 'price' => 10000],
                    ['name' => 'Bawang Merah', 'required_qty' => 30, 'unit' => 'gram', 'price' => 20000],
                    ['name' => 'Bawang Putih', 'required_qty' => 20, 'unit' => 'gram', 'price' => 25000],
                    ['name' => 'Pala', 'required_qty' => 5, 'unit' => 'gram', 'price' => 20000],
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
                'cooking_time' => 45, // Default 45 mins
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

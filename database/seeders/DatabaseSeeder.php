<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Ingredient;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Akun
        User::updateOrCreate(['email' => 'admin@example.com'], [
            'name' => 'Admin System', 'password' => Hash::make('password'), 'role' => 'admin'
        ]);
        User::updateOrCreate(['email' => 'user@example.com'], [
            'name' => 'Demo User', 'password' => Hash::make('password'), 'role' => 'user'
        ]);

        // 2. Kategori yang diminta
        $categories = [
            ['name' => 'Makanan Berat', 'description' => 'Menu utama yang mengenyangkan'],
            ['name' => 'Makanan Ringan', 'description' => 'Jajanan dan cemilan'],
            ['name' => 'Makanan Penutup', 'description' => 'Dessert dan hidangan manis'],
        ];

        // Kosongkan kategori dan bahan lama agar tidak menumpuk/bentrok
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Category::truncate();
        Ingredient::truncate();
        DB::table('recipe_ingredients')->truncate();
        \App\Models\Recipe::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        foreach ($categories as $cat) {
            Category::create($cat);
        }

        // 3. Bahan Pokok (Dataset Harga Pangan Nasional & Bahan Tambahan)
        $ingredients = [
            ['name' => 'Beras Kualitas Medium', 'unit' => 'kg', 'price_per_unit' => 14000],
            ['name' => 'Beras Kualitas Super', 'unit' => 'kg', 'price_per_unit' => 16500],
            ['name' => 'Daging Ayam Ras', 'unit' => 'kg', 'price_per_unit' => 38000],
            ['name' => 'Daging Sapi Kualitas 1', 'unit' => 'kg', 'price_per_unit' => 135000],
            ['name' => 'Telur Ayam Ras', 'unit' => 'kg', 'price_per_unit' => 30000],
            ['name' => 'Bawang Merah', 'unit' => 'kg', 'price_per_unit' => 45000],
            ['name' => 'Bawang Putih Ukuran Sedang', 'unit' => 'kg', 'price_per_unit' => 42000],
            ['name' => 'Cabai Merah Keriting', 'unit' => 'kg', 'price_per_unit' => 60000],
            ['name' => 'Cabai Rawit Merah', 'unit' => 'kg', 'price_per_unit' => 70000],
            ['name' => 'Minyak Goreng Curah', 'unit' => 'liter', 'price_per_unit' => 16000],
            ['name' => 'Minyak Goreng Kemasan', 'unit' => 'liter', 'price_per_unit' => 20000],
            ['name' => 'Gula Pasir Lokal', 'unit' => 'kg', 'price_per_unit' => 17500],
            ['name' => 'Tepung Terigu Segitiga Biru', 'unit' => 'kg', 'price_per_unit' => 13000],
            ['name' => 'Garam Halus', 'unit' => 'bungkus', 'price_per_unit' => 3000],
            ['name' => 'Tahu Mentah', 'unit' => 'potong', 'price_per_unit' => 1500],
            ['name' => 'Tempe Mentah', 'unit' => 'papan', 'price_per_unit' => 5000],
            ['name' => 'Kecap Manis Botol', 'unit' => 'botol', 'price_per_unit' => 18000],
            ['name' => 'Susu Kental Manis', 'unit' => 'kaleng', 'price_per_unit' => 12000],
            ['name' => 'Mentega / Margarin', 'unit' => 'sachet', 'price_per_unit' => 8000],
            // Bahan Tambahan Baru
            ['name' => 'Daging Ayam Cincang', 'unit' => 'kg', 'price_per_unit' => 45000],
            ['name' => 'Udang Kupas', 'unit' => 'kg', 'price_per_unit' => 80000],
            ['name' => 'Kulit Pangsit', 'unit' => 'bungkus', 'price_per_unit' => 10000],
            ['name' => 'Tepung Tapioka', 'unit' => 'kg', 'price_per_unit' => 12000],
            ['name' => 'Daun Bawang', 'unit' => 'ikat', 'price_per_unit' => 3000],
            ['name' => 'Pisang Kepok', 'unit' => 'sisir', 'price_per_unit' => 15000],
            ['name' => 'Keju Cheddar', 'unit' => 'blok', 'price_per_unit' => 22000],
            ['name' => 'Coklat Meises', 'unit' => 'bungkus', 'price_per_unit' => 8000],
            ['name' => 'Buah Campur', 'unit' => 'kg', 'price_per_unit' => 25000],
            ['name' => 'Sirup Merah', 'unit' => 'botol', 'price_per_unit' => 20000],
            ['name' => 'Susu Cair UHT', 'unit' => 'liter', 'price_per_unit' => 18000],
            ['name' => 'Bubuk Agar-Agar', 'unit' => 'sachet', 'price_per_unit' => 5000],
            ['name' => 'Santan Kelapa', 'unit' => 'bungkus', 'price_per_unit' => 3500],
            ['name' => 'Kacang Tanah', 'unit' => 'kg', 'price_per_unit' => 28000],
            ['name' => 'Jeruk Nipis', 'unit' => 'kg', 'price_per_unit' => 15000],
            ['name' => 'Kaldu Bubuk Ayam', 'unit' => 'sachet', 'price_per_unit' => 1000],
        ];
        
        $ingredientModels = [];
        foreach ($ingredients as $ing) {
            $ingredientModels[$ing['name']] = Ingredient::create($ing);
        }

        // Kategori Reference
        $catBerat = Category::where('name', 'Makanan Berat')->first();
        $catRingan = Category::where('name', 'Makanan Ringan')->first();
        $catPenutup = Category::where('name', 'Makanan Penutup')->first();

        // 4. Makanan Berat
        if ($catBerat) {
            // Ayam Kecap
            $recipeAyamKecap = \App\Models\Recipe::create([
                'title' => 'Ayam Kecap Pedas Manis',
                'category_id' => $catBerat->id,
                'instructions' => '1. Goreng ayam sebentar. 2. Tumis bawang merah & putih. 3. Masukkan ayam, kecap, sedikit air, dan cabai rawit. 4. Masak hingga bumbu meresap.',
                'image_url' => 'https://plus.unsplash.com/premium_photo-1669680373405-b003a2ec22cf?q=80&w=600&auto=format&fit=crop'
            ]);
            $recipeAyamKecap->ingredients()->attach([
                $ingredientModels['Daging Ayam Ras']->id => ['quantity' => 0.5, 'total_price_for_this_recipe' => 0.5 * 38000],
                $ingredientModels['Bawang Merah']->id => ['quantity' => 0.05, 'total_price_for_this_recipe' => 0.05 * 45000],
                $ingredientModels['Bawang Putih Ukuran Sedang']->id => ['quantity' => 0.03, 'total_price_for_this_recipe' => 0.03 * 42000],
                $ingredientModels['Kecap Manis Botol']->id => ['quantity' => 0.2, 'total_price_for_this_recipe' => 0.2 * 18000],
                $ingredientModels['Cabai Rawit Merah']->id => ['quantity' => 0.05, 'total_price_for_this_recipe' => 0.05 * 70000],
                $ingredientModels['Minyak Goreng Kemasan']->id => ['quantity' => 0.1, 'total_price_for_this_recipe' => 0.1 * 20000],
            ]);

            // Nasi Goreng Spesial
            $recipeNasiGoreng = \App\Models\Recipe::create([
                'title' => 'Nasi Goreng Spesial',
                'category_id' => $catBerat->id,
                'instructions' => '1. Panaskan minyak, orak-arik telur. 2. Tumis bawang merah dan putih yang sudah dihaluskan. 3. Masukkan nasi (beras yang sudah dimasak), kecap manis, ayam suwir, dan cabai. 4. Aduk rata hingga matang.',
                'image_url' => 'https://images.unsplash.com/photo-1603133872878-684f208fb84b?q=80&w=600&auto=format&fit=crop'
            ]);
            $recipeNasiGoreng->ingredients()->attach([
                $ingredientModels['Beras Kualitas Super']->id => ['quantity' => 0.3, 'total_price_for_this_recipe' => 0.3 * 16500],
                $ingredientModels['Telur Ayam Ras']->id => ['quantity' => 0.1, 'total_price_for_this_recipe' => 0.1 * 30000],
                $ingredientModels['Bawang Merah']->id => ['quantity' => 0.05, 'total_price_for_this_recipe' => 0.05 * 45000],
                $ingredientModels['Bawang Putih Ukuran Sedang']->id => ['quantity' => 0.03, 'total_price_for_this_recipe' => 0.03 * 42000],
                $ingredientModels['Kecap Manis Botol']->id => ['quantity' => 0.1, 'total_price_for_this_recipe' => 0.1 * 18000],
                $ingredientModels['Daging Ayam Ras']->id => ['quantity' => 0.1, 'total_price_for_this_recipe' => 0.1 * 38000],
            ]);

            // Rendang Daging
            $recipeRendang = \App\Models\Recipe::create([
                'title' => 'Rendang Daging Sapi Asli',
                'category_id' => $catBerat->id,
                'instructions' => '1. Haluskan bawang merah, bawang putih, cabai keriting. 2. Tumis bumbu halus, masukkan daging sapi. 3. Tambahkan santan kelapa perlahan. 4. Masak dengan api kecil selama beberapa jam hingga santan menyusut dan mengeluarkan minyak.',
                'image_url' => 'https://images.unsplash.com/photo-1629851610488-824f9c66ccde?q=80&w=600&auto=format&fit=crop'
            ]);
            $recipeRendang->ingredients()->attach([
                $ingredientModels['Daging Sapi Kualitas 1']->id => ['quantity' => 1.0, 'total_price_for_this_recipe' => 1.0 * 135000],
                $ingredientModels['Santan Kelapa']->id => ['quantity' => 4, 'total_price_for_this_recipe' => 4 * 3500], // 4 bungkus
                $ingredientModels['Bawang Merah']->id => ['quantity' => 0.15, 'total_price_for_this_recipe' => 0.15 * 45000],
                $ingredientModels['Bawang Putih Ukuran Sedang']->id => ['quantity' => 0.05, 'total_price_for_this_recipe' => 0.05 * 42000],
                $ingredientModels['Cabai Merah Keriting']->id => ['quantity' => 0.1, 'total_price_for_this_recipe' => 0.1 * 60000],
            ]);
        }

        // 5. Makanan Ringan
        if ($catRingan) {
            // Dimsum Ayam Udang
            $recipeDimsum = \App\Models\Recipe::create([
                'title' => 'Dimsum Ayam Udang',
                'category_id' => $catRingan->id,
                'instructions' => '1. Campurkan daging ayam cincang, udang, irisan daun bawang, tepung tapioka, dan kaldu bubuk. 2. Ambil selembar kulit pangsit, isi dengan adonan. 3. Bentuk dimsum dan kukus selama 20-30 menit.',
                'image_url' => 'https://images.unsplash.com/photo-1541696432-82c6da8ce7bf?q=80&w=600&auto=format&fit=crop'
            ]);
            $recipeDimsum->ingredients()->attach([
                $ingredientModels['Daging Ayam Cincang']->id => ['quantity' => 0.3, 'total_price_for_this_recipe' => 0.3 * 45000],
                $ingredientModels['Udang Kupas']->id => ['quantity' => 0.15, 'total_price_for_this_recipe' => 0.15 * 80000],
                $ingredientModels['Kulit Pangsit']->id => ['quantity' => 1, 'total_price_for_this_recipe' => 1 * 10000], // 1 bungkus
                $ingredientModels['Tepung Tapioka']->id => ['quantity' => 0.1, 'total_price_for_this_recipe' => 0.1 * 12000],
                $ingredientModels['Daun Bawang']->id => ['quantity' => 0.5, 'total_price_for_this_recipe' => 0.5 * 3000], // Setengah ikat
                $ingredientModels['Kaldu Bubuk Ayam']->id => ['quantity' => 1, 'total_price_for_this_recipe' => 1 * 1000], // 1 sachet
            ]);

            // Siomay Bandung
            $recipeSiomay = \App\Models\Recipe::create([
                'title' => 'Siomay Bandung Komplit',
                'category_id' => $catRingan->id,
                'instructions' => '1. Campur ayam cincang, tepung tapioka, dan bumbu halus untuk membuat siomay. 2. Kukus siomay, tahu, dan kentang (opsional). 3. Sangrai kacang tanah, haluskan dengan cabai merah dan gula untuk bumbu kacang. 4. Sajikan siomay dengan siraman bumbu kacang dan perasan jeruk nipis.',
                'image_url' => 'https://images.unsplash.com/photo-1623194098600-b6ab6f8e77a1?q=80&w=600&auto=format&fit=crop'
            ]);
            $recipeSiomay->ingredients()->attach([
                $ingredientModels['Daging Ayam Cincang']->id => ['quantity' => 0.4, 'total_price_for_this_recipe' => 0.4 * 45000],
                $ingredientModels['Tepung Tapioka']->id => ['quantity' => 0.2, 'total_price_for_this_recipe' => 0.2 * 12000],
                $ingredientModels['Kacang Tanah']->id => ['quantity' => 0.25, 'total_price_for_this_recipe' => 0.25 * 28000],
                $ingredientModels['Cabai Merah Keriting']->id => ['quantity' => 0.05, 'total_price_for_this_recipe' => 0.05 * 60000],
                $ingredientModels['Gula Pasir Lokal']->id => ['quantity' => 0.05, 'total_price_for_this_recipe' => 0.05 * 17500],
                $ingredientModels['Jeruk Nipis']->id => ['quantity' => 0.1, 'total_price_for_this_recipe' => 0.1 * 15000],
                $ingredientModels['Tahu Mentah']->id => ['quantity' => 5, 'total_price_for_this_recipe' => 5 * 1500], // 5 potong
            ]);
        }

        // 6. Makanan Penutup
        if ($catPenutup) {
            // Pisang Goreng Coklat Keju
            $recipePisangGoreng = \App\Models\Recipe::create([
                'title' => 'Pisang Goreng Coklat Keju',
                'category_id' => $catPenutup->id,
                'instructions' => '1. Kupas pisang kepok dan belah. 2. Celupkan ke adonan tepung terigu cair. 3. Goreng pisang hingga kecoklatan. 4. Taburi dengan parutan keju cheddar, meises coklat, dan susu kental manis.',
                'image_url' => 'https://images.unsplash.com/photo-1604908177453-7462950a6a3b?q=80&w=600&auto=format&fit=crop'
            ]);
            $recipePisangGoreng->ingredients()->attach([
                $ingredientModels['Pisang Kepok']->id => ['quantity' => 0.5, 'total_price_for_this_recipe' => 0.5 * 15000], // Setengah sisir
                $ingredientModels['Tepung Terigu Segitiga Biru']->id => ['quantity' => 0.2, 'total_price_for_this_recipe' => 0.2 * 13000],
                $ingredientModels['Minyak Goreng Kemasan']->id => ['quantity' => 0.2, 'total_price_for_this_recipe' => 0.2 * 20000],
                $ingredientModels['Keju Cheddar']->id => ['quantity' => 0.3, 'total_price_for_this_recipe' => 0.3 * 22000],
                $ingredientModels['Coklat Meises']->id => ['quantity' => 0.5, 'total_price_for_this_recipe' => 0.5 * 8000], // Setengah bungkus
                $ingredientModels['Susu Kental Manis']->id => ['quantity' => 0.2, 'total_price_for_this_recipe' => 0.2 * 12000],
            ]);

            // Pudding Susu Lapis
            $recipePudding = \App\Models\Recipe::create([
                'title' => 'Pudding Susu Lembut',
                'category_id' => $catPenutup->id,
                'instructions' => '1. Campur bubuk agar-agar dengan gula pasir dan air atau susu cair. 2. Masak sambil diaduk hingga mendidih. 3. Tuang ke dalam cetakan. 4. Dinginkan di kulkas sebelum disajikan.',
                'image_url' => 'https://images.unsplash.com/photo-1621303837174-89787a7d4729?q=80&w=600&auto=format&fit=crop'
            ]);
            $recipePudding->ingredients()->attach([
                $ingredientModels['Bubuk Agar-Agar']->id => ['quantity' => 1, 'total_price_for_this_recipe' => 1 * 5000], // 1 sachet
                $ingredientModels['Susu Cair UHT']->id => ['quantity' => 0.8, 'total_price_for_this_recipe' => 0.8 * 18000], // 800ml
                $ingredientModels['Gula Pasir Lokal']->id => ['quantity' => 0.15, 'total_price_for_this_recipe' => 0.15 * 17500],
            ]);

            // Es Buah Segar
            $recipeEsBuah = \App\Models\Recipe::create([
                'title' => 'Es Buah Tropis',
                'category_id' => $catPenutup->id,
                'instructions' => '1. Potong kecil-kecil buah campur. 2. Masukkan potongan buah ke mangkuk besar. 3. Tambahkan sirup merah, susu kental manis, dan es batu. 4. Aduk merata, es buah siap dinikmati.',
                'image_url' => 'https://images.unsplash.com/photo-1598283335508-2e0618df32f8?q=80&w=600&auto=format&fit=crop'
            ]);
            $recipeEsBuah->ingredients()->attach([
                $ingredientModels['Buah Campur']->id => ['quantity' => 0.5, 'total_price_for_this_recipe' => 0.5 * 25000],
                $ingredientModels['Sirup Merah']->id => ['quantity' => 0.2, 'total_price_for_this_recipe' => 0.2 * 20000],
                $ingredientModels['Susu Kental Manis']->id => ['quantity' => 0.3, 'total_price_for_this_recipe' => 0.3 * 12000],
            ]);
        }
    }
}

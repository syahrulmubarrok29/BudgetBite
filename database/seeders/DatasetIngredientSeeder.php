<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ingredient;

class DatasetIngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csvPath = base_path('Indonesian_Food_Recipes.csv');
        if (!file_exists($csvPath)) {
            $this->command->error("CSV file not found at: {$csvPath}");
            return;
        }

        $this->command->info("Reading CSV and counting ingredients...");

        $file = fopen($csvPath, 'r');
        $header = fgetcsv($file);
        $idx = array_search('Ingredients Cleaned', $header);

        if ($idx === false) {
            $this->command->error("Column 'Ingredients Cleaned' not found.");
            fclose($file);
            return;
        }

        $ingredientsCount = [];
        $stopWords = [
            'bumbu halus', 'bumbu', 'potong', 'geprek', 'haluskan', 'memarkan', 
            'cincang', 'minyak menumis', 'tipis', 'pelengkap', 'gula garam', 
            'garam gula', 'bumbu dihaluskan', 'halus', 'potong dadu', 'secukupnya',
            'bumbu penyedap', 'bumbu instan', 'potongan', 'iris', 'irisan'
        ];

        while (($row = fgetcsv($file)) !== FALSE) {
            if (isset($row[$idx])) {
                $items = explode(' , ', $row[$idx]);
                foreach ($items as $item) {
                    $item = trim(strtolower($item));
                    if (!empty($item) && strlen($item) > 2) {
                        // skip stop words
                        if (in_array($item, $stopWords)) {
                            continue;
                        }
                        
                        if (!isset($ingredientsCount[$item])) {
                            $ingredientsCount[$item] = 0;
                        }
                        $ingredientsCount[$item]++;
                    }
                }
            }
        }
        fclose($file);

        arsort($ingredientsCount);
        $topIngredients = array_slice($ingredientsCount, 0, 1000); // Ambil 1000 bahan teratas
        
        $this->command->info("Inserting Top " . count($topIngredients) . " ingredients to database...");
        
        $inserted = 0;
        foreach ($topIngredients as $name => $count) {
            // Cek apakah bahan sudah ada agar tidak double
            $exists = Ingredient::where('name', 'like', $name)->exists();
            if (!$exists) {
                // Tentukan satuan default
                $unit = 'kg'; // Default
                if (strpos($name, 'daun') !== false || strpos($name, 'serai') !== false || strpos($name, 'kayu manis') !== false) {
                    $unit = 'lembar/batang';
                } elseif (strpos($name, 'kecap') !== false || strpos($name, 'minyak') !== false || strpos($name, 'saus') !== false || strpos($name, 'saos') !== false || strpos($name, 'air') !== false) {
                    $unit = 'ml';
                } elseif (strpos($name, 'garam') !== false || strpos($name, 'gula') !== false || strpos($name, 'kaldu') !== false || strpos($name, 'merica') !== false || strpos($name, 'ketumbar') !== false || strpos($name, 'tepung') !== false) {
                    $unit = 'gram';
                }

                // Tentukan harga dummy berdasarkan jenis bahan
                $price = 15000;
                if ($unit === 'gram') $price = 10000;
                if (strpos($name, 'daging') !== false) $price = 120000;
                if (strpos($name, 'ayam') !== false) $price = 35000;
                if (strpos($name, 'udang') !== false) $price = 80000;

                Ingredient::create([
                    'name' => ucwords($name),
                    'unit' => $unit,
                    'price_per_unit' => $price,
                    'base_qty' => ($unit === 'kg') ? 1 : 1000,
                ]);
                $inserted++;
            }
        }

        $this->command->info("Successfully inserted {$inserted} new ingredients!");
    }
}

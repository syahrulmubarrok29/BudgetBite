<?php
$file = fopen('d:\laragon\www\revisi-resep\Indonesian_Food_Recipes.csv', 'r');
$header = fgetcsv($file);
$idx = array_search('Ingredients Cleaned', $header);
$ingredients = [];
$count = 0;
while (($row = fgetcsv($file)) !== FALSE) {
    if (isset($row[$idx])) {
        $items = explode(' , ', $row[$idx]);
        foreach ($items as $item) {
            $item = trim($item);
            if (!empty($item)) {
                if (!isset($ingredients[$item])) {
                    $ingredients[$item] = 0;
                }
                $ingredients[$item]++;
            }
        }
    }
    $count++;
    if ($count >= 80000) break;
}
fclose($file);
arsort($ingredients);
echo 'Unique ingredients total: ' . count($ingredients) . PHP_EOL;
$top = array_slice($ingredients, 0, 100);
print_r($top);

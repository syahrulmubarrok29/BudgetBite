<?php
$dir = new RecursiveDirectoryIterator('d:/laragon/www/revisi-resep/resources/views');
$iterator = new RecursiveIteratorIterator($dir);

foreach ($iterator as $file) {
    if ($file->isFile() && $file->getExtension() === 'php') {
        $path = $file->getPathname();
        $content = file_get_contents($path);
        $newContent = str_replace('Resep Syaben', 'BudgetBite', $content);
        if ($content !== $newContent) {
            file_put_contents($path, $newContent);
            echo "Updated: $path\n";
        }
    }
}

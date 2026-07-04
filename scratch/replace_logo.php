<?php
$files = [
    'd:/laragon/www/revisi-resep/resources/views/search.blade.php',
    'd:/laragon/www/revisi-resep/resources/views/recipe-detail.blade.php',
    'd:/laragon/www/revisi-resep/resources/views/profile.blade.php',
    'd:/laragon/www/revisi-resep/resources/views/admin.blade.php'
];

foreach ($files as $file) {
    if (file_exists($file)) {
        $content = file_get_contents($file);

        // Replace Material Symbols Restaurant in nav/footer
        $content = preg_replace(
            '/<span class="material-symbols-outlined"[^>]*>restaurant<\/span>\s*BudgetBite/is',
            '<img src="/images/logo.png" alt="BudgetBite Logo" class="h-8 w-8 object-contain rounded-lg"> BudgetBite',
            $content
        );

        // Replace profile specific emojis
        $content = preg_replace(
            '/<span class="text-2xl">🍳<\/span>\s*<span/is',
            '<img src="/images/logo.png" alt="BudgetBite Logo" class="h-8 w-8 object-contain rounded-lg"> <span',
            $content
        );
        $content = preg_replace(
            '/<span>🍳<\/span>\s*BudgetBite/is',
            '<img src="/images/logo.png" alt="BudgetBite Logo" class="h-8 w-8 object-contain rounded-lg"> BudgetBite',
            $content
        );

        // Replace Admin logo "RS"
        $content = preg_replace(
            '/<div class="w-10 h-10 rounded-full bg-primary-container flex items-center justify-center text-on-primary-container font-headline-md font-bold">\s*RS\s*<\/div>/is',
            '<img src="/images/logo.png" alt="BudgetBite Logo" class="h-10 w-10 object-contain rounded-full shadow-sm">',
            $content
        );

        file_put_contents($file, $content);
        echo "Updated logo in $file\n";
    }
}

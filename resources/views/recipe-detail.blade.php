<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>BudgetBite - Detail Resep</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
        tailwind.config = {
          darkMode: "class",
          theme: {
            extend: {
              "colors": {
                      "on-secondary-fixed-variant": "#005227",
                      "tertiary-container": "#c3a900",
                      "on-secondary": "#ffffff",
                      "on-tertiary-fixed": "#211b00",
                      "error-container": "#ffdad6",
                      "surface-container": "#e6eeff",
                      "surface-variant": "#d9e3f6",
                      "inverse-on-surface": "#eaf1ff",
                      "surface-container-high": "#dee9fc",
                      "surface-container-low": "#eff4ff",
                      "tertiary": "#6d5e00",
                      "on-error-container": "#93000a",
                      "on-surface-variant": "#564338",
                      "secondary": "#006d36",
                      "error": "#ba1a1a",
                      "surface-tint": "#9a4600",
                      "on-primary-container": "#682d00",
                      "surface-bright": "#f8f9ff",
                      "surface-dim": "#d0dbed",
                      "tertiary-fixed-dim": "#e2c62d",
                      "on-primary-fixed-variant": "#763300",
                      "surface": "#f8f9ff",
                      "on-error": "#ffffff",
                      "primary-container": "#ff8a3d",
                      "on-primary-fixed": "#321200",
                      "secondary-fixed": "#6dfe9c",
                      "on-secondary-container": "#007439",
                      "primary": "#9a4600",
                      "on-tertiary": "#ffffff",
                      "tertiary-fixed": "#ffe24c",
                      "on-primary": "#ffffff",
                      "surface-container-highest": "#d9e3f6",
                      "inverse-surface": "#27313f",
                      "secondary-container": "#6dfe9c",
                      "on-tertiary-container": "#483e00",
                      "inverse-primary": "#ffb68d",
                      "on-surface": "#121c2a",
                      "primary-fixed": "#ffdbc9",
                      "outline-variant": "#ddc1b3",
                      "on-tertiary-fixed-variant": "#524600",
                      "on-secondary-fixed": "#00210c",
                      "on-background": "#121c2a",
                      "outline": "#8a7266",
                      "primary-fixed-dim": "#ffb68d",
                      "surface-container-lowest": "#ffffff",
                      "background": "#f8f9ff",
                      "secondary-fixed-dim": "#4de082"
              },
              "borderRadius": {
                      "DEFAULT": "0.25rem",
                      "lg": "0.5rem",
                      "xl": "0.75rem",
                      "full": "9999px"
              },
              "spacing": {
                      "base": "8px",
                      "container-max": "1200px",
                      "sm": "12px",
                      "xl": "64px",
                      "xs": "4px",
                      "md": "24px",
                      "lg": "40px",
                      "gutter": "24px"
              },
              "fontFamily": {
                      "headline-md": [
                              "Plus Jakarta Sans", "sans-serif"
                      ],
                      "headline-lg-mobile": [
                              "Plus Jakarta Sans", "sans-serif"
                      ],
                      "label-md": [
                              "Plus Jakarta Sans", "sans-serif"
                      ],
                      "headline-lg": [
                              "Plus Jakarta Sans", "sans-serif"
                      ],
                      "body-md": [
                              "Plus Jakarta Sans", "sans-serif"
                      ],
                      "display-lg": [
                              "Plus Jakarta Sans", "sans-serif"
                      ],
                      "body-lg": [
                              "Plus Jakarta Sans", "sans-serif"
                      ],
                      "label-sm": [
                              "Plus Jakarta Sans", "sans-serif"
                      ]
              },
              "fontSize": {
                      "headline-md": [
                              "24px", { "lineHeight": "32px", "fontWeight": "600" }
                      ],
                      "headline-lg-mobile": [
                              "28px", { "lineHeight": "36px", "fontWeight": "700" }
                      ],
                      "label-md": [
                              "14px", { "lineHeight": "20px", "letterSpacing": "0.01em", "fontWeight": "600" }
                      ],
                      "headline-lg": [
                              "32px", { "lineHeight": "40px", "letterSpacing": "-0.01em", "fontWeight": "700" }
                      ],
                      "body-md": [
                              "16px", { "lineHeight": "24px", "fontWeight": "400" }
                      ],
                      "display-lg": [
                              "48px", { "lineHeight": "56px", "letterSpacing": "-0.02em", "fontWeight": "800" }
                      ],
                      "body-lg": [
                              "18px", { "lineHeight": "28px", "fontWeight": "400" }
                      ],
                      "label-sm": [
                              "12px", { "lineHeight": "16px", "fontWeight": "700" }
                      ]
              }
            },
          }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass-panel {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        .text-shadow {
            text-shadow: 0 2px 4px rgba(0,0,0,0.5);
        }
        .hide-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .hide-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</head>
<body class="bg-surface text-on-surface antialiased min-h-screen flex flex-col">

    <!-- TopNavBar -->
    <nav class="fixed top-0 w-full z-50 flex justify-between items-center px-gutter max-w-container-max mx-auto left-0 right-0 h-16 bg-surface/80 backdrop-blur-md shadow-sm">
        <div class="flex items-center gap-md">
            <a href="/search" class="font-headline-md text-headline-md font-bold text-primary">BudgetBite</a>
            <div class="hidden md:flex gap-md">
                <a class="font-label-md text-label-md text-primary border-b-2 border-primary pb-1" href="/search">Cari Resep</a>
            </div>
        </div>
        <div class="flex items-center gap-sm">
            @auth
            <!-- Profile Dropdown -->
            <div class="relative" id="profileDropdownWrapper">
                <button onclick="toggleProfileMenu()" class="flex items-center gap-2 focus:outline-none">
                    <div class="w-9 h-9 rounded-full bg-primary flex items-center justify-center text-on-primary font-bold text-base">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <span class="material-symbols-outlined text-on-surface-variant text-sm">expand_more</span>
                </button>
                <div id="profileMenu" class="hidden absolute right-0 mt-3 w-64 bg-surface-container-lowest rounded-2xl shadow-xl border border-outline-variant overflow-hidden z-50">
                    <div class="p-4 bg-surface-container-low border-b border-surface-container-highest">
                        <div class="flex items-center gap-3">
                            <div class="w-11 h-11 rounded-full bg-primary flex items-center justify-center text-on-primary font-bold text-xl">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                            <div class="min-w-0">
                                <p class="font-label-md text-label-md text-on-surface truncate">{{ auth()->user()->name }}</p>
                                <p class="font-label-sm text-label-sm text-on-surface-variant truncate">{{ auth()->user()->email }}</p>
                                <span class="inline-block mt-1 text-[10px] font-bold px-2 py-0.5 rounded-full {{ auth()->user()->role === 'admin' ? 'bg-primary-container text-on-primary-container' : 'bg-surface-variant text-on-surface-variant' }}">
                                    {{ auth()->user()->role === 'admin' ? '👑 Admin' : '👤 User' }}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="py-1">
                        <a href="/profile" class="flex items-center gap-3 px-4 py-3 font-label-md text-label-md text-on-surface hover:bg-surface-container-high transition-colors">
                            <span class="material-symbols-outlined">person</span> Profil Saya
                        </a>
                        <a href="/profile?tab=settings" class="flex items-center gap-3 px-4 py-3 font-label-md text-label-md text-on-surface hover:bg-surface-container-high transition-colors">
                            <span class="material-symbols-outlined">settings</span> Pengaturan
                        </a>
                    </div>
                    <div class="border-t border-outline-variant py-1">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 font-label-md text-label-md text-error hover:bg-error-container transition-colors">
                                <span class="material-symbols-outlined">logout</span> Keluar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @else
            <a class="font-label-md text-label-md bg-primary text-on-primary px-4 py-2 rounded-full hover:opacity-90 transition-opacity" href="/login">Login/Register</a>
            @endauth
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow pt-16 min-h-screen" id="detailContainer">
        <!-- Loading State -->
        <div id="loadingIndicator" class="flex flex-col items-center justify-center py-32">
            <div class="w-16 h-16 border-4 border-primary/30 border-t-primary rounded-full animate-spin mb-4"></div>
            <p class="text-on-surface-variant font-label-md text-label-md">Menyiapkan resep untukmu...</p>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-surface-container-highest w-full pt-16 pb-8 mt-auto border-t border-surface-variant">
        <div class="max-w-container-max mx-auto px-gutter">
            <div class="flex flex-col md:flex-row justify-between items-start gap-12 mb-12">
                <div class="flex flex-col gap-4 max-w-sm">
                    <a href="/search" class="font-headline-md text-headline-md font-bold text-primary flex items-center gap-2">
                        <span class="material-symbols-outlined text-[28px]" data-icon="restaurant" data-weight="fill" style="font-variation-settings: 'FILL' 1;">restaurant</span>
                        BudgetBite
                    </a>
                    <p class="font-body-md text-body-md text-on-surface-variant">Solusi cerdas perencanaan makan harian Anda. Temukan resep lezat, hemat, dan praktis untuk keluarga tercinta setiap harinya.</p>
                </div>
                
                <div class="flex flex-wrap gap-12 md:gap-24">
                    <div class="flex flex-col gap-4">
                        <h4 class="font-label-md text-label-md text-on-surface font-bold uppercase tracking-wider">Eksplorasi</h4>
                        <a class="font-body-sm text-body-sm text-on-surface-variant hover:text-primary transition-colors" href="/search">Cari Resep</a>
                        <a class="font-body-sm text-body-sm text-on-surface-variant hover:text-primary transition-colors" href="/search?category=1">Makanan Berat</a>
                        <a class="font-body-sm text-body-sm text-on-surface-variant hover:text-primary transition-colors" href="/search?category=2">Cemilan</a>
                    </div>
                    
                    <div class="flex flex-col gap-4">
                        <h4 class="font-label-md text-label-md text-on-surface font-bold uppercase tracking-wider">Bantuan</h4>
                        <a class="font-body-sm text-body-sm text-on-surface-variant hover:text-primary transition-colors" href="/about">Tentang Kami</a>
                        <a class="font-body-sm text-body-sm text-on-surface-variant hover:text-primary transition-colors" href="/privacy">Kebijakan Privasi</a>
                        <a class="font-body-sm text-body-sm text-on-surface-variant hover:text-primary transition-colors" href="/contact">Hubungi Kami</a>
                    </div>
                </div>
            </div>
            
            <div class="border-t border-surface-variant pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="font-label-sm text-label-sm text-on-surface-variant text-center md:text-left">© 2026 BudgetBite. Dikembangkan dengan ❤️. Hak Cipta Dilindungi.</p>
                <div class="flex gap-4 text-on-surface-variant">
                    <a href="#" class="hover:text-primary transition-colors"><span class="material-symbols-outlined text-[20px]" data-icon="public">public</span></a>
                    <a href="#" class="hover:text-primary transition-colors"><span class="material-symbols-outlined text-[20px]" data-icon="share">share</span></a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', async () => {
            const recipeId = {{ $id }};
            const detailContainer = document.getElementById('detailContainer');

            // Format Ribuan ke Rupiah
            const formatRupiah = (angka) => {
                return new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0,
                    maximumFractionDigits: 0
                }).format(angka);
            };

            try {
                const response = await fetch(`/api/recipes/${recipeId}`);
                
                if (!response.ok) throw new Error('Recipe not found or API Error');
                
                const responseData = await response.json();
                const recipe = responseData.data;

                const fallbackImg = 'https://images.unsplash.com/photo-1495195134817-aeb325a55b65?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80';
                const imgUrl = recipe.image_url || fallbackImg;
                
                let ingredientsListHtml = '';
                let totalPrice = 0;
                
                if (recipe.ingredients && recipe.ingredients.length > 0) {
                    ingredientsListHtml = recipe.ingredients.map(ing => {
                        const pivot        = ing.pivot || {};
                        const requiredQty  = (pivot.required_qty && pivot.required_qty > 0) ? pivot.required_qty : null;
                        const baseQty      = (ing.base_qty && ing.base_qty > 0) ? ing.base_qty : null;
                        const pricePerUnit = parseFloat(ing.price_per_unit || 0);
                        const rawUnit      = (ing.unit || 'gram').toLowerCase();

                        let displayUnit;
                        if (rawUnit === 'kg' || rawUnit === 'kilogram') {
                            displayUnit = 'gram';
                        } else if (rawUnit === 'liter' || rawUnit === 'l') {
                            displayUnit = 'ml';
                        } else {
                            displayUnit = ing.unit || 'gram';
                        }

                        let ingPrice;
                        let takaranLabel;
                        let priceFormula;

                        if (requiredQty && baseQty && pricePerUnit > 0) {
                            ingPrice     = (requiredQty / baseQty) * pricePerUnit;
                            takaranLabel = `${requiredQty} ${displayUnit}`;
                            priceFormula = `(${requiredQty}/${baseQty}) &times; ${formatRupiah(pricePerUnit)}`;
                        } else {
                            ingPrice     = parseFloat(pivot.total_price_for_this_recipe || 0);
                            takaranLabel = `${parseFloat(pivot.quantity || 0)} ${displayUnit}`;
                            priceFormula = null;
                        }

                        totalPrice += ingPrice;

                        return `
                        <div class="group flex items-center justify-between p-3 rounded-lg hover:bg-surface-container-low transition-colors duration-200 border border-transparent hover:border-surface-variant relative cursor-help">
                            <div class="flex items-center gap-3">
                                <span class="material-symbols-outlined text-primary/70" data-icon="radio_button_unchecked">radio_button_unchecked</span>
                                <div>
                                    <span class="font-body-md text-body-md text-on-surface block">${ing.name}</span>
                                    <span class="font-label-sm text-label-sm text-on-surface-variant block">${takaranLabel}</span>
                                </div>
                            </div>
                            <div class="text-right">
                                <span class="font-label-md text-label-md text-primary bg-primary-container/10 px-2 py-1 rounded">${formatRupiah(ingPrice)}</span>
                            </div>
                            ${priceFormula ? `
                            <div class="absolute bottom-full right-0 mb-2 w-64 bg-inverse-surface text-inverse-on-surface p-3 rounded-lg shadow-lg opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none z-30">
                                <div class="font-label-sm text-label-sm font-bold mb-1 border-b border-surface-variant/30 pb-1">Kalkulasi DSS</div>
                                <div class="font-label-sm text-label-sm">Formula: ${priceFormula}</div>
                            </div>
                            ` : ''}
                        </div>
                        `;
                    }).join('');
                } else {
                    ingredientsListHtml = '<div class="text-on-surface-variant font-label-md italic py-4">Belum ada bahan yang ditambahkan.</div>';
                }

                // Format instructions
                const instructionsHtml = recipe.instructions.split('\n').filter(line => line.trim() !== '').map((line, index) => `
                <div class="relative z-10 flex gap-6 items-start">
                    <div class="shrink-0 w-12 h-12 rounded-full ${index === 0 ? 'bg-primary text-on-primary' : 'bg-surface-container-high text-on-surface-variant'} flex items-center justify-center font-headline-md text-headline-md shadow-sm border border-surface-variant">
                        ${index + 1}
                    </div>
                    <div class="bg-surface-container-lowest p-5 rounded-xl shadow-[0_4px_20px_rgba(0,0,0,0.04)] border border-surface-variant/50 w-full hover:shadow-[0_8px_32px_rgba(0,0,0,0.08)] hover:-translate-y-1 transition-all duration-300">
                        <p class="font-body-md text-body-md text-on-surface-variant">${line}</p>
                    </div>
                </div>
                `).join('');

                detailContainer.innerHTML = `
                    <!-- Hero Section -->
                    <header class="relative w-full h-[512px] min-h-[400px] flex items-end">
                        <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('${imgUrl}')"></div>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent"></div>
                        <div class="relative w-full max-w-container-max mx-auto px-gutter pb-lg z-10">
                            <span class="inline-block bg-secondary-container/90 text-on-secondary-container font-label-sm text-label-sm px-3 py-1 rounded-full mb-4 backdrop-blur-sm shadow-sm">
                                <span class="material-symbols-outlined text-[14px] align-text-bottom mr-1" data-icon="category">category</span>
                                ${recipe.category ? recipe.category.name : 'Tanpa Kategori'}
                            </span>
                            <h1 class="font-display-lg text-display-lg text-white mb-2 text-shadow">${recipe.title}</h1>
                            ${recipe.description ? `<p class="font-body-lg text-body-lg text-white/90 max-w-2xl text-shadow">${recipe.description}</p>` : ''}
                        </div>
                    </header>

                    <!-- Main Content Area -->
                    <div class="max-w-container-max mx-auto px-gutter py-lg">
                        <!-- Summary Info Panel (Bento-style) -->
                        <div class="glass-panel -mt-20 relative z-20 rounded-xl p-6 shadow-[0_12px_32px_rgba(0,0,0,0.08)] mb-lg flex flex-col md:flex-row gap-6 justify-between items-center bg-white/90">
                            <div class="flex gap-8 items-center w-full md:w-auto overflow-x-auto pb-2 md:pb-0 hide-scrollbar">
                                <div class="flex items-center gap-3 min-w-max">
                                    <div class="w-10 h-10 rounded-full bg-surface-container-low flex items-center justify-center text-primary">
                                        <span class="material-symbols-outlined" data-icon="category" style="font-variation-settings: 'FILL' 1;">category</span>
                                    </div>
                                    <div>
                                        <div class="font-label-sm text-label-sm text-on-surface-variant">Kategori</div>
                                        <div class="font-label-md text-label-md text-on-surface">${recipe.category ? recipe.category.name : 'Umum'}</div>
                                    </div>
                                </div>
                                <div class="w-px h-10 bg-surface-variant hidden md:block"></div>
                                <div class="flex items-center gap-3 min-w-max">
                                    <div class="w-10 h-10 rounded-full bg-surface-container-low flex items-center justify-center text-primary">
                                        <span class="material-symbols-outlined" data-icon="timer" style="font-variation-settings: 'FILL' 1;">timer</span>
                                    </div>
                                    <div>
                                        <div class="font-label-sm text-label-sm text-on-surface-variant">Waktu Masak</div>
                                        <div class="font-label-md text-label-md text-on-surface">${recipe.cooking_time || '-'} Menit</div>
                                    </div>
                                </div>
                                <div class="w-px h-10 bg-surface-variant hidden md:block"></div>
                                <div class="flex items-center gap-3 min-w-max">
                                    <div class="w-10 h-10 rounded-full bg-surface-container-low flex items-center justify-center text-primary">
                                        <span class="material-symbols-outlined" data-icon="group" style="font-variation-settings: 'FILL' 1;">group</span>
                                    </div>
                                    <div>
                                        <div class="font-label-sm text-label-sm text-on-surface-variant">Porsi</div>
                                        <div class="font-label-md text-label-md text-on-surface">${recipe.portions || '-'} Orang</div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Prominent DSS Cost Box -->
                            <div class="bg-primary-container/20 border border-primary-container rounded-xl p-4 flex flex-col items-center md:items-end min-w-[200px] w-full md:w-auto">
                                <div class="font-label-sm text-label-sm text-primary mb-1 flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[16px]" data-icon="calculate">calculate</span>
                                    Estimasi Biaya DSS
                                </div>
                                <div class="font-headline-md text-headline-md text-on-surface mb-1">${formatRupiah(totalPrice)}</div>
                                <div class="font-label-sm text-label-sm text-on-surface-variant">${recipe.portions ? `~${formatRupiah(totalPrice / recipe.portions)} / porsi` : ''}</div>
                            </div>
                        </div>

                        <!-- Two Column Layout -->
                        <div class="grid grid-cols-1 md:grid-cols-12 gap-lg mb-xl">
                            <!-- Left Column: Ingredients -->
                            <section class="md:col-span-5">
                                <div class="flex items-center justify-between mb-6">
                                    <h2 class="font-headline-md text-headline-md text-on-surface">Bahan-bahan</h2>
                                    <span class="font-label-sm text-label-sm bg-surface-container-high px-3 py-1 rounded-full text-on-surface-variant">${recipe.ingredients ? recipe.ingredients.length : 0} Item</span>
                                </div>
                                <div class="space-y-3">
                                    ${ingredientsListHtml}
                                </div>
                            </section>
                            
                            <!-- Right Column: Instructions -->
                            <section class="md:col-span-7 pl-0 md:pl-md border-t md:border-t-0 md:border-l border-surface-variant pt-8 md:pt-0">
                                <h2 class="font-headline-md text-headline-md text-on-surface mb-6 flex items-center gap-2">
                                    <span class="material-symbols-outlined text-primary" data-icon="restaurant_menu">restaurant_menu</span>
                                    Langkah Memasak
                                </h2>
                                <div class="space-y-8 relative before:absolute before:inset-0 before:ml-6 before:-translate-x-px md:before:mx-auto md:before:translate-x-0 before:h-full before:w-0.5 before:bg-gradient-to-b before:from-primary/30 before:via-primary/30 before:to-transparent before:z-0">
                                    ${instructionsHtml}
                                </div>
                            </section>
                        </div>

                        <!-- Reviews Section -->
                        <div class="border-t border-surface-variant pt-lg mt-lg">
                            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
                                <h3 class="font-headline-md text-headline-md text-on-surface flex items-center gap-2">
                                    <span class="material-symbols-outlined text-primary" data-icon="star">star</span> Ulasan & Rating
                                </h3>
                                <button onclick="toggleReviewForm()" class="px-5 py-2.5 bg-primary hover:bg-primary/90 text-on-primary font-label-md text-label-md rounded-xl transition-colors shadow-sm">
                                    + Tulis Ulasan
                                </button>
                            </div>

                            <!-- Rating Breakdown -->
                            <div id="ratingBreakdownContainer" class="mb-10 flex flex-col md:flex-row items-center gap-8 bg-surface-container-lowest p-6 rounded-2xl border border-surface-variant shadow-sm">
                                <div class="text-center">
                                    <p class="font-display-lg text-display-lg text-on-surface" id="averageRatingText">0.0</p>
                                    <div class="flex text-tertiary-fixed-dim text-2xl justify-center my-2" id="averageStars">
                                        ★★★★★
                                    </div>
                                    <p class="font-label-sm text-label-sm text-on-surface-variant"><span id="totalReviewsText">0</span> Ulasan</p>
                                </div>
                                <div class="flex-grow w-full space-y-2" id="breakdownBars">
                                    <!-- Bars will be inserted here -->
                                </div>
                            </div>

                            <!-- Review Form (Hidden by default) -->
                            <div id="reviewFormContainer" class="hidden bg-surface-container-lowest p-6 md:p-8 rounded-3xl shadow-lg border border-surface-variant mb-10 transition-all">
                                <h4 class="font-headline-md text-headline-md text-on-surface mb-4">Bagikan Pengalamanmu</h4>
                                <form id="reviewForm" onsubmit="submitReview(event)">
                                    <div class="mb-4">
                                        <label class="block font-label-sm text-label-sm text-on-surface-variant mb-2">Rating</label>
                                        <div class="flex text-3xl cursor-pointer text-surface-variant gap-1" id="starSelection">
                                            <span data-value="1" class="hover:text-tertiary-fixed-dim">★</span>
                                            <span data-value="2" class="hover:text-tertiary-fixed-dim">★</span>
                                            <span data-value="3" class="hover:text-tertiary-fixed-dim">★</span>
                                            <span data-value="4" class="hover:text-tertiary-fixed-dim">★</span>
                                            <span data-value="5" class="hover:text-tertiary-fixed-dim">★</span>
                                        </div>
                                        <input type="hidden" name="rating" id="ratingInput" required>
                                    </div>
                                    <div class="mb-4">
                                        <label class="block font-label-sm text-label-sm text-on-surface-variant mb-2">Komentar (Opsional)</label>
                                        <textarea name="comment" rows="3" class="w-full px-4 py-3 rounded-xl border border-outline-variant focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all bg-surface-container-lowest text-on-surface placeholder-on-surface-variant" placeholder="Gimana rasa resep ini?"></textarea>
                                    </div>
                                    <div class="mb-6">
                                        <label class="block font-label-sm text-label-sm text-on-surface-variant mb-2">Foto Hasil (Opsional)</label>
                                        <input type="file" name="photo" accept="image/*" class="w-full font-label-sm text-label-sm text-on-surface-variant file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:font-label-sm file:bg-primary-container file:text-on-primary-container hover:file:opacity-90">
                                    </div>
                                    <div class="flex justify-end gap-3">
                                        <button type="button" onclick="toggleReviewForm()" class="px-5 py-2.5 text-on-surface-variant font-label-md text-label-md hover:bg-surface-variant rounded-xl transition-colors">Batal</button>
                                        <button type="submit" id="submitReviewBtn" class="px-6 py-2.5 bg-primary hover:bg-primary/90 text-on-primary font-label-md text-label-md rounded-xl shadow-md transition-colors">Kirim Ulasan</button>
                                    </div>
                                </form>
                            </div>

                            <!-- Review List -->
                            <div id="reviewsList" class="space-y-6">
                                <div class="text-center py-10 text-on-surface-variant">Memuat ulasan...</div>
                            </div>
                        </div>
                    </div>
                `;

            } catch (error) {
                detailContainer.innerHTML = `
                    <div class="bg-error-container border border-error rounded-3xl p-10 text-center max-w-xl mx-auto shadow-sm mt-16">
                        <div class="text-error text-6xl mb-4">⚠️</div>
                        <h3 class="text-on-error-container font-headline-lg text-headline-lg mb-2">Resep Tidak Ditemukan</h3>
                        <p class="text-error mb-6">${error.message}</p>
                        <a href="/search" class="inline-flex items-center px-6 py-3 bg-error hover:bg-error/90 text-on-error font-label-md text-label-md rounded-xl transition-colors">
                            Kembali ke Pencarian
                        </a>
                    </div>
                `;
            }

            // Load Reviews
            if (recipeId) {
                loadReviews(recipeId);
                setupStarSelection();
            }
        });

        // Review Functions
        let currentRecipeId = {{ $id }};

        async function loadReviews(id) {
            try {
                const response = await fetch(`/api/recipes/${id}/reviews`);
                const resData = await response.json();
                if(resData.status === 'success') {
                    renderReviews(resData.data);
                }
            } catch (e) {
                console.error("Failed to load reviews", e);
            }
        }

        function renderReviews(data) {
            // Update Breakdown
            document.getElementById('averageRatingText').textContent = data.average_rating;
            document.getElementById('totalReviewsText').textContent = data.breakdown.total;
            
            // Stars graphic
            let starsHtml = '';
            for(let i=1; i<=5; i++) {
                starsHtml += i <= Math.round(data.average_rating) ? '★' : '<span class="text-surface-variant">★</span>';
            }
            document.getElementById('averageStars').innerHTML = starsHtml;

            // Breakdown Bars
            let barsHtml = '';
            for(let i=5; i>=1; i--) {
                const stat = data.breakdown.stars[i];
                barsHtml += `
                    <div class="flex items-center text-sm gap-2">
                        <span class="w-4 text-on-surface-variant font-medium">${i}</span>
                        <span class="text-tertiary-fixed-dim">★</span>
                        <div class="w-full bg-surface-variant rounded-full h-2.5">
                            <div class="bg-tertiary-fixed-dim h-2.5 rounded-full" style="width: ${stat.percentage}%"></div>
                        </div>
                        <span class="w-8 text-right text-on-surface-variant text-xs">${stat.count}</span>
                    </div>
                `;
            }
            document.getElementById('breakdownBars').innerHTML = barsHtml;

            // Review List
            const listContainer = document.getElementById('reviewsList');
            if(data.reviews.data.length === 0) {
                listContainer.innerHTML = '<div class="text-center py-10 bg-surface-container-lowest rounded-2xl border border-surface-variant"><p class="text-on-surface-variant font-label-md text-label-md mb-2">Belum ada ulasan</p><p class="text-on-surface-variant text-sm">Jadilah yang pertama mencoba dan memberikan ulasan!</p></div>';
                return;
            }

            let reviewsHtml = data.reviews.data.map(review => {
                let rStars = '';
                for(let i=1; i<=5; i++) rStars += i <= review.rating ? '★' : '☆';
                
                const likeIcon = review.has_liked ? '👍 Ditandai Membantu' : '👍 Membantu?';
                const likeClass = review.has_liked ? 'text-primary bg-primary-container/20' : 'text-on-surface-variant hover:bg-surface-variant';

                return `
                    <div class="bg-surface-container-lowest p-6 rounded-2xl border border-surface-variant shadow-sm relative">
                        ${review.is_featured ? '<div class="absolute -top-3 right-6 bg-gradient-to-r from-tertiary-fixed-dim to-primary text-on-primary text-xs font-bold px-3 py-1 rounded-full shadow-md">🌟 Featured</div>' : ''}
                        <div class="flex justify-between items-start mb-3">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-surface-container-high flex items-center justify-center text-on-surface-variant font-bold uppercase">
                                    ${review.user.name.charAt(0)}
                                </div>
                                <div>
                                    <p class="font-label-md text-label-md text-on-surface">${review.user.name}</p>
                                    <div class="flex items-center gap-2">
                                        <span class="text-tertiary-fixed-dim text-sm">${rStars}</span>
                                        <span class="text-xs text-on-surface-variant">• ${new Date(review.created_at).toLocaleDateString('id-ID')}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        ${review.comment ? `<p class="font-body-md text-body-md text-on-surface mt-3">${review.comment}</p>` : ''}
                        
                        ${review.photo_path ? `<img src="${review.photo_path}" class="mt-4 rounded-xl max-h-64 object-cover border border-surface-variant">` : ''}
                        
                        ${review.admin_reply ? `
                            <div class="mt-4 bg-surface-container-low border-l-4 border-secondary p-4 rounded-r-xl">
                                <p class="text-xs font-bold text-on-surface uppercase tracking-wider mb-1">Balasan Kreator</p>
                                <p class="font-body-sm text-body-sm text-on-surface-variant">${review.admin_reply}</p>
                            </div>
                        ` : ''}

                        <div class="mt-5 flex gap-4 border-t border-surface-variant pt-4">
                            <button onclick="toggleLike(${review.id})" class="flex items-center gap-1.5 font-label-sm text-label-sm px-3 py-1.5 rounded-lg transition-colors ${likeClass}">
                                <span>${likeIcon}</span>
                                <span class="bg-surface/50 px-1.5 rounded text-xs">${review.likes_count}</span>
                            </button>
                        </div>
                    </div>
                `;
            }).join('');
            
            listContainer.innerHTML = reviewsHtml;
        }

        function toggleReviewForm() {
            const form = document.getElementById('reviewFormContainer');
            form.classList.toggle('hidden');
        }

        function setupStarSelection() {
            const stars = document.querySelectorAll('#starSelection span');
            const input = document.getElementById('ratingInput');
            stars.forEach(star => {
                star.addEventListener('click', () => {
                    const val = parseInt(star.getAttribute('data-value'));
                    input.value = val;
                    stars.forEach((s, idx) => {
                        if(idx < val) {
                            s.classList.remove('text-surface-variant');
                            s.classList.add('text-tertiary-fixed-dim');
                        } else {
                            s.classList.add('text-surface-variant');
                            s.classList.remove('text-tertiary-fixed-dim');
                        }
                    });
                });
            });
        }

        async function submitReview(e) {
            e.preventDefault();
            const btn = document.getElementById('submitReviewBtn');
            const form = document.getElementById('reviewForm');
            const formData = new FormData(form);

            if(!formData.get('rating')) {
                alert('Pilih bintang rating terlebih dahulu!');
                return;
            }

            btn.disabled = true;
            btn.innerHTML = 'Mengirim...';

            try {
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                const response = await fetch(`/recipes/${currentRecipeId}/reviews`, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                    }
                });
                
                const result = await response.json();
                
                if(response.ok && result.status === 'success') {
                    alert('Ulasan berhasil dikirim!');
                    form.reset();
                    document.querySelectorAll('#starSelection span').forEach(s => {
                        s.classList.add('text-surface-variant');
                        s.classList.remove('text-tertiary-fixed-dim');
                    });
                    document.getElementById('ratingInput').value = '';
                    toggleReviewForm();
                    loadReviews(currentRecipeId); 
                } else if(response.status === 401) {
                    alert('Anda harus login untuk memberikan ulasan.');
                    window.location.href = '/login';
                } else {
                    alert('Gagal mengirim ulasan: ' + (result.message || 'Error'));
                }
            } catch (err) {
                alert('Terjadi kesalahan jaringan.');
            } finally {
                btn.disabled = false;
                btn.innerHTML = 'Kirim Ulasan';
            }
        }

        async function toggleLike(reviewId) {
            try {
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                const response = await fetch(`/reviews/${reviewId}/like`, {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                    }
                });
                
                if(response.status === 401) {
                    alert('Anda harus login untuk menyukai ulasan.');
                    window.location.href = '/login';
                    return;
                }
                
                if(response.ok) {
                    loadReviews(currentRecipeId); 
                }
            } catch (err) {
                console.error(err);
            }
        }
    </script>
    <script>
        function toggleProfileMenu() {
            document.getElementById('profileMenu').classList.toggle('hidden');
        }
        document.addEventListener('click', function(e) {
            const wrapper = document.getElementById('profileDropdownWrapper');
            if (wrapper && !wrapper.contains(e.target)) {
                const menu = document.getElementById('profileMenu');
                if(menu) menu.classList.add('hidden');
            }
        });
    </script>
</body>
</html>

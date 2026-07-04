<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Pencarian Resep - BudgetBite</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
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
                      "headline-md": ["Plus Jakarta Sans", "sans-serif"],
                      "headline-lg-mobile": ["Plus Jakarta Sans", "sans-serif"],
                      "label-md": ["Plus Jakarta Sans", "sans-serif"],
                      "headline-lg": ["Plus Jakarta Sans", "sans-serif"],
                      "body-md": ["Plus Jakarta Sans", "sans-serif"],
                      "display-lg": ["Plus Jakarta Sans", "sans-serif"],
                      "body-lg": ["Plus Jakarta Sans", "sans-serif"],
                      "label-sm": ["Plus Jakarta Sans", "sans-serif"]
              },
              "fontSize": {
                      "headline-md": ["24px", { "lineHeight": "32px", "fontWeight": "600" }],
                      "headline-lg-mobile": ["28px", { "lineHeight": "36px", "fontWeight": "700" }],
                      "label-md": ["14px", { "lineHeight": "20px", "letterSpacing": "0.01em", "fontWeight": "600" }],
                      "headline-lg": ["32px", { "lineHeight": "40px", "letterSpacing": "-0.01em", "fontWeight": "700" }],
                      "body-md": ["16px", { "lineHeight": "24px", "fontWeight": "400" }],
                      "display-lg": ["48px", { "lineHeight": "56px", "letterSpacing": "-0.02em", "fontWeight": "800" }],
                      "body-lg": ["18px", { "lineHeight": "28px", "fontWeight": "400" }],
                      "label-sm": ["12px", { "lineHeight": "16px", "fontWeight": "700" }]
              }
            }
          }
        }
    </script>
    <style>
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #d0dbed; border-radius: 4px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #8a7266; }
    </style>
</head>
<body class="bg-surface text-on-surface font-body-md text-body-md antialiased pt-16 min-h-screen flex flex-col">
    <!-- TopNavBar -->
    <nav class="bg-surface/80 dark:bg-surface/80 backdrop-blur-md shadow-sm fixed top-0 w-full z-50 flex justify-between items-center px-gutter max-w-container-max mx-auto h-16 left-0 right-0">
        <div class="flex items-center gap-xl">
            <a class="font-headline-md text-headline-md font-bold text-primary dark:text-primary-fixed flex items-center gap-2" href="/search">
                <img src="/images/logo.png" alt="BudgetBite Logo" class="h-8 w-8 object-contain rounded-lg"> BudgetBite
            </a>
            <div class="hidden md:flex gap-md">
                <a class="font-label-md text-label-md text-primary dark:text-primary-fixed border-b-2 border-primary pb-1 hover:bg-surface-container-low transition-colors duration-200" href="/search">Cari Resep</a>
            </div>
        </div>
        <div class="flex items-center gap-md">
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
            <a href="/login" class="font-label-md text-label-md bg-primary-container text-on-primary-container px-4 py-2 rounded-full hover:opacity-90 transition-opacity">Login/Register</a>
            @endauth
        </div>
    </nav>

    <main class="w-full flex-grow">
        <!-- Hero & DSS Budget Feature -->
        <section class="max-w-container-max mx-auto px-gutter py-xl">
            <div class="text-center max-w-3xl mx-auto mb-lg">
                <h1 class="font-display-lg text-display-lg text-on-surface mb-md">Masak Hemat, Rasa Lezat dengan BudgetBite</h1>
                <p class="font-body-lg text-body-lg text-on-surface-variant">Temukan resep harian berkualitas tinggi yang sesuai dengan anggaran Anda. Solusi cerdas untuk perencanaan makan yang hemat dan lezat.</p>
            </div>
            
            <!-- DSS Search Panel (Bento-style Glassmorphism) -->
            <form id="searchForm" class="bg-white/70 backdrop-blur-lg border border-surface-variant rounded-xl p-md shadow-[0_12px_32px_rgba(0,0,0,0.08)] flex flex-col gap-lg max-w-4xl mx-auto hover:shadow-[0_16px_40px_rgba(0,0,0,0.1)] transition-shadow duration-300">
                <div class="flex flex-col gap-sm">
                    <label class="font-label-md text-label-md text-on-surface" for="maxBudget">Anggaran Maksimal (Total Biaya)</label>
                    <div class="relative flex items-center">
                        <span class="absolute left-4 font-label-md text-label-md text-on-surface-variant">Rp</span>
                        <input type="number" id="maxBudget" name="max_budget" placeholder="Contoh: 50000" min="0" step="1000" required class="w-full pl-12 pr-4 py-3 bg-surface-container-low border border-surface-container-high rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition-all font-body-md text-body-md text-on-surface outline-none placeholder-outline">
                    </div>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-md" id="categoryGroup">
                    <!-- Semua Kategori -->
                    <label class="cursor-pointer">
                        <input checked class="peer sr-only category-radio" name="category" type="radio" value=""/>
                        <div class="flex items-center justify-center gap-2 p-4 rounded-xl border border-surface-container-high bg-surface-bright peer-checked:bg-secondary-container/20 peer-checked:border-secondary peer-checked:text-on-secondary-container hover:bg-surface-container-low transition-all duration-200">
                            <span class="material-symbols-outlined" data-icon="restaurant">restaurant</span>
                            <span class="font-label-md text-label-md">Semua</span>
                        </div>
                    </label>
                    <!-- Category 1 -->
                    <label class="cursor-pointer">
                        <input class="peer sr-only category-radio" name="category" type="radio" value="1"/>
                        <div class="flex items-center justify-center gap-2 p-4 rounded-xl border border-surface-container-high bg-surface-bright peer-checked:bg-secondary-container/20 peer-checked:border-secondary peer-checked:text-on-secondary-container hover:bg-surface-container-low transition-all duration-200">
                            <span class="material-symbols-outlined" data-icon="lunch_dining">lunch_dining</span>
                            <span class="font-label-md text-label-md">Makanan Berat</span>
                        </div>
                    </label>
                    <!-- Category 2 -->
                    <label class="cursor-pointer">
                        <input class="peer sr-only category-radio" name="category" type="radio" value="2"/>
                        <div class="flex items-center justify-center gap-2 p-4 rounded-xl border border-surface-container-high bg-surface-bright peer-checked:bg-secondary-container/20 peer-checked:border-secondary peer-checked:text-on-secondary-container hover:bg-surface-container-low transition-all duration-200">
                            <span class="material-symbols-outlined" data-icon="tapas">tapas</span>
                            <span class="font-label-md text-label-md">Ringan / Cemilan</span>
                        </div>
                    </label>
                    <!-- Category 3 -->
                    <label class="cursor-pointer">
                        <input class="peer sr-only category-radio" name="category" type="radio" value="3"/>
                        <div class="flex items-center justify-center gap-2 p-4 rounded-xl border border-surface-container-high bg-surface-bright peer-checked:bg-secondary-container/20 peer-checked:border-secondary peer-checked:text-on-secondary-container hover:bg-surface-container-low transition-all duration-200">
                            <span class="material-symbols-outlined" data-icon="icecream">icecream</span>
                            <span class="font-label-md text-label-md">Penutup</span>
                        </div>
                    </label>
                </div>
                
                <button type="submit" class="w-full bg-primary text-on-primary font-headline-md text-headline-md py-4 rounded-full flex items-center justify-center gap-2 hover:opacity-90 hover:scale-[1.02] transition-all duration-200 shadow-sm">
                    <span class="material-symbols-outlined" data-icon="search">search</span>
                    Cari Resep Terbaik
                </button>
            </form>
        </section>

        <!-- Recipe Grid -->
        <section class="max-w-container-max mx-auto px-gutter pb-xl w-full">
            <h2 class="font-headline-lg text-headline-lg text-on-surface mb-md">Rekomendasi Berdasarkan Budget Anda</h2>
            
            <!-- Loading State -->
            <div id="loadingIndicator" class="hidden flex flex-col items-center justify-center py-20">
                <div class="w-12 h-12 border-4 border-primary/30 border-t-primary rounded-full animate-spin mb-4"></div>
                <p class="text-on-surface-variant font-label-md text-label-md">Meracik resep terbaik untukmu...</p>
            </div>

            <!-- Error State -->
            <div id="errorMessage" class="hidden bg-error-container border border-error/50 rounded-2xl p-6 text-center max-w-md mx-auto">
                <div class="text-error text-3xl mb-2">⚠️</div>
                <h3 class="text-on-error-container font-bold mb-1">Terjadi Kesalahan</h3>
                <p class="text-error text-sm">Gagal mengambil data dari server. Silakan coba beberapa saat lagi.</p>
            </div>

            <!-- Empty State -->
            <div id="noResults" class="hidden flex flex-col items-center justify-center py-20 text-center">
                <div class="text-6xl mb-6">😕</div>
                <h3 class="text-2xl font-bold text-on-surface mb-2">Oops, tidak ada resep yang cocok.</h3>
                <p class="text-on-surface-variant">Coba naikkan budget atau ganti kategori makanan.</p>
            </div>

            <!-- Grid Container -->
            <div id="resultsContainer" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-md">
                <!-- Dynamic Recipe Cards will be injected here -->
            </div>
        </section>
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
        function toggleProfileMenu() {
            document.getElementById('profileMenu').classList.toggle('hidden');
        }
        document.addEventListener('click', function(e) {
            const wrapper = document.getElementById('profileDropdownWrapper');
            if (wrapper && !wrapper.contains(e.target)) {
                const menu = document.getElementById('profileMenu');
                if (menu) menu.classList.add('hidden');
            }
        });
    </script>
    
    <!-- JavaScript logic -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const searchForm = document.getElementById('searchForm');
            const resultsContainer = document.getElementById('resultsContainer');
            const loadingIndicator = document.getElementById('loadingIndicator');
            const noResults = document.getElementById('noResults');
            const errorMessage = document.getElementById('errorMessage');

            const formatRupiah = (angka) => {
                return new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0,
                    maximumFractionDigits: 0
                }).format(angka);
            };

            const fetchRecipes = async (maxBudget, categoryId) => {
                resultsContainer.innerHTML = '';
                noResults.classList.add('hidden');
                errorMessage.classList.add('hidden');
                loadingIndicator.classList.remove('hidden');
                try {
                    const params = new URLSearchParams();
                    if(maxBudget) params.append('max_budget', maxBudget);
                    if(categoryId) params.append('category_id', categoryId);
                    const response = await fetch('/api/recipes/search?' + params.toString() + '&t=' + new Date().getTime(), { 
                        cache: 'no-store',
                        headers: { 'Accept': 'application/json' }
                    });
                    if (!response.ok) throw new Error('API Error');
                    const responseData = await response.json();
                    const recipes = responseData.data || [];
                    loadingIndicator.classList.add('hidden');
                    if (recipes.length === 0) { noResults.classList.remove('hidden'); return; }
                    renderRecipes(recipes);
                } catch (error) {
                    console.error('Error fetching recipes:', error);
                    loadingIndicator.classList.add('hidden');
                    errorMessage.classList.remove('hidden');
                    errorMessage.innerHTML = '<div>Error: ' + error.message + '</div>';
                }
            };

            const fetchAllRecipes = async () => {
                resultsContainer.innerHTML = '';
                noResults.classList.add('hidden');
                errorMessage.classList.add('hidden');
                loadingIndicator.classList.remove('hidden');
                try {
                    const response = await fetch('/api/recipes?t=' + new Date().getTime(), { 
                        cache: 'no-store',
                        headers: { 'Accept': 'application/json' }
                    });
                    if (!response.ok) throw new Error('API Error');
                    const responseData = await response.json();
                    loadingIndicator.classList.add('hidden');
                    if (!responseData.success || !responseData.data || responseData.data.length === 0) {
                        noResults.classList.remove('hidden'); return;
                    }
                    const recipes = responseData.data.map(recipe => ({
                        id: recipe.id,
                        title: recipe.title,
                        image_url: recipe.image_url,
                        category_name: recipe.category ? recipe.category.name : 'Tanpa Kategori',
                        // Formula DSS: (required_qty / base_qty) * price_per_unit
                        total_dynamic_price: recipe.ingredients
                            ? recipe.ingredients.reduce((sum, ing) => {
                                const pivot       = ing.pivot || {};
                                const requiredQty = (pivot.required_qty && pivot.required_qty > 0) ? pivot.required_qty : null;
                                const baseQty     = (ing.base_qty && ing.base_qty > 0) ? ing.base_qty : null;
                                const pricePerUnit = parseFloat(ing.price_per_unit || 0);
                                if (requiredQty && baseQty) {
                                    return sum + (requiredQty / baseQty) * pricePerUnit;
                                }
                                return sum + parseFloat(pivot.total_price_for_this_recipe || 0);
                            }, 0)
                            : 0,
                        ingredients: recipe.ingredients ? recipe.ingredients.map(ing => ({
                            name:         ing.name,
                            quantity:     (ing.pivot && ing.pivot.quantity)     ? ing.pivot.quantity     : 0,
                            required_qty: (ing.pivot && ing.pivot.required_qty) ? ing.pivot.required_qty : 0,
                            unit:         ing.unit || 'unit'
                        })) : []
                    }));
                    renderRecipes(recipes);
                } catch (error) {
                    console.error('Error fetching all recipes:', error);
                    loadingIndicator.classList.add('hidden');
                    errorMessage.classList.remove('hidden');
                    errorMessage.innerHTML = '<div>Error: ' + error.message + '</div>';
                }
            };

            const renderRecipes = (recipes) => {
                const fallbackImg = 'https://images.unsplash.com/photo-1495195134817-aeb325a55b65?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80';
                resultsContainer.innerHTML = recipes.map(recipe => {
                    const imgUrl = recipe.image_url || fallbackImg;
                    const displayPrice = (recipe.total_dynamic_price !== undefined && recipe.total_dynamic_price !== null)
                        ? recipe.total_dynamic_price
                        : (recipe.total_price || 0);

                    // Category icons helper
                    let catIcon = 'local_dining';
                    let catBadgeClass = 'bg-tertiary-fixed text-on-tertiary-fixed';
                    if (recipe.category_name.toLowerCase().includes('ringan')) {
                        catIcon = 'tapas';
                        catBadgeClass = 'bg-surface-container-high text-on-surface';
                    } else if (recipe.category_name.toLowerCase().includes('penutup')) {
                        catIcon = 'icecream';
                        catBadgeClass = 'bg-surface-container-highest text-on-surface';
                    }

                    // Buat string ingredients (limit ke 4 saja agar tidak panjang di card kecil)
                    let ingredientsText = 'Tidak ada data bahan';
                    if (recipe.ingredients && recipe.ingredients.length > 0) {
                        const ingNames = recipe.ingredients.map(ing => ing.name);
                        ingredientsText = ingNames.slice(0, 4).join(', ');
                        if (ingNames.length > 4) ingredientsText += ', dll.';
                    }

                    return `
                    <div class="bg-white rounded-xl overflow-hidden shadow-[0_4px_20px_rgba(0,0,0,0.04)] hover:shadow-[0_12px_32px_rgba(0,0,0,0.08)] hover:scale-[1.02] transition-all duration-300 flex flex-col group relative cursor-pointer" onclick="window.location.href='/recipe/${recipe.id}'">
                        <div class="relative h-48 overflow-hidden">
                            <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" src="${imgUrl}" onerror="this.src='${fallbackImg}'" alt="${recipe.title}"/>
                            <div class="absolute top-2 left-2 ${catBadgeClass} font-label-sm text-label-sm px-2 py-1 rounded-full flex items-center gap-1 shadow-sm">
                                <span class="material-symbols-outlined text-[14px]" data-icon="${catIcon}">${catIcon}</span>
                                ${recipe.category_name}
                            </div>
                        </div>
                        <div class="p-md flex flex-col flex-grow">
                            <h3 class="font-headline-md text-headline-md text-on-surface mb-2 line-clamp-2">${recipe.title}</h3>
                            <p class="font-body-md text-body-md text-primary font-bold mb-4">Mulai dari ${formatRupiah(displayPrice)} / porsi</p>
                            
                            <div class="mb-4 flex-grow">
                                <p class="font-label-sm text-label-sm text-on-surface-variant mb-1">Bahan Utama:</p>
                                <p class="font-body-md text-body-md text-on-surface line-clamp-2 text-sm">${ingredientsText}</p>
                            </div>
                            <button class="w-full bg-secondary-container/20 text-on-secondary-container font-label-md text-label-md py-2 rounded-full hover:bg-secondary-container/40 transition-colors">Lihat Detail</button>
                        </div>
                    </div>`;
                }).join('');
            };

            searchForm.addEventListener('submit', (e) => {
                e.preventDefault();
                const maxBudget = document.getElementById('maxBudget').value;
                const checkedCategory = document.querySelector('input[name="category"]:checked');
                const categoryId = checkedCategory ? checkedCategory.value : '';
                
                if (!maxBudget && !categoryId) { 
                    fetchAllRecipes(); 
                } else { 
                    fetchRecipes(maxBudget, categoryId); 
                }
            });

            // Cek URL parameters saat halaman dibuka
            const urlParams = new URLSearchParams(window.location.search);
            const initialCategory = urlParams.get('category');
            
            if (initialCategory) {
                const radio = document.querySelector(`input[name="category"][value="${initialCategory}"]`);
                if (radio) {
                    radio.checked = true;
                }
                fetchRecipes('', initialCategory);
            } else {
                fetchAllRecipes();
            }
        });
    </script>
</body>
</html>
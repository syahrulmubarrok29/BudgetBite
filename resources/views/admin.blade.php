<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Dashboard Admin - BudgetBite</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
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
                    borderRadius: {
                        DEFAULT: "0.25rem",
                        lg: "0.5rem",
                        xl: "0.75rem",
                        full: "9999px"
                    },
                    spacing: {
                        base: "8px",
                        "container-max": "1200px",
                        sm: "12px",
                        xl: "64px",
                        xs: "4px",
                        md: "24px",
                        lg: "40px",
                        gutter: "24px"
                    },
                    fontFamily: {
                        "headline-md": ["Plus Jakarta Sans"],
                        "headline-lg-mobile": ["Plus Jakarta Sans"],
                        "label-md": ["Plus Jakarta Sans"],
                        "headline-lg": ["Plus Jakarta Sans"],
                        "body-md": ["Plus Jakarta Sans"],
                        "display-lg": ["Plus Jakarta Sans"],
                        "body-lg": ["Plus Jakarta Sans"],
                        "label-sm": ["Plus Jakarta Sans"]
                    },
                    fontSize: {
                        "headline-md": ["24px", { lineHeight: "32px", fontWeight: "600" }],
                        "headline-lg-mobile": ["28px", { lineHeight: "36px", fontWeight: "700" }],
                        "label-md": ["14px", { lineHeight: "20px", letterSpacing: "0.01em", fontWeight: "600" }],
                        "headline-lg": ["32px", { lineHeight: "40px", letterSpacing: "-0.01em", fontWeight: "700" }],
                        "body-md": ["16px", { lineHeight: "24px", fontWeight: "400" }],
                        "display-lg": ["48px", { lineHeight: "56px", letterSpacing: "-0.02em", fontWeight: "800" }],
                        "body-lg": ["18px", { lineHeight: "28px", fontWeight: "400" }],
                        "label-sm": ["12px", { lineHeight: "16px", fontWeight: "700" }]
                    }
                }
            }
        };
    </script>
    <style>
        .sidebar { transition: all 0.3s ease; }
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
        
        .input-focus-ring:focus { outline: none; box-shadow: 0 0 0 3px rgba(154, 70, 0, 0.15); border-color: #9a4600; }
        
        /* Modal Animation */
        .modal-overlay { opacity: 0; pointer-events: none; transition: opacity 0.2s ease-out; }
        .modal-overlay.active { opacity: 1; pointer-events: auto; }
        .modal-content { transform: scale(0.95); opacity: 0; transition: all 0.2s ease-out; }
        .modal-overlay.active .modal-content { transform: scale(1); opacity: 1; }
    </style>
</head>
<body class="bg-background text-on-background font-body-md min-h-screen flex">
    <!-- SideNavBar -->
    <nav id="sidebar" class="bg-surface-container-low shadow-md fixed left-0 top-0 h-full flex flex-col p-4 space-y-4 w-64 z-50 -translate-x-full md:translate-x-0 transition-transform duration-300">
        <div class="mb-8 px-2 flex items-center gap-sm">
            <img src="/images/logo.png" alt="BudgetBite Logo" class="h-10 w-10 object-contain rounded-full shadow-sm">
            <div>
                <h1 class="font-headline-md text-headline-md font-bold text-primary">Admin Panel</h1>
                <p class="font-label-sm text-label-sm text-on-surface-variant">Manajemen Konten</p>
            </div>
        </div>
        <div class="flex-1 space-y-2">
            <!-- Active Tab: Resep -->
            <a id="nav-recipes" onclick="switchTab('recipes')" class="cursor-pointer bg-secondary-container text-on-secondary-container rounded-xl flex items-center p-3 gap-sm transition-transform duration-150 translate-x-1">
                <span class="material-symbols-outlined" data-icon="restaurant" style="font-variation-settings: 'FILL' 1;">restaurant</span>
                <span class="font-label-md text-label-md">Resep</span>
            </a>
            
            <a id="nav-reviews" onclick="switchTab('reviews')" class="cursor-pointer text-on-surface-variant hover:bg-surface-variant rounded-xl flex items-center p-3 gap-sm hover:bg-surface-variant/50 transition-all duration-200">
                <span class="material-symbols-outlined" data-icon="star">star</span>
                <span class="font-label-md text-label-md">Ulasan</span>
            </a>

            <a id="nav-users" onclick="switchTab('users')" class="cursor-pointer text-on-surface-variant hover:bg-surface-variant rounded-xl flex items-center p-3 gap-sm hover:bg-surface-variant/50 transition-all duration-200">
                <span class="material-symbols-outlined" data-icon="group">group</span>
                <span class="font-label-md text-label-md">Pengguna</span>
            </a>
            
            <a id="nav-categories" onclick="switchTab('categories')" class="cursor-pointer text-on-surface-variant hover:bg-surface-variant rounded-xl flex items-center p-3 gap-sm hover:bg-surface-variant/50 transition-all duration-200">
                <span class="material-symbols-outlined" data-icon="category">category</span>
                <span class="font-label-md text-label-md">Kategori</span>
            </a>
            <a id="nav-ingredients" onclick="switchTab('ingredients')" class="cursor-pointer text-on-surface-variant hover:bg-surface-variant rounded-xl flex items-center p-3 gap-sm hover:bg-surface-variant/50 transition-all duration-200">
                <span class="material-symbols-outlined" data-icon="kitchen">kitchen</span>
                <span class="font-label-md text-label-md">Bahan</span>
            </a>
            
            <a href="/search" target="_blank" class="cursor-pointer text-on-surface-variant hover:bg-surface-variant rounded-xl flex items-center p-3 gap-sm hover:bg-surface-variant/50 transition-all duration-200">
                <span class="material-symbols-outlined" data-icon="open_in_new">open_in_new</span>
                <span class="font-label-md text-label-md">Kunjungi Web</span>
            </a>
        </div>
        <div class="mt-auto pt-4 flex flex-col gap-2">
            <button onclick="openModal()" id="sidebarAddRecipeBtn" class="w-full bg-primary text-on-primary rounded-full py-3 px-4 font-label-md text-label-md flex items-center justify-center gap-xs shadow-sm hover:shadow-md transition-shadow">
                <span class="material-symbols-outlined" data-icon="add">add</span>
                Tambah Resep
            </button>
            <form action="{{ route('logout') }}" method="POST" class="w-full">
                @csrf
                <button type="submit" class="w-full bg-error-container text-on-error-container rounded-full py-3 px-4 font-label-md text-label-md flex items-center justify-center gap-xs shadow-sm hover:shadow-md transition-shadow">
                    <span class="material-symbols-outlined" data-icon="logout">logout</span>
                    Logout Admin
                </button>
            </form>
        </div>
    </nav>

    <!-- Overlay for Mobile Sidebar -->
    <div id="sidebarOverlay" onclick="toggleSidebar()" class="fixed inset-0 bg-inverse-surface/40 backdrop-blur-sm z-40 hidden md:hidden transition-opacity opacity-0"></div>

    <!-- Main Content Area -->
    <main class="flex-1 md:ml-64 flex flex-col min-h-screen">
        <!-- Top Header for Admin -->
        <header class="bg-surface/80 backdrop-blur-md shadow-sm sticky top-0 z-30 h-16 flex items-center justify-between px-gutter">
            <div class="flex items-center gap-sm md:hidden">
                <span class="material-symbols-outlined text-primary cursor-pointer" data-icon="menu" onclick="toggleSidebar()">menu</span>
                <span class="font-headline-md text-headline-md font-bold text-primary">Admin</span>
            </div>
            
            <!-- Breadcrumbs / Page Title Desktop -->
            <div class="hidden md:flex items-center gap-xs text-on-surface-variant font-label-md text-label-md">
                <span>Admin</span>
                <span class="material-symbols-outlined text-[16px]" data-icon="chevron_right">chevron_right</span>
                <span class="text-primary" id="breadcrumbTitle">Daftar Resep</span>
            </div>
            
            <div class="flex items-center gap-md">
                <div class="relative hidden sm:block">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline" data-icon="search">search</span>
                    <input class="pl-10 pr-4 py-2 bg-surface-container-lowest border border-outline-variant rounded-full text-label-md font-label-md focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-colors w-64" placeholder="Cari..." type="text"/>
                </div>
                <img class="w-10 h-10 rounded-full object-cover border-2 border-surface-container-highest cursor-pointer" src="https://ui-avatars.com/api/?name=Admin&background=random"/>
            </div>
        </header>

        <!-- Content Canvas -->
        <div class="p-gutter lg:p-xl flex-1 max-w-container-max mx-auto w-full">
            
            <!-- Page Header & Actions -->
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-md gap-sm">
                <div>
                    <h2 class="font-headline-lg text-headline-lg text-on-surface mb-xs" id="pageTitle">Semua Resep</h2>
                    <p class="font-body-md text-body-md text-on-surface-variant" id="pageDesc">Kelola database resep, panduan harga, dan kalkulasi nutrisi.</p>
                </div>
                <div class="flex items-center gap-sm w-full sm:w-auto" id="pageActions">
                    <!-- Action Buttons specifically for Recipes/Categories/Ingredients will be injected here if needed, or we just toggle visibility -->
                    <button onclick="openModal()" id="addRecipeBtn2" class="bg-primary text-on-primary rounded-full py-2 px-6 font-label-md text-label-md flex items-center justify-center gap-xs shadow-sm whitespace-nowrap hidden sm:flex">
                        <span class="material-symbols-outlined" data-icon="add">add</span>
                        Resep Baru
                    </button>
                    <button onclick="openCategoryModal()" id="addCategoryBtn" class="hidden bg-primary text-on-primary rounded-full py-2 px-6 font-label-md text-label-md items-center justify-center gap-xs shadow-sm whitespace-nowrap sm:flex">
                        <span class="material-symbols-outlined" data-icon="add">add</span>
                        Kategori Baru
                    </button>
                    <button onclick="openIngredientModal()" id="addIngredientBtn" class="hidden bg-primary text-on-primary rounded-full py-2 px-6 font-label-md text-label-md items-center justify-center gap-xs shadow-sm whitespace-nowrap sm:flex">
                        <span class="material-symbols-outlined" data-icon="add">add</span>
                        Bahan Baru
                    </button>
                </div>
            </div>

            <!-- RECIPES SECTION -->
            <div id="recipesContent">
                <!-- Bento Grid Stats -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-md mb-lg">
                    <div class="bg-surface-container-lowest rounded-xl p-md shadow-[0_4px_20px_rgba(0,0,0,0.04)] flex items-center gap-md">
                        <div class="w-12 h-12 rounded-full bg-secondary-container flex items-center justify-center text-on-secondary-container">
                            <span class="material-symbols-outlined" data-icon="restaurant_menu">restaurant_menu</span>
                        </div>
                        <div>
                            <p class="font-label-sm text-label-sm text-on-surface-variant">Total Resep</p>
                            <p class="font-headline-md text-headline-md text-on-surface" id="statTotalRecipes">-</p>
                        </div>
                    </div>
                    <div class="bg-surface-container-lowest rounded-xl p-md shadow-[0_4px_20px_rgba(0,0,0,0.04)] flex items-center gap-md">
                        <div class="w-12 h-12 rounded-full bg-tertiary-container flex items-center justify-center text-on-tertiary-container">
                            <span class="material-symbols-outlined" data-icon="payments">payments</span>
                        </div>
                        <div>
                            <p class="font-label-sm text-label-sm text-on-surface-variant">Rata-rata Biaya</p>
                            <p class="font-headline-md text-headline-md text-on-surface">-</p>
                        </div>
                    </div>
                    <div class="bg-surface-container-lowest rounded-xl p-md shadow-[0_4px_20px_rgba(0,0,0,0.04)] flex items-center gap-md">
                        <div class="w-12 h-12 rounded-full bg-error-container flex items-center justify-center text-on-error-container">
                            <span class="material-symbols-outlined" data-icon="flag">flag</span>
                        </div>
                        <div>
                            <p class="font-label-sm text-label-sm text-on-surface-variant">Status</p>
                            <p class="font-headline-md text-headline-md text-on-surface">Aktif</p>
                        </div>
                    </div>
                </div>

                <!-- Modern Recipe Table -->
                <div class="bg-surface-container-lowest rounded-xl shadow-[0_4px_20px_rgba(0,0,0,0.04)] overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-surface-container-low border-b border-surface-container-high">
                                    <th class="p-4 font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider">Info Resep</th>
                                    <th class="p-4 font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider">Kategori</th>
                                    <th class="p-4 font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider">Estimasi Biaya (DSS)</th>
                                    <th class="p-4 font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider">Jml Bahan</th>
                                    <th class="p-4 font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="recipeTableBody" class="divide-y divide-surface-container-high">
                                <tr><td colspan="5" class="p-4 text-center">Loading...</td></tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="bg-surface-container-lowest border-t border-surface-container-high p-4 flex items-center justify-end">
                        <!-- Pagination placeholder -->
                    </div>
                </div>
            </div>

            <!-- REVIEWS SECTION -->
            <div id="reviewsContent" class="hidden">
                <div class="bg-surface-container-lowest rounded-xl shadow-[0_4px_20px_rgba(0,0,0,0.04)] overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-surface-container-low border-b border-surface-container-high">
                                    <th class="p-4 font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider">User</th>
                                    <th class="p-4 font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider">Resep</th>
                                    <th class="p-4 font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider">Rating & Komentar</th>
                                    <th class="p-4 font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider text-center">Status</th>
                                    <th class="p-4 font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="reviewTableBody" class="divide-y divide-surface-container-high">
                                <tr><td colspan="5" class="p-4 text-center">Loading...</td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- USERS SECTION -->
            <div id="usersContent" class="hidden">
                <div class="bg-surface-container-lowest rounded-xl shadow-[0_4px_20px_rgba(0,0,0,0.04)] overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-surface-container-low border-b border-surface-container-high">
                                    <th class="p-4 font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider">Pengguna</th>
                                    <th class="p-4 font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider">Role</th>
                                    <th class="p-4 font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider">Bergabung</th>
                                    <th class="p-4 font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider">Pass. Diubah</th>
                                    <th class="p-4 font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="userTableBody" class="divide-y divide-surface-container-high">
                                <tr><td colspan="5" class="p-4 text-center">Loading...</td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- CATEGORIES SECTION -->
            <div id="categoriesContent" class="hidden">
                <div class="bg-surface-container-lowest rounded-xl shadow-[0_4px_20px_rgba(0,0,0,0.04)] overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-surface-container-low border-b border-surface-container-high">
                                    <th class="p-4 font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider">ID</th>
                                    <th class="p-4 font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider">Nama Kategori</th>
                                    <th class="p-4 font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider">Deskripsi</th>
                                    <th class="p-4 font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="categoryTableBody" class="divide-y divide-surface-container-high">
                                <tr><td colspan="4" class="p-4 text-center">Loading...</td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- INGREDIENTS SECTION -->
            <div id="ingredientsContent" class="hidden">
                <div class="bg-surface-container-lowest rounded-xl shadow-[0_4px_20px_rgba(0,0,0,0.04)] overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-surface-container-low border-b border-surface-container-high">
                                    <th class="p-4 font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider">Nama Bahan</th>
                                    <th class="p-4 font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider">Unit Dasar</th>
                                    <th class="p-4 font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider">Qty Dasar</th>
                                    <th class="p-4 font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider">Harga per Unit Dasar</th>
                                    <th class="p-4 font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="ingredientTableBody" class="divide-y divide-surface-container-high">
                                <tr><td colspan="5" class="p-4 text-center">Loading...</td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <!-- User Edit Modal -->
    <div id="userModal" class="modal-overlay fixed inset-0 bg-inverse-surface/40 backdrop-blur-sm z-50 flex items-center justify-center px-4">
        <div class="modal-content bg-surface-container-lowest w-full max-w-md rounded-2xl shadow-[0_4px_20px_rgba(0,0,0,0.1)] border border-outline-variant">
            <div class="px-6 py-4 border-b border-surface-container-highest flex justify-between items-center bg-surface">
                <h2 class="font-headline-md text-headline-md text-on-surface">Edit Pengguna</h2>
                <button onclick="closeUserModal()" class="text-on-surface-variant hover:text-on-surface p-1 rounded-md hover:bg-surface-variant">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>
            <div class="p-6 space-y-4">
                <input type="hidden" id="editUserId">
                <div>
                    <label class="block font-label-md text-label-md text-on-surface mb-1">Nama Lengkap</label>
                    <input type="text" id="editUserName" class="w-full px-4 py-2 border border-outline-variant rounded-lg input-focus-ring text-on-surface bg-surface-container-lowest">
                </div>
                <div>
                    <label class="block font-label-md text-label-md text-on-surface mb-1">Email</label>
                    <input type="email" id="editUserEmail" class="w-full px-4 py-2 border border-outline-variant rounded-lg input-focus-ring text-on-surface bg-surface-container-lowest">
                </div>
                <div>
                    <label class="block font-label-md text-label-md text-on-surface mb-1">Role</label>
                    <select id="editUserRole" class="w-full px-4 py-2 border border-outline-variant rounded-lg input-focus-ring text-on-surface bg-surface-container-lowest">
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
            </div>
            <div class="px-6 py-4 border-t border-surface-container-highest bg-surface flex justify-end gap-3 rounded-b-2xl">
                <button onclick="closeUserModal()" class="px-5 py-2 font-label-md text-label-md text-on-surface-variant bg-surface-container-lowest border border-outline-variant rounded-full hover:bg-surface-variant">Batal</button>
                <button onclick="saveUser()" class="px-5 py-2 font-label-md text-label-md text-on-primary bg-primary rounded-full hover:shadow-md flex items-center gap-2">
                    <span class="material-symbols-outlined">save</span>
                    Simpan
                </button>
            </div>
        </div>
    </div>

    <!-- Category Modal -->
    <div id="categoryModal" class="modal-overlay fixed inset-0 bg-inverse-surface/40 backdrop-blur-sm z-50 flex items-center justify-center px-4">
        <div class="modal-content bg-surface-container-lowest w-full max-w-md rounded-2xl shadow-[0_4px_20px_rgba(0,0,0,0.1)] border border-outline-variant">
            <div class="px-6 py-4 border-b border-surface-container-highest flex justify-between items-center bg-surface">
                <h2 class="font-headline-md text-headline-md text-on-surface" id="categoryModalTitle">Tambah Kategori</h2>
                <button onclick="closeCategoryModal()" class="text-on-surface-variant hover:text-on-surface p-1 rounded-md hover:bg-surface-variant">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>
            <form onsubmit="event.preventDefault(); saveCategory();">
                <div class="p-6 space-y-4">
                    <input type="hidden" id="editCategoryId">
                    <div>
                        <label class="block font-label-md text-label-md text-on-surface mb-1">Nama Kategori <span class="text-error">*</span></label>
                        <input type="text" id="catName" required class="w-full px-4 py-2 border border-outline-variant rounded-lg input-focus-ring text-on-surface bg-surface-container-lowest">
                    </div>
                    <div>
                        <label class="block font-label-md text-label-md text-on-surface mb-1">Deskripsi</label>
                        <textarea id="catDesc" rows="3" class="w-full px-4 py-2 border border-outline-variant rounded-lg input-focus-ring text-on-surface bg-surface-container-lowest"></textarea>
                    </div>
                </div>
                <div class="px-6 py-4 border-t border-surface-container-highest bg-surface flex justify-end gap-3 rounded-b-2xl">
                    <button type="button" onclick="closeCategoryModal()" class="px-5 py-2 font-label-md text-label-md text-on-surface-variant bg-surface-container-lowest border border-outline-variant rounded-full hover:bg-surface-variant">Batal</button>
                    <button type="submit" class="px-5 py-2 font-label-md text-label-md text-on-primary bg-primary rounded-full hover:shadow-md flex items-center gap-2">
                        <span class="material-symbols-outlined">save</span>
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Ingredient Modal -->
    <div id="ingredientModal" class="modal-overlay fixed inset-0 bg-inverse-surface/40 backdrop-blur-sm z-50 flex items-center justify-center px-4">
        <div class="modal-content bg-surface-container-lowest w-full max-w-md rounded-2xl shadow-[0_4px_20px_rgba(0,0,0,0.1)] border border-outline-variant">
            <div class="px-6 py-4 border-b border-surface-container-highest flex justify-between items-center bg-surface">
                <h2 class="font-headline-md text-headline-md text-on-surface" id="ingredientModalTitle">Tambah Bahan</h2>
                <button onclick="closeIngredientModal()" class="text-on-surface-variant hover:text-on-surface p-1 rounded-md hover:bg-surface-variant">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>
            <form onsubmit="event.preventDefault(); saveIngredient();">
                <div class="p-6 space-y-4">
                    <input type="hidden" id="editIngredientId">
                    <div>
                        <label class="block font-label-md text-label-md text-on-surface mb-1">Nama Bahan <span class="text-error">*</span></label>
                        <input type="text" id="ingName" required class="w-full px-4 py-2 border border-outline-variant rounded-lg input-focus-ring text-on-surface bg-surface-container-lowest" placeholder="Contoh: Bawang Merah">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block font-label-md text-label-md text-on-surface mb-1">Satuan Dasar <span class="text-error">*</span></label>
                            <input type="text" id="ingUnit" required class="w-full px-4 py-2 border border-outline-variant rounded-lg input-focus-ring text-on-surface bg-surface-container-lowest" placeholder="Contoh: gram">
                        </div>
                        <div>
                            <label class="block font-label-md text-label-md text-on-surface mb-1">Qty Dasar <span class="text-error">*</span></label>
                            <input type="number" id="ingBaseQty" required min="1" step="0.01" class="w-full px-4 py-2 border border-outline-variant rounded-lg input-focus-ring text-on-surface bg-surface-container-lowest" placeholder="Contoh: 1000">
                        </div>
                    </div>
                    <div>
                        <label class="block font-label-md text-label-md text-on-surface mb-1">Harga (per Qty Dasar) <span class="text-error">*</span></label>
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant font-label-md">Rp</span>
                            <input type="number" id="ingPrice" required min="0" step="100" class="w-full pl-9 pr-4 py-2 border border-outline-variant rounded-lg input-focus-ring text-on-surface bg-surface-container-lowest" placeholder="Contoh: 35000">
                        </div>
                        <p class="text-xs text-on-surface-variant mt-1">Contoh: Rp 35.000 untuk 1000 gram</p>
                    </div>
                </div>
                <div class="px-6 py-4 border-t border-surface-container-highest bg-surface flex justify-end gap-3 rounded-b-2xl">
                    <button type="button" onclick="closeIngredientModal()" class="px-5 py-2 font-label-md text-label-md text-on-surface-variant bg-surface-container-lowest border border-outline-variant rounded-full hover:bg-surface-variant">Batal</button>
                    <button type="submit" class="px-5 py-2 font-label-md text-label-md text-on-primary bg-primary rounded-full hover:shadow-md flex items-center gap-2">
                        <span class="material-symbols-outlined">save</span>
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Recipe Modal Form (Slide-in / Pop-in) -->
    <div id="recipeModal" class="modal-overlay fixed inset-0 bg-inverse-surface/40 backdrop-blur-sm z-50 flex items-center justify-center py-10 px-4">
        <div class="modal-content bg-surface-container-lowest w-full max-w-4xl rounded-2xl shadow-[0_4px_20px_rgba(0,0,0,0.1)] flex flex-col max-h-[90vh] overflow-hidden border border-outline-variant">
            <!-- Modal Header -->
            <div class="px-6 py-4 border-b border-surface-container-highest flex justify-between items-center bg-surface">
                <h2 class="font-headline-md text-headline-md text-on-surface" id="modalTitle">Tambah Resep Baru</h2>
                <button onclick="closeModal()" class="text-on-surface-variant hover:text-on-surface transition-colors p-1 rounded-md hover:bg-surface-variant">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>

            <!-- Form Body with Scroll -->
            <div class="overflow-y-auto p-6 flex-1">
                <form id="recipeForm" class="space-y-6">
                    <input type="hidden" id="editRecipeId">
                    <!-- Basic Info -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block font-label-md text-label-md text-on-surface mb-1">Judul Resep <span class="text-error">*</span></label>
                            <input type="text" id="recipeTitle" required class="w-full px-4 py-2 border border-outline-variant rounded-lg input-focus-ring text-on-surface placeholder-on-surface-variant bg-surface-container-lowest" placeholder="Contoh: Nasi Goreng Spesial">
                        </div>
                        
                        <div>
                            <label class="block font-label-md text-label-md text-on-surface mb-1">Kategori <span class="text-error">*</span></label>
                            <select id="recipeCategory" required class="w-full px-4 py-2 border border-outline-variant rounded-lg input-focus-ring text-on-surface bg-surface-container-lowest">
                                <option value="">Pilih Kategori...</option>
                                <!-- Async Options here -->
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block font-label-md text-label-md text-on-surface mb-1">Upload Foto / Gambar Resep (Opsional)</label>
                            <input type="file" id="recipeImageFile" accept="image/*" class="w-full px-4 py-2 border border-outline-variant rounded-lg input-focus-ring text-on-surface bg-surface-container-lowest file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:font-label-sm file:bg-primary-container file:text-on-primary-container hover:file:opacity-90 cursor-pointer">
                            <p class="text-xs text-on-surface-variant mt-1" id="recipeImageHint"></p>
                        </div>
                        <div>
                            <label class="block font-label-md text-label-md text-on-surface mb-1">Deskripsi Singkat</label>
                            <input type="text" id="recipeDescription" class="w-full px-4 py-2 border border-outline-variant rounded-lg input-focus-ring text-on-surface placeholder-on-surface-variant bg-surface-container-lowest" placeholder="Contoh: Nasi goreng nikmat untuk sarapan...">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block font-label-md text-label-md text-on-surface mb-1">Waktu Memasak (Menit)</label>
                            <input type="number" id="recipeCookingTime" min="1" class="w-full px-4 py-2 border border-outline-variant rounded-lg input-focus-ring text-on-surface placeholder-on-surface-variant bg-surface-container-lowest" placeholder="Contoh: 30">
                        </div>
                        <div>
                            <label class="block font-label-md text-label-md text-on-surface mb-1">Porsi</label>
                            <input type="number" id="recipePortions" min="1" class="w-full px-4 py-2 border border-outline-variant rounded-lg input-focus-ring text-on-surface placeholder-on-surface-variant bg-surface-container-lowest" placeholder="Contoh: 2">
                        </div>
                    </div>

                    <!-- Ingredients Dynamic Section -->
                    <div class="border border-outline-variant bg-surface-container-low rounded-2xl p-5 mb-6">
                        <div class="flex items-center justify-between mb-4 border-b border-surface-container-highest pb-3">
                            <div>
                                <h3 class="font-headline-md text-headline-md text-on-surface">Komposisi Bahan Pokok</h3>
                                <p class="font-body-sm text-on-surface-variant">Tambahkan bahan dan tentukan takarannya</p>
                            </div>
                            <button type="button" onclick="addIngredientRow()" class="flex items-center px-4 py-2 bg-secondary text-on-secondary rounded-full font-label-md shadow-sm transition-all hover:shadow-md">
                                <span class="material-symbols-outlined text-[18px] mr-1">add</span>
                                Tambah Bahan Pokok
                            </button>
                        </div>

                        <!-- Rows Container -->
                        <div id="ingredientsContainer" class="space-y-4">
                            <!-- Rows akan di generate via JS -->
                        </div>
                        <p id="noIngredientsError" class="hidden text-error text-sm mt-3 font-label-md bg-error-container text-on-error-container p-2 rounded-lg">⚠️ Minimal masukkan 1 bahan pokok.</p>
                    </div>

                    <div>
                        <label class="block font-label-md text-label-md text-on-surface mb-1">Instruksi Memasak <span class="text-error">*</span></label>
                        <textarea id="recipeInstructions" required rows="4" class="w-full px-4 py-2 border border-outline-variant rounded-lg input-focus-ring text-on-surface placeholder-on-surface-variant resize-none bg-surface-container-lowest" placeholder="Langkah 1: Siapkan bahan..."></textarea>
                    </div>
                </form>
            </div>

            <!-- Modal Footer -->
            <div class="px-6 py-4 border-t border-surface-container-highest bg-surface flex justify-end gap-3 rounded-b-2xl">
                <button type="button" onclick="closeModal()" class="px-5 py-2 font-label-md text-label-md text-on-surface-variant bg-surface-container-lowest border border-outline-variant rounded-full hover:bg-surface-variant transition-colors">Batal</button>
                <button type="button" onclick="submitRecipe()" class="px-5 py-2 font-label-md text-label-md text-on-primary bg-primary rounded-full hover:shadow-md transition-shadow flex items-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">save</span>
                    Simpan Resep
                </button>
            </div>
        </div>
    </div>

    <script>
        // Store Data
        let categories = [];
        let allIngredients = [];
        let rawRecipes = []; // To hold full recipe data for editing
        let rowCount = 0;

        // Elements
        const modal = document.getElementById('recipeModal');
        const ingredientsContainer = document.getElementById('ingredientsContainer');
        const formTitle = document.getElementById('recipeTitle');
        const formCategory = document.getElementById('recipeCategory');
        const formDescription = document.getElementById('recipeDescription');
        const formCookingTime = document.getElementById('recipeCookingTime');
        const formPortions = document.getElementById('recipePortions');
        const formInstructions = document.getElementById('recipeInstructions');

        // Initialize App
        document.addEventListener('DOMContentLoaded', async () => {
            await fetchCategories();
            await fetchIngredients();
            await fetchRecipes();
        });

        // Sidebar Toggle
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            const isOpen = !sidebar.classList.contains('-translate-x-full');

            if (isOpen) {
                // Close sidebar
                sidebar.classList.add('-translate-x-full');
                overlay.classList.remove('opacity-100');
                overlay.classList.add('opacity-0');
                setTimeout(() => { overlay.classList.add('hidden'); }, 300); // Wait for transition
            } else {
                // Open sidebar
                overlay.classList.remove('hidden');
                // Small delay to allow display block to apply before opacity transition
                setTimeout(() => {
                    overlay.classList.remove('opacity-0');
                    overlay.classList.add('opacity-100');
                    sidebar.classList.remove('-translate-x-full');
                }, 10);
            }
        }

        // Tab Switching
        function switchTab(tab) {
            const recipesContent  = document.getElementById('recipesContent');
            const reviewsContent  = document.getElementById('reviewsContent');
            const usersContent    = document.getElementById('usersContent');
            const categoriesContent = document.getElementById('categoriesContent');
            const ingredientsContent = document.getElementById('ingredientsContent');
            
            const navRecipes      = document.getElementById('nav-recipes');
            const navReviews      = document.getElementById('nav-reviews');
            const navUsers        = document.getElementById('nav-users');
            const navCategories   = document.getElementById('nav-categories');
            const navIngredients  = document.getElementById('nav-ingredients');
            
            const addRecipeBtn2      = document.getElementById('addRecipeBtn2');
            const addCategoryBtn     = document.getElementById('addCategoryBtn');
            const addIngredientBtn   = document.getElementById('addIngredientBtn');
            const pageTitle          = document.getElementById('pageTitle');
            const pageDesc           = document.getElementById('pageDesc');
            const breadcrumbTitle    = document.getElementById('breadcrumbTitle');

            const activeClass   = 'cursor-pointer bg-secondary-container text-on-secondary-container rounded-xl flex items-center p-3 gap-sm transition-transform duration-150 translate-x-1';
            const inactiveClass = 'cursor-pointer text-on-surface-variant hover:bg-surface-variant rounded-xl flex items-center p-3 gap-sm hover:bg-surface-variant/50 transition-all duration-200';

            // Hide all panels
            [recipesContent, reviewsContent, usersContent, categoriesContent, ingredientsContent].forEach(el => {
                if(el) el.classList.add('hidden');
            });
            // Reset all nav buttons
            [navRecipes, navReviews, navUsers, navCategories, navIngredients].forEach(el => { if(el) el.className = inactiveClass; });

            // Hide action buttons by default
            if(addRecipeBtn2) { addRecipeBtn2.classList.add('hidden'); addRecipeBtn2.classList.remove('sm:flex'); }
            if(addCategoryBtn) { addCategoryBtn.classList.add('hidden'); addCategoryBtn.classList.remove('sm:flex'); }
            if(addIngredientBtn) { addIngredientBtn.classList.add('hidden'); addIngredientBtn.classList.remove('sm:flex'); }

            if (tab === 'recipes') {
                recipesContent.classList.remove('hidden');
                navRecipes.className = activeClass;
                if(addRecipeBtn2) { addRecipeBtn2.classList.remove('hidden'); addRecipeBtn2.classList.add('sm:flex'); }
                pageTitle.textContent = 'Semua Resep';
                pageDesc.textContent = 'Kelola database resep, panduan harga, dan kalkulasi nutrisi.';
                breadcrumbTitle.textContent = 'Daftar Resep';
                fetchRecipes();
            } else if (tab === 'reviews') {
                reviewsContent.classList.remove('hidden');
                navReviews.className = activeClass;
                pageTitle.textContent = 'Ulasan & Rating';
                pageDesc.textContent = 'Kelola ulasan dan balas komentar pengguna.';
                breadcrumbTitle.textContent = 'Ulasan';
                fetchAdminReviews();
            } else if (tab === 'users') {
                usersContent.classList.remove('hidden');
                navUsers.className = activeClass;
                pageTitle.textContent = 'Manajemen Pengguna';
                pageDesc.textContent = 'Kelola akses dan hak akses pengguna.';
                breadcrumbTitle.textContent = 'Pengguna';
                fetchUsers();
            } else if (tab === 'categories') {
                categoriesContent.classList.remove('hidden');
                navCategories.className = activeClass;
                if(addCategoryBtn) { addCategoryBtn.classList.remove('hidden'); addCategoryBtn.classList.add('sm:flex'); }
                pageTitle.textContent = 'Kategori Resep';
                pageDesc.textContent = 'Manajemen pengelompokan resep berdasarkan jenisnya.';
                breadcrumbTitle.textContent = 'Kategori';
                renderCategoriesTable();
            } else if (tab === 'ingredients') {
                ingredientsContent.classList.remove('hidden');
                navIngredients.className = activeClass;
                if(addIngredientBtn) { addIngredientBtn.classList.remove('hidden'); addIngredientBtn.classList.add('sm:flex'); }
                pageTitle.textContent = 'Database Bahan Pokok';
                pageDesc.textContent = 'Kelola daftar bahan pokok beserta satuan dan harga dasar untuk DSS.';
                breadcrumbTitle.textContent = 'Bahan';
                renderIngredientsTable();
            }
        }

        // --- CATEGORY MANAGEMENT ---
        async function fetchCategories() {
            try {
                const res = await fetch('/api/admin/categories?t=' + new Date().getTime(), { cache: "no-store" });
                const json = await res.json();
                if(json.success) {
                    categories = json.data;
                    formCategory.innerHTML = '<option value="">Pilih Kategori...</option>';
                    categories.forEach(cat => {
                        formCategory.add(new Option(cat.name, cat.id));
                    });
                }
            } catch (err) {
                console.error('Failed to load categories', err);
            }
        }

        function renderCategoriesTable() {
            const tableBody = document.getElementById('categoryTableBody');
            if (categories.length === 0) {
                tableBody.innerHTML = `<tr><td colspan="4" class="p-4 text-center font-label-md text-on-surface-variant">Belum ada kategori terdaftar.</td></tr>`;
                return;
            }

            tableBody.innerHTML = categories.map(cat => `
                <tr class="hover:bg-surface-bright transition-colors group">
                    <td class="p-4 font-body-sm text-on-surface">${cat.id}</td>
                    <td class="p-4 font-label-md text-on-surface">${cat.name}</td>
                    <td class="p-4 font-body-sm text-on-surface-variant">${cat.description || '-'}</td>
                    <td class="p-4 text-right">
                        <div class="flex justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                            <button onclick='openCategoryModal(${JSON.stringify(cat)})' class="w-8 h-8 rounded-full bg-surface-container-high flex items-center justify-center text-on-surface-variant hover:bg-primary-container hover:text-on-primary-container transition-colors" title="Edit">
                                <span class="material-symbols-outlined text-[18px]">edit</span>
                            </button>
                            <button onclick="deleteCategory(${cat.id})" class="w-8 h-8 rounded-full bg-surface-container-high flex items-center justify-center text-on-surface-variant hover:bg-error-container hover:text-on-error-container transition-colors" title="Hapus">
                                <span class="material-symbols-outlined text-[18px]">delete</span>
                            </button>
                        </div>
                    </td>
                </tr>
            `).join('');
        }

        const categoryModal = document.getElementById('categoryModal');
        function openCategoryModal(cat = null) {
            document.getElementById('editCategoryId').value = cat ? cat.id : '';
            document.getElementById('catName').value = cat ? cat.name : '';
            document.getElementById('catDesc').value = cat ? (cat.description || '') : '';
            document.getElementById('categoryModalTitle').textContent = cat ? 'Edit Kategori' : 'Tambah Kategori';
            categoryModal.classList.add('active');
        }
        function closeCategoryModal() {
            categoryModal.classList.remove('active');
        }
        async function saveCategory() {
            const id = document.getElementById('editCategoryId').value;
            const name = document.getElementById('catName').value.trim();
            const description = document.getElementById('catDesc').value.trim();

            const url = id ? `/api/admin/categories/${id}` : '/api/admin/categories';
            const method = id ? 'PUT' : 'POST';

            try {
                Swal.fire({ title: 'Menyimpan...', allowOutsideClick: false, didOpen: () => Swal.showLoading() });
                const res = await fetch(url, {
                    method: method,
                    headers: { 'Accept': 'application/json', 'Content-Type': 'application/json' },
                    body: JSON.stringify({ name, description })
                });
                const data = await res.json();
                if (!res.ok) throw new Error(data.message || 'Gagal menyimpan kategori');
                
                Swal.fire('Berhasil!', 'Kategori tersimpan.', 'success');
                closeCategoryModal();
                await fetchCategories();
                renderCategoriesTable();
            } catch (err) {
                Swal.fire('Error', err.message, 'error');
            }
        }
        async function deleteCategory(id) {
            const result = await Swal.fire({
                title: 'Hapus Kategori?',
                text: "Pastikan tidak ada resep yang memakai kategori ini.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ba1a1a',
                confirmButtonText: 'Ya, Hapus!'
            });
            if (!result.isConfirmed) return;
            try {
                const res = await fetch(`/api/admin/categories/${id}`, {
                    method: 'DELETE',
                    headers: { 'Accept': 'application/json' }
                });
                if(res.ok) {
                    Swal.fire('Terhapus!', 'Kategori berhasil dihapus.', 'success');
                    await fetchCategories();
                    renderCategoriesTable();
                } else {
                    const d = await res.json();
                    throw new Error(d.message);
                }
            } catch(e) {
                Swal.fire('Error', e.message || 'Gagal menghapus', 'error');
            }
        }

        // --- INGREDIENT MANAGEMENT ---
        async function fetchIngredients() {
            try {
                const res = await fetch('/api/admin/ingredients?t=' + new Date().getTime(), { cache: "no-store" });
                const json = await res.json();
                if(json.success) {
                    allIngredients = json.data;
                }
            } catch (err) {
                console.error('Failed to load ingredients', err);
            }
        }

        function renderIngredientsTable() {
            const tableBody = document.getElementById('ingredientTableBody');
            if (allIngredients.length === 0) {
                tableBody.innerHTML = `<tr><td colspan="5" class="p-4 text-center font-label-md text-on-surface-variant">Belum ada bahan terdaftar.</td></tr>`;
                return;
            }

            tableBody.innerHTML = allIngredients.map(ing => `
                <tr class="hover:bg-surface-bright transition-colors group">
                    <td class="p-4 font-label-md text-on-surface">${ing.name}</td>
                    <td class="p-4 font-body-sm text-on-surface-variant">${ing.unit || 'gram'}</td>
                    <td class="p-4 font-body-sm text-on-surface-variant">${ing.base_qty || 1000}</td>
                    <td class="p-4 font-label-md text-primary">Rp ${Number(ing.price_per_unit).toLocaleString('id-ID')}</td>
                    <td class="p-4 text-right">
                        <div class="flex justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                            <button onclick='openIngredientModal(${JSON.stringify(ing).replace(/'/g, "&#39;")})' class="w-8 h-8 rounded-full bg-surface-container-high flex items-center justify-center text-on-surface-variant hover:bg-primary-container hover:text-on-primary-container transition-colors" title="Edit">
                                <span class="material-symbols-outlined text-[18px]">edit</span>
                            </button>
                            <button onclick="deleteIngredient(${ing.id})" class="w-8 h-8 rounded-full bg-surface-container-high flex items-center justify-center text-on-surface-variant hover:bg-error-container hover:text-on-error-container transition-colors" title="Hapus">
                                <span class="material-symbols-outlined text-[18px]">delete</span>
                            </button>
                        </div>
                    </td>
                </tr>
            `).join('');
        }

        const ingredientModal = document.getElementById('ingredientModal');
        function openIngredientModal(ing = null) {
            document.getElementById('editIngredientId').value = ing ? ing.id : '';
            document.getElementById('ingName').value = ing ? ing.name : '';
            document.getElementById('ingUnit').value = ing ? (ing.unit || 'gram') : 'gram';
            document.getElementById('ingBaseQty').value = ing ? (ing.base_qty || 1000) : 1000;
            document.getElementById('ingPrice').value = ing ? ing.price_per_unit : '';
            document.getElementById('ingredientModalTitle').textContent = ing ? 'Edit Bahan' : 'Tambah Bahan Pokok';
            ingredientModal.classList.add('active');
        }
        function closeIngredientModal() {
            ingredientModal.classList.remove('active');
        }
        async function saveIngredient() {
            const id = document.getElementById('editIngredientId').value;
            const name = document.getElementById('ingName').value.trim();
            const unit = document.getElementById('ingUnit').value.trim();
            const base_qty = document.getElementById('ingBaseQty').value;
            const price_per_unit = document.getElementById('ingPrice').value;

            const url = id ? `/api/admin/ingredients/${id}` : '/api/admin/ingredients';
            const method = id ? 'PUT' : 'POST';

            try {
                Swal.fire({ title: 'Menyimpan...', allowOutsideClick: false, didOpen: () => Swal.showLoading() });
                const res = await fetch(url, {
                    method: method,
                    headers: { 'Accept': 'application/json', 'Content-Type': 'application/json' },
                    body: JSON.stringify({ name, unit, base_qty, price_per_unit })
                });
                const data = await res.json();
                if (!res.ok) throw new Error(data.message || 'Gagal menyimpan bahan');
                
                Swal.fire('Berhasil!', 'Bahan pokok tersimpan.', 'success');
                closeIngredientModal();
                await fetchIngredients();
                renderIngredientsTable();
            } catch (err) {
                Swal.fire('Error', err.message, 'error');
            }
        }
        async function deleteIngredient(id) {
            const result = await Swal.fire({
                title: 'Hapus Bahan?',
                text: "Data yang dihapus tidak dapat dikembalikan.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ba1a1a',
                confirmButtonText: 'Ya, Hapus!'
            });
            if (!result.isConfirmed) return;
            try {
                const res = await fetch(`/api/admin/ingredients/${id}`, {
                    method: 'DELETE',
                    headers: { 'Accept': 'application/json' }
                });
                if(res.ok) {
                    Swal.fire('Terhapus!', 'Bahan berhasil dihapus.', 'success');
                    await fetchIngredients();
                    renderIngredientsTable();
                } else {
                    const d = await res.json();
                    throw new Error(d.message);
                }
            } catch(e) {
                Swal.fire('Error', e.message || 'Gagal menghapus', 'error');
            }
        }

        // --- RECIPE MANAGEMENT ---
        async function fetchRecipes() {
            try {
                const res = await fetch('/api/admin/recipes?t=' + new Date().getTime(), { cache: "no-store" });
                const json = await res.json();
                
                const tableBody = document.getElementById('recipeTableBody');
                
                if(!json.success || json.data.length === 0) {
                    tableBody.innerHTML = `<tr><td colspan="5" class="p-4 text-center text-on-surface-variant font-label-md">Belum ada resep yang terdaftar.</td></tr>`;
                    document.getElementById('statTotalRecipes').textContent = '0';
                    rawRecipes = [];
                    return;
                }

                rawRecipes = json.data; // Store full array for editing
                document.getElementById('statTotalRecipes').textContent = json.data.length.toLocaleString('id-ID');

                tableBody.innerHTML = json.data.map(recipe => `
                    <tr class="hover:bg-surface-bright transition-colors group">
                        <td class="p-4">
                            <div class="flex items-center gap-sm">
                                <img class="w-16 h-16 rounded-lg object-cover bg-surface-variant" src="${recipe.image_url || 'https://via.placeholder.com/150'}" onerror="this.src='https://via.placeholder.com/150'">
                                <div>
                                    <p class="font-label-md text-label-md text-on-surface">${recipe.title}</p>
                                    <p class="font-label-sm text-label-sm text-on-surface-variant mt-1 flex items-center gap-1">
                                        <span class="material-symbols-outlined text-[14px]">timer</span> ${recipe.cooking_time || 0} Menit
                                    </p>
                                </div>
                            </div>
                        </td>
                        <td class="p-4">
                            <span class="inline-block bg-surface-variant text-on-surface-variant px-3 py-1 rounded-full font-label-sm text-label-sm">${recipe.category?.name || 'Tanpa Kategori'}</span>
                        </td>
                        <td class="p-4">
                            <div class="flex flex-col">
                                <span class="font-label-md text-label-md text-primary">Rp ${Number(recipe.total_price || 0).toLocaleString('id-ID')}</span>
                                <span class="font-label-sm text-label-sm text-on-surface-variant">/ ${recipe.portions || '-'} Porsi</span>
                            </div>
                        </td>
                        <td class="p-4">
                            <span class="font-body-md text-body-md text-on-surface">${recipe.ingredients?.length || 0} Item</span>
                        </td>
                        <td class="p-4 text-right">
                            <div class="flex justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                <button onclick="openEditModal(${recipe.id})" class="w-8 h-8 rounded-full bg-surface-container-high flex items-center justify-center text-on-surface-variant hover:bg-primary-container hover:text-on-primary-container transition-colors" title="Edit">
                                    <span class="material-symbols-outlined text-[18px]">edit</span>
                                </button>
                                <button onclick="deleteRecipe(${recipe.id})" class="w-8 h-8 rounded-full bg-surface-container-high flex items-center justify-center text-on-surface-variant hover:bg-error-container hover:text-on-error-container transition-colors" title="Hapus">
                                    <span class="material-symbols-outlined text-[18px]">delete</span>
                                </button>
                            </div>
                        </td>
                    </tr>
                `).join('');
                
            } catch (err) {
                console.error(err);
                Swal.fire('Error', 'Gagal memuat resep dari database', 'error');
            }
        }

        // Modal Controls
        function openModal() {
            document.getElementById('modalTitle').textContent = 'Tambah Resep Baru';
            document.getElementById('editRecipeId').value = '';
            document.getElementById('recipeImageHint').textContent = '';
            document.getElementById('recipeForm').reset();
            ingredientsContainer.innerHTML = '';
            document.getElementById('noIngredientsError').classList.add('hidden');
            rowCount = 0;
            addIngredientRow(); // Auto add 1 empty row
            
            modal.classList.add('active');
        }

        function openEditModal(recipeId) {
            const recipe = rawRecipes.find(r => r.id === recipeId);
            if(!recipe) return;

            document.getElementById('modalTitle').textContent = 'Edit Resep';
            document.getElementById('editRecipeId').value = recipe.id;
            
            // Populate Basic Fields
            formTitle.value = recipe.title;
            formCategory.value = recipe.category_id || '';
            formDescription.value = recipe.description || '';
            formCookingTime.value = recipe.cooking_time || '';
            formPortions.value = recipe.portions || '';
            formInstructions.value = recipe.instructions || '';
            
            // Image Hint
            if(recipe.image_url) {
                document.getElementById('recipeImageHint').innerHTML = `Gambar saat ini ada. Unggah baru untuk mengganti.`;
            } else {
                document.getElementById('recipeImageHint').textContent = '';
            }

            // Populate Ingredients
            ingredientsContainer.innerHTML = '';
            rowCount = 0;
            
            if (recipe.ingredients && recipe.ingredients.length > 0) {
                recipe.ingredients.forEach(ing => {
                    addIngredientRow();
                    // Select the specific dropdown and inputs for the newly added row
                    const currentRow = document.getElementById(`ing-row-${rowCount}`);
                    const selectEl = currentRow.querySelector('.ing-select');
                    const qtyEl = currentRow.querySelector('.ing-qty');
                    const reqQtyEl = currentRow.querySelector('.ing-required-qty');
                    
                    selectEl.value = ing.id;
                    qtyEl.value = ing.pivot ? ing.pivot.quantity : 1;
                    reqQtyEl.value = ing.pivot ? ing.pivot.required_qty : '';
                    
                    // Trigger hint update
                    updateIngHint(selectEl, `ing-row-${rowCount}`);
                });
            } else {
                addIngredientRow();
            }

            modal.classList.add('active');
        }

        function closeModal() {
            modal.classList.remove('active');
        }

        // Dynamic Form Ingredients Row
        function addIngredientRow() {
            rowCount++;
            
            const optionsHtml = allIngredients.map(ing => {
                const baseQty = ing.base_qty || 1000;
                const unit    = ing.unit || 'gram';
                return `<option value="${ing.id}" data-base-qty="${baseQty}" data-unit="${unit}" data-price="${ing.price_per_unit}">${ing.name} — Rp${Number(ing.price_per_unit).toLocaleString('id-ID')} / ${baseQty} ${unit}</option>`;
            }).join('');
            
            const div = document.createElement('div');
            div.className = "flex flex-col gap-2 bg-surface p-3 rounded-xl border border-surface-container-highest";
            div.id = `ing-row-${rowCount}`;
            
            div.innerHTML = `
                <div class="flex gap-3 items-end">
                    <div class="flex-1">
                        <label class="block text-xs font-semibold text-on-surface-variant mb-1">Pilih Bahan Pokok</label>
                        <select class="ing-select w-full px-3 py-2 border border-outline-variant rounded-lg input-focus-ring text-sm text-on-surface bg-surface-container-lowest" required
                            onchange="updateIngHint(this, 'ing-row-${rowCount}')">
                            <option value="">-- Pilih Bahan --</option>
                            ${optionsHtml}
                        </select>
                    </div>
                    <div class="w-32 flex-shrink-0">
                        <label class="block text-xs font-semibold text-on-surface-variant mb-1">Qty (kemasan)</label>
                        <input type="number" step="0.01" min="0.01" class="ing-qty w-full px-3 py-2 border border-outline-variant rounded-lg input-focus-ring text-sm text-on-surface bg-surface-container-lowest" placeholder="1" required>
                    </div>
                    <div class="flex-shrink-0 pb-1">
                        <button type="button" onclick="removeIngredientRow('ing-row-${rowCount}')" class="p-2 text-error hover:bg-error-container rounded-lg transition-colors border border-transparent">
                            <span class="material-symbols-outlined">delete</span>
                        </button>
                    </div>
                </div>
                <div class="flex gap-3 items-end">
                    <div class="flex-1">
                        <label class="block text-xs font-semibold text-on-surface-variant mb-1">
                            ⚖️ Takaran Dipakai Resep 
                            <span class="text-primary font-bold">DSS</span>
                            <span class="text-on-surface-variant font-normal" id="unit-hint-${rowCount}">(isi satuan sesuai bahan)</span>
                        </label>
                        <input type="number" min="1" class="ing-required-qty w-full px-3 py-2 border border-outline-variant rounded-lg input-focus-ring text-sm text-on-surface bg-surface-container-lowest" 
                            id="rqty-${rowCount}" placeholder="Contoh: 250">
                    </div>
                    <div class="flex-1 text-xs text-on-surface-variant bg-surface-container-lowest rounded-lg border border-dashed border-outline-variant px-3 py-2" id="price-hint-${rowCount}">
                        💡 Pilih bahan dulu, lalu isi takaran yang dibutuhkan resep ini.
                    </div>
                </div>
            `;
            ingredientsContainer.appendChild(div);
        }

        // Handler: update hint takaran & kalkulasi preview harga saat pilih bahan atau input takaran
        function updateIngHint(selectEl, rowId) {
            if(!selectEl.value) return; // If empty selection
            
            const selected   = selectEl.options[selectEl.selectedIndex];
            const baseQty    = parseInt(selected.getAttribute('data-base-qty') || 1000);
            const rawUnit    = (selected.getAttribute('data-unit') || 'gram').toLowerCase();
            const price      = parseFloat(selected.getAttribute('data-price') || 0);
            const rowNum     = rowId.replace('ing-row-', '');

            // Normalisasi unit: kg → gram, liter → ml
            const displayUnit = (rawUnit === 'kg' || rawUnit === 'kilogram') ? 'gram'
                : (rawUnit === 'liter' || rawUnit === 'l') ? 'ml'
                : rawUnit;

            const unitHint   = document.getElementById(`unit-hint-${rowNum}`);
            const priceHint  = document.getElementById(`price-hint-${rowNum}`);
            const rqtyInput  = document.getElementById(`rqty-${rowNum}`);

            if (unitHint)  unitHint.textContent  = `(dalam ${displayUnit})`;
            if (rqtyInput && !rqtyInput.value) rqtyInput.placeholder = `Contoh: ${Math.round(baseQty / 4)} (= 1/4 dari ${baseQty} ${displayUnit})`;

            // Update preview harga realtime
            const updatePreview = () => {
                const reqQty     = parseFloat(rqtyInput.value) || 0;
                const estPrice   = (reqQty / baseQty) * price;
                if (priceHint && reqQty > 0) {
                    priceHint.innerHTML = `💰 <strong>(${reqQty} ${displayUnit} / ${baseQty} ${displayUnit}) × Rp${price.toLocaleString('id-ID')}</strong><br><span class="text-primary font-bold text-sm">= Rp${Math.round(estPrice).toLocaleString('id-ID')}</span>`;
                } else if (priceHint) {
                    priceHint.innerHTML = `💡 Isi takaran yang dibutuhkan resep ini dalam <strong>${displayUnit}</strong>.`;
                }
            };
            
            if (rqtyInput) {
                rqtyInput.addEventListener('input', updatePreview);
                updatePreview(); // Trigger once on load
            }
        }

        function removeIngredientRow(rowId) {
            const row = document.getElementById(rowId);
            if(row) row.remove();
        }

        // Submit Logic (Convert to JSON & Fetch Array)
        async function submitRecipe() {
            const editId = document.getElementById('editRecipeId').value;
            const title = formTitle.value.trim();
            const categoryId = formCategory.value;
            const instructions = formInstructions.value.trim();
            const imageFileEl = document.getElementById('recipeImageFile');
            const imageFile = imageFileEl.files[0];

            if(!title || !categoryId || !instructions) {
                Swal.fire('Oops!', 'Mohon lengkapi bagian Judul, Kategori, dan Instruksi', 'warning');
                return;
            }

            const ingredientRows = ingredientsContainer.querySelectorAll('div[id^="ing-row-"]');
            const ingredientsData = [];
            const skippedRows = [];

            ingredientRows.forEach(row => {
                const selectEl     = row.querySelector('.ing-select');
                const qtyEl        = row.querySelector('.ing-qty');
                const requiredQtyEl = row.querySelector('.ing-required-qty');

                const select      = selectEl ? selectEl.value : '';
                const qty         = qtyEl ? qtyEl.value : '';
                const requiredQty = requiredQtyEl && requiredQtyEl.value ? parseInt(requiredQtyEl.value) : 100;

                if (!select || select === '') {
                    skippedRows.push(row);
                    return;
                }

                const finalQty = qty && parseFloat(qty) > 0 ? parseFloat(qty) : 1;

                ingredientsData.push({
                    ingredient_id: parseInt(select),
                    quantity:      finalQty,
                    required_qty:  requiredQty
                });
            });

            if (ingredientsData.length === 0) {
                document.getElementById('noIngredientsError').classList.remove('hidden');
                return;
            } else {
                document.getElementById('noIngredientsError').classList.add('hidden');
            }

            const formData = new FormData();
            formData.append('title', title);
            formData.append('category_id', categoryId);
            if(formDescription.value) formData.append('description', formDescription.value.trim());
            if(formCookingTime.value) formData.append('cooking_time', formCookingTime.value);
            if(formPortions.value) formData.append('portions', formPortions.value);
            formData.append('instructions', instructions);
            
            if(imageFile) {
                formData.append('image_file', imageFile);
            }
            
            formData.append('ingredients_data', JSON.stringify(ingredientsData));

            // Setup URL and Method for Edit vs Create
            let url = '/api/admin/recipes';
            if (editId) {
                url = `/api/admin/recipes/${editId}`;
                formData.append('_method', 'PUT'); // Laravel way to handle PUT with FormData (multipart/form-data)
            }

            try {
                Swal.fire({ title: 'Menyimpan...', allowOutsideClick: false, didOpen: () => Swal.showLoading() });

                const res = await fetch(url, {
                    method: 'POST', // Always POST for FormData in Laravel, spoofed with _method
                    headers: {
                        'Accept': 'application/json'
                    },
                    body: formData
                });

                const data = await res.json();

                if(!res.ok) {
                    throw new Error(data.message || 'Validation failed');
                }

                Swal.fire('Berhasil!', editId ? 'Resep berhasil diperbarui.' : 'Resep baru telah siap.', 'success');
                closeModal();
                fetchRecipes(); // Reload the table

            } catch (err) {
                Swal.fire('Gagal Menyimpan', err.message, 'error');
            }
        }

        // Delete Logic
        async function deleteRecipe(id) {
            const result = await Swal.fire({
                title: 'Hapus Resep ini?',
                text: "Data yang dihapus tidak bisa dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ba1a1a',
                cancelButtonColor: '#8a7266',
                confirmButtonText: 'Ya, Hapus!'
            });

            if (result.isConfirmed) {
                try {
                    const res = await fetch(`/api/admin/recipes/${id}`, {
                        method: 'DELETE',
                        headers: { 'Accept': 'application/json' }
                    });
                    const data = await res.json();
                    
                    if(data.success) {
                        Swal.fire('Terhapus!', 'Resep berhasil dihilangkan.', 'success');
                        fetchRecipes();
                    } else {
                        throw new Error(data.message);
                    }
                } catch(err) {
                    Swal.fire('Error', 'Gagal menghapus resep', 'error');
                }
            }
        }

        // --- REVIEWS MANAGEMENT ---
        async function fetchAdminReviews() {
            try {
                const res = await fetch('/api/admin/reviews');
                const json = await res.json();
                
                const tableBody = document.getElementById('reviewTableBody');
                if(!json.data || json.data.data.length === 0) {
                    tableBody.innerHTML = `<tr><td colspan="5" class="p-4 text-center font-label-md text-on-surface-variant">Belum ada ulasan masuk.</td></tr>`;
                    return;
                }

                tableBody.innerHTML = json.data.data.map(review => {
                    let rStars = '';
                    for(let i=1; i<=5; i++) rStars += i <= review.rating ? '★' : '☆';
                    
                    return `
                    <tr class="hover:bg-surface-bright transition-colors group">
                        <td class="p-4">
                            <div class="font-label-md text-on-surface">${review.user.name}</div>
                            <div class="font-label-sm text-on-surface-variant">${new Date(review.created_at).toLocaleDateString('id-ID')}</div>
                        </td>
                        <td class="p-4 font-label-md text-on-surface">${review.recipe.title}</td>
                        <td class="p-4">
                            <div class="text-tertiary-fixed-dim mb-1">${rStars}</div>
                            ${review.comment ? `<div class="font-body-sm text-on-surface line-clamp-2">${review.comment}</div>` : '-'}
                            ${review.photo_path ? `<a href="${review.photo_path}" target="_blank" class="text-primary text-xs hover:underline mt-1 inline-block">📸 Lihat Foto</a>` : ''}
                        </td>
                        <td class="p-4 text-center">
                            ${review.admin_reply 
                                ? `<span class="inline-flex items-center px-3 py-1 rounded-full font-label-sm bg-secondary-container text-on-secondary-container">Sudah Dibalas</span>` 
                                : `<span class="inline-flex items-center px-3 py-1 rounded-full font-label-sm bg-tertiary-container text-on-tertiary-container">Menunggu</span>`
                            }
                        </td>
                        <td class="p-4 text-right">
                            <div class="flex justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                <button onclick="replyReview(${review.id}, '${review.admin_reply || ''}')" class="w-8 h-8 rounded-full bg-surface-container-high flex items-center justify-center text-on-surface-variant hover:bg-primary-container hover:text-on-primary-container transition-colors" title="Balas">
                                    <span class="material-symbols-outlined text-[18px]">reply</span>
                                </button>
                                <button onclick="deleteReview(${review.id})" class="w-8 h-8 rounded-full bg-surface-container-high flex items-center justify-center text-on-surface-variant hover:bg-error-container hover:text-on-error-container transition-colors" title="Hapus">
                                    <span class="material-symbols-outlined text-[18px]">delete</span>
                                </button>
                            </div>
                        </td>
                    </tr>
                `}).join('');
                
            } catch (err) {
                console.error(err);
            }
        }

        async function deleteReview(id) {
            const result = await Swal.fire({
                title: 'Hapus Ulasan ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ba1a1a',
                confirmButtonText: 'Ya, Hapus!'
            });
            if (!result.isConfirmed) return;
            try {
                const res = await fetch(`/api/admin/reviews/${id}`, {
                    method: 'DELETE',
                    headers: { 'Accept': 'application/json' }
                });
                if(res.ok) fetchAdminReviews();
            } catch(e) {
                console.error(e);
            }
        }

        async function replyReview(id, currentReply) {
            const { value: text } = await Swal.fire({
                title: 'Balas Ulasan',
                input: 'textarea',
                inputLabel: 'Tulis balasan sebagai Admin',
                inputValue: currentReply === 'null' ? '' : currentReply,
                showCancelButton: true,
                confirmButtonText: 'Kirim Balasan',
                confirmButtonColor: '#9a4600'
            });

            if (text !== undefined) {
                try {
                    const res = await fetch(`/api/admin/reviews/${id}/reply`, {
                        method: 'POST',
                        headers: { 
                            'Accept': 'application/json',
                            'Content-Type': 'application/json' 
                        },
                        body: JSON.stringify({ admin_reply: text })
                    });
                    if(res.ok) {
                        Swal.fire('Berhasil', 'Balasan disimpan', 'success');
                        fetchAdminReviews();
                    }
                } catch(e) {
                    console.error(e);
                }
            }
        }

        // =====================
        // USER MANAGEMENT
        // =====================
        async function fetchUsers() {
            try {
                const res  = await fetch('/api/admin/users?t=' + Date.now(), { cache: 'no-store' });
                const json = await res.json();
                const body = document.getElementById('userTableBody');

                if (!json.success || json.data.length === 0) {
                    body.innerHTML = `<tr><td colspan="5" class="p-4 text-center font-label-md text-on-surface-variant">Belum ada pengguna terdaftar.</td></tr>`;
                    return;
                }

                body.innerHTML = json.data.map(user => {
                    const joinDate    = new Date(user.created_at).toLocaleDateString('id-ID', { day:'2-digit', month:'short', year:'numeric' });
                    const pwChanged   = user.password_changed_at
                        ? `<span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-label-sm bg-surface-variant text-on-surface-variant">
                                🔐 ${new Date(user.password_changed_at).toLocaleDateString('id-ID', { day:'2-digit', month:'short', year:'numeric', hour:'2-digit', minute:'2-digit' })}
                           </span>`
                        : `<span class="text-on-surface-variant text-xs italic">Belum pernah</span>`;

                    const roleBadge = user.role === 'admin'
                        ? `<span class="inline-flex items-center px-3 py-1 rounded-full font-label-sm bg-primary-container text-on-primary-container">👑 Admin</span>`
                        : `<span class="inline-flex items-center px-3 py-1 rounded-full font-label-sm bg-surface-variant text-on-surface-variant">👤 User</span>`;

                    return `
                    <tr class="hover:bg-surface-bright transition-colors group">
                        <td class="p-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-on-primary bg-primary text-sm">${user.name.charAt(0).toUpperCase()}</div>
                                <div>
                                    <div class="font-label-md text-on-surface">${user.name}</div>
                                    <div class="font-label-sm text-on-surface-variant">${user.email}</div>
                                </div>
                            </div>
                        </td>
                        <td class="p-4">${roleBadge}</td>
                        <td class="p-4 font-body-sm text-on-surface">${joinDate}</td>
                        <td class="p-4">${pwChanged}</td>
                        <td class="p-4 text-right">
                            <div class="flex justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                <button onclick='openUserModal(${JSON.stringify(user).replace(/'/g, "&#39;")})' class="w-8 h-8 rounded-full bg-surface-container-high flex items-center justify-center text-on-surface-variant hover:bg-primary-container hover:text-on-primary-container transition-colors" title="Edit">
                                    <span class="material-symbols-outlined text-[18px]">edit</span>
                                </button>
                                <button onclick="deleteUser(${user.id}, '${user.name.replace(/'/g, "\\'") }')" class="w-8 h-8 rounded-full bg-surface-container-high flex items-center justify-center text-on-surface-variant hover:bg-error-container hover:text-on-error-container transition-colors" title="Hapus">
                                    <span class="material-symbols-outlined text-[18px]">delete</span>
                                </button>
                            </div>
                        </td>
                    </tr>`;
                }).join('');
            } catch (err) {
                console.error(err);
                Swal.fire('Error', 'Gagal memuat data pengguna', 'error');
            }
        }

        const userModal = document.getElementById('userModal');

        function openUserModal(user) {
            document.getElementById('editUserId').value    = user.id;
            document.getElementById('editUserName').value  = user.name;
            document.getElementById('editUserEmail').value = user.email;
            document.getElementById('editUserRole').value  = user.role;
            userModal.classList.add('active');
        }

        function closeUserModal() {
            userModal.classList.remove('active');
        }

        async function saveUser() {
            const id    = document.getElementById('editUserId').value;
            const name  = document.getElementById('editUserName').value.trim();
            const email = document.getElementById('editUserEmail').value.trim();
            const role  = document.getElementById('editUserRole').value;

            if (!name || !email) {
                Swal.fire('Oops!', 'Nama dan email wajib diisi.', 'warning');
                return;
            }

            try {
                Swal.fire({ title: 'Menyimpan...', allowOutsideClick: false, didOpen: () => Swal.showLoading() });
                const res  = await fetch(`/api/admin/users/${id}`, {
                    method: 'PUT',
                    headers: { 'Accept': 'application/json', 'Content-Type': 'application/json' },
                    body: JSON.stringify({ name, email, role })
                });
                const json = await res.json();
                if (!json.success) throw new Error(json.message || 'Gagal menyimpan');
                Swal.fire('Berhasil!', 'Data pengguna diperbarui.', 'success');
                closeUserModal();
                fetchUsers();
            } catch (err) {
                Swal.fire('Gagal', err.message, 'error');
            }
        }

        async function deleteUser(id, name) {
            const result = await Swal.fire({
                title: `Hapus "${name}"?`,
                text: 'Akun pengguna ini akan dihapus permanen.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ba1a1a',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            });
            if (!result.isConfirmed) return;
            try {
                const res  = await fetch(`/api/admin/users/${id}`, {
                    method: 'DELETE',
                    headers: { 'Accept': 'application/json' }
                });
                const json = await res.json();
                if (!json.success) throw new Error(json.message);
                Swal.fire('Terhapus!', 'Pengguna berhasil dihapus.', 'success');
                fetchUsers();
            } catch (err) {
                Swal.fire('Error', err.message, 'error');
            }
        }
    </script>
</body>
</html>
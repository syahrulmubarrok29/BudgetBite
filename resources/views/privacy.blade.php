<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Kebijakan Privasi - BudgetBite</title>
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
        <section class="max-w-container-max mx-auto px-gutter py-xl mt-10">
            <h1 class="font-display-lg text-display-lg text-on-surface mb-md">Kebijakan Privasi</h1>
            <div class="bg-white/70 backdrop-blur-lg border border-surface-variant rounded-xl p-md shadow-sm prose max-w-none">
                <p class="font-body-md text-body-md text-on-surface mb-4">Terakhir Diperbarui: 4 Juli 2026</p>
                <p class="font-body-md text-body-md text-on-surface mb-4">Di BudgetBite, privasi pengunjung kami adalah salah satu prioritas utama kami. Dokumen Kebijakan Privasi ini berisi jenis informasi yang dikumpulkan dan dicatat oleh BudgetBite dan bagaimana kami menggunakannya.</p>
                
                <h2 class="font-headline-md text-headline-md text-primary mt-8 mb-4">Informasi yang Kami Kumpulkan</h2>
                <p class="font-body-md text-body-md text-on-surface mb-4">Kami mengumpulkan informasi pendaftaran (seperti nama dan alamat email) yang Anda berikan saat mendaftar ke akun BudgetBite. Informasi ini digunakan secara eksklusif untuk personalisasi akun dan login Anda.</p>
                
                <h2 class="font-headline-md text-headline-md text-primary mt-8 mb-4">Penggunaan Informasi</h2>
                <p class="font-body-md text-body-md text-on-surface mb-4">Informasi yang kami kumpulkan dari Anda mungkin digunakan untuk salah satu cara berikut:</p>
                <ul class="list-disc ml-6 font-body-md text-body-md text-on-surface mb-4">
                    <li>Untuk mempersonalisasi pengalaman Anda dalam aplikasi.</li>
                    <li>Untuk meningkatkan fungsionalitas situs web.</li>
                    <li>Untuk memproses ulasan dan interaksi pada resep.</li>
                </ul>

                <h2 class="font-headline-md text-headline-md text-primary mt-8 mb-4">Keamanan Data</h2>
                <p class="font-body-md text-body-md text-on-surface mb-4">Kami menerapkan berbagai langkah keamanan untuk menjaga keamanan informasi pribadi Anda ketika Anda memasukkan, mengirimkan, atau mengakses informasi pribadi Anda. Kata sandi Anda dienkripsi (hashed) secara aman di database kami.</p>
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
    
    <!-- No JS for recipes here -->
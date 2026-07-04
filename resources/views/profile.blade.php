<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya - BudgetBite</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8fafc; }
        .glassmorphism { background: rgba(255,255,255,0.7); backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px); }
        .avatar-ring { background: linear-gradient(135deg, #f43f5e, #fb923c); padding: 3px; border-radius: 9999px; }
        .sidebar-link { transition: all 0.2s; }
        .sidebar-link:hover, .sidebar-link.active { background: linear-gradient(135deg,#fff1f2,#fff7ed); color: #e11d48; }
        .sidebar-link.active { border-left: 3px solid #e11d48; font-weight: 700; }
        .tab-content { display: none; }
        .tab-content.active { display: block; }
    </style>
</head>
<body class="text-slate-800 antialiased min-h-screen flex flex-col">

    <!-- Navigation -->
    <nav class="glassmorphism fixed w-full z-50 border-b border-slate-200/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <a href="/search" class="flex items-center gap-2 hover:opacity-80 transition-opacity">
                    <img src="/images/logo.png" alt="BudgetBite Logo" class="h-8 w-8 object-contain rounded-lg"> <span class="font-bold text-xl tracking-tight bg-gradient-to-r from-rose-500 to-orange-400 bg-clip-text text-transparent">BudgetBite</span>
                </a>
                <div class="flex items-center gap-4">
                    <a href="/search" class="text-sm font-semibold text-slate-600 hover:text-rose-500 transition-colors hidden sm:block">Cari Resep</a>
                    <!-- Profile Dropdown -->
                    <div class="relative" id="profileDropdownWrapper">
                        <button id="profileBtn" onclick="toggleProfileMenu()" class="flex items-center gap-2 focus:outline-none group">
                            <div class="avatar-ring">
                                <div class="w-9 h-9 rounded-full bg-gradient-to-br from-rose-400 to-orange-400 flex items-center justify-center text-white font-bold text-base">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </div>
                            </div>
                            <div class="hidden sm:block text-left">
                                <p class="text-sm font-bold text-slate-800 leading-tight">{{ auth()->user()->name }}</p>
                                <p class="text-xs text-slate-500 leading-tight">{{ auth()->user()->email }}</p>
                            </div>
                            <svg class="w-4 h-4 text-slate-400 transition-transform duration-200 group-aria-expanded:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        <!-- Dropdown -->
                        <div id="profileMenu" class="hidden absolute right-0 mt-3 w-64 bg-white rounded-2xl shadow-xl border border-slate-100 overflow-hidden z-50">
                            <div class="p-4 bg-gradient-to-br from-rose-50 to-orange-50 border-b border-slate-100">
                                <div class="flex items-center gap-3">
                                    <div class="avatar-ring">
                                        <div class="w-11 h-11 rounded-full bg-gradient-to-br from-rose-400 to-orange-400 flex items-center justify-center text-white font-bold text-lg">
                                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                        </div>
                                    </div>
                                    <div class="min-w-0">
                                        <p class="font-bold text-slate-800 truncate">{{ auth()->user()->name }}</p>
                                        <p class="text-xs text-slate-500 truncate">{{ auth()->user()->email }}</p>
                                        <span class="inline-block mt-1 text-xs font-semibold px-2 py-0.5 rounded-full {{ auth()->user()->role === 'admin' ? 'bg-rose-100 text-rose-600' : 'bg-slate-100 text-slate-600' }}">
                                            {{ auth()->user()->role === 'admin' ? '👑 Admin' : '👤 User' }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="py-1">
                                <a href="/profile" class="flex items-center gap-3 px-4 py-3 text-sm font-semibold text-slate-700 hover:bg-rose-50 hover:text-rose-600 transition-colors bg-rose-50 text-rose-600">
                                    <span class="text-base">👤</span> Profil Saya
                                </a>
                                <a href="/profile?tab=settings" class="flex items-center gap-3 px-4 py-3 text-sm font-semibold text-slate-700 hover:bg-rose-50 hover:text-rose-600 transition-colors">
                                    <span class="text-base">⚙️</span> Pengaturan
                                </a>
                            </div>
                            <div class="border-t border-slate-100 py-1">
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 text-sm font-semibold text-red-600 hover:bg-red-50 transition-colors">
                                        <span class="text-base">🚪</span> Keluar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <main class="flex-grow pt-24 pb-16">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Page Header -->
            <div class="mb-8">
                <h1 class="text-3xl font-extrabold text-slate-900">Dashboard Profil</h1>
                <p class="text-slate-500 mt-1">Kelola informasi akun dan keamanan kamu.</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">

                <!-- Sidebar -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
                        <!-- Avatar Section -->
                        <div class="p-6 bg-gradient-to-br from-rose-500 to-orange-400 text-center">
                            <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-white/30 backdrop-blur text-white font-extrabold text-4xl mb-3 border-2 border-white/50 shadow-lg">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                            <p class="font-bold text-white text-lg leading-tight">{{ auth()->user()->name }}</p>
                            <p class="text-white/80 text-sm mt-0.5">{{ auth()->user()->email }}</p>
                            <span class="inline-block mt-2 text-xs font-bold px-3 py-1 rounded-full bg-white/20 text-white backdrop-blur">
                                {{ auth()->user()->role === 'admin' ? '👑 Admin' : '👤 Member' }}
                            </span>
                        </div>
                        <!-- Nav Links -->
                        <nav class="p-3 space-y-1">
                            <button onclick="switchTab('profile')" id="tab-btn-profile" class="sidebar-link active w-full flex items-center gap-3 px-4 py-3 rounded-xl text-sm text-slate-600 border-l-0">
                                <span>👤</span> Profil Saya
                            </button>
                            <button onclick="switchTab('settings')" id="tab-btn-settings" class="sidebar-link w-full flex items-center gap-3 px-4 py-3 rounded-xl text-sm text-slate-600 border-l-0">
                                <span>⚙️</span> Pengaturan
                            </button>
                            <button onclick="switchTab('security')" id="tab-btn-security" class="sidebar-link w-full flex items-center gap-3 px-4 py-3 rounded-xl text-sm text-slate-600 border-l-0">
                                <span>🔒</span> Keamanan
                            </button>
                        </nav>
                        <div class="p-3 border-t border-slate-100">
                            <a href="/search" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold text-slate-600 hover:bg-slate-100 hover:text-slate-800 transition-colors">
                                <span>🔙</span> Kembali ke Pencarian
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="lg:col-span-3 space-y-6">

                    <!-- Flash Messages -->
                    @if(session('success'))
                    <div class="flex items-center gap-3 p-4 bg-green-50 border border-green-200 rounded-2xl text-green-700 text-sm font-semibold">
                        <span class="text-xl">✅</span> {{ session('success') }}
                    </div>
                    @endif
                    @if(session('success_password'))
                    <div class="flex items-center gap-3 p-4 bg-green-50 border border-green-200 rounded-2xl text-green-700 text-sm font-semibold">
                        <span class="text-xl">✅</span> {{ session('success_password') }}
                    </div>
                    @endif

                    <!-- Tab: Profile -->
                    <div id="tab-profile" class="tab-content active">
                        <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-8">
                            <h2 class="text-xl font-bold text-slate-800 mb-6 flex items-center gap-2"><span>👤</span> Informasi Profil</h2>

                            <!-- Profile Stats -->
                            <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 mb-8">
                                <div class="bg-rose-50 rounded-2xl p-4 text-center border border-rose-100">
                                    <p class="text-2xl font-extrabold text-rose-600">{{ auth()->user()->reviews()->count() ?? 0 }}</p>
                                    <p class="text-xs font-semibold text-rose-500 mt-1">Ulasan Diberikan</p>
                                </div>
                                <div class="bg-orange-50 rounded-2xl p-4 text-center border border-orange-100">
                                    <p class="text-2xl font-extrabold text-orange-500">{{ auth()->user()->reviewLikes()->count() ?? 0 }}</p>
                                    <p class="text-xs font-semibold text-orange-400 mt-1">Like Diberikan</p>
                                </div>
                                <div class="bg-slate-50 rounded-2xl p-4 text-center border border-slate-100 col-span-2 sm:col-span-1">
                                    <p class="text-lg font-extrabold text-slate-700">{{ auth()->user()->created_at->format('M Y') }}</p>
                                    <p class="text-xs font-semibold text-slate-400 mt-1">Bergabung Sejak</p>
                                </div>
                            </div>

                            <!-- Read-only info -->
                            <div class="space-y-4">
                                <div class="flex flex-col sm:flex-row sm:items-center gap-1 sm:gap-6 p-4 bg-slate-50 rounded-2xl border border-slate-100">
                                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider w-28 shrink-0">Nama Lengkap</span>
                                    <span class="font-semibold text-slate-800">{{ auth()->user()->name }}</span>
                                </div>
                                <div class="flex flex-col sm:flex-row sm:items-center gap-1 sm:gap-6 p-4 bg-slate-50 rounded-2xl border border-slate-100">
                                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider w-28 shrink-0">Email</span>
                                    <span class="font-semibold text-slate-800">{{ auth()->user()->email }}</span>
                                </div>
                                <div class="flex flex-col sm:flex-row sm:items-center gap-1 sm:gap-6 p-4 bg-slate-50 rounded-2xl border border-slate-100">
                                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider w-28 shrink-0">Role</span>
                                    <span class="font-semibold text-slate-800 capitalize">{{ auth()->user()->role ?? 'user' }}</span>
                                </div>
                                <div class="flex flex-col sm:flex-row sm:items-center gap-1 sm:gap-6 p-4 bg-slate-50 rounded-2xl border border-slate-100">
                                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider w-28 shrink-0">Bergabung</span>
                                    <span class="font-semibold text-slate-800">{{ auth()->user()->created_at->translatedFormat('d F Y') }}</span>
                                </div>
                            </div>

                            <div class="mt-6 pt-6 border-t border-slate-100">
                                <button onclick="switchTab('settings')" class="px-6 py-3 bg-gradient-to-r from-rose-500 to-orange-400 hover:from-rose-600 hover:to-orange-500 text-white font-bold rounded-xl shadow-md hover:shadow-lg hover:-translate-y-0.5 transition-all duration-200 text-sm">
                                    ✏️ Edit Profil
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Tab: Settings -->
                    <div id="tab-settings" class="tab-content">
                        <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-8">
                            <h2 class="text-xl font-bold text-slate-800 mb-6 flex items-center gap-2"><span>⚙️</span> Edit Profil</h2>

                            @if($errors->has('name') || $errors->has('email'))
                                <div class="mb-4 p-4 bg-red-50 border border-red-100 rounded-2xl text-red-600 text-sm">
                                    <ul class="space-y-1">
                                        @foreach($errors->all() as $e)<li>⚠️ {{ $e }}</li>@endforeach
                                    </ul>
                                </div>
                            @endif

                            <form action="{{ route('profile.update') }}" method="POST" class="space-y-5">
                                @csrf
                                <div>
                                    <label for="name" class="block text-sm font-bold text-slate-700 mb-2">Nama Lengkap</label>
                                    <input type="text" id="name" name="name" value="{{ old('name', auth()->user()->name) }}" required
                                        class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-rose-500 focus:border-rose-500 outline-none transition-all font-medium text-slate-800">
                                </div>
                                <div>
                                    <label for="email" class="block text-sm font-bold text-slate-700 mb-2">Alamat Email</label>
                                    <input type="email" id="email" name="email" value="{{ old('email', auth()->user()->email) }}" required
                                        class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-rose-500 focus:border-rose-500 outline-none transition-all font-medium text-slate-800">
                                </div>
                                <div class="pt-2">
                                    <button type="submit" class="px-8 py-3.5 bg-gradient-to-r from-rose-500 to-orange-400 hover:from-rose-600 hover:to-orange-500 text-white font-bold rounded-xl shadow-md hover:shadow-lg hover:-translate-y-0.5 transition-all duration-200 text-sm">
                                        💾 Simpan Perubahan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Tab: Security -->
                    <div id="tab-security" class="tab-content">
                        <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-8">
                            <h2 class="text-xl font-bold text-slate-800 mb-6 flex items-center gap-2"><span>🔒</span> Ubah Password</h2>

                            @if($errors->has('current_password') || $errors->has('password'))
                                <div class="mb-4 p-4 bg-red-50 border border-red-100 rounded-2xl text-red-600 text-sm">
                                    <ul class="space-y-1">
                                        @foreach($errors->all() as $e)<li>⚠️ {{ $e }}</li>@endforeach
                                    </ul>
                                </div>
                            @endif

                            <form action="{{ route('profile.password') }}" method="POST" class="space-y-5">
                                @csrf
                                <div>
                                    <label for="current_password" class="block text-sm font-bold text-slate-700 mb-2">Password Saat Ini</label>
                                    <input type="password" id="current_password" name="current_password" required
                                        class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-rose-500 focus:border-rose-500 outline-none transition-all font-medium text-slate-800"
                                        placeholder="••••••••">
                                </div>
                                <div>
                                    <label for="new_password" class="block text-sm font-bold text-slate-700 mb-2">Password Baru</label>
                                    <input type="password" id="new_password" name="password" required minlength="8"
                                        class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-rose-500 focus:border-rose-500 outline-none transition-all font-medium text-slate-800"
                                        placeholder="Min. 8 karakter">
                                </div>
                                <div>
                                    <label for="password_confirmation" class="block text-sm font-bold text-slate-700 mb-2">Konfirmasi Password Baru</label>
                                    <input type="password" id="password_confirmation" name="password_confirmation" required
                                        class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-rose-500 focus:border-rose-500 outline-none transition-all font-medium text-slate-800"
                                        placeholder="Ulangi password baru">
                                </div>
                                <div class="pt-2">
                                    <button type="submit" class="px-8 py-3.5 bg-gradient-to-r from-rose-500 to-orange-400 hover:from-rose-600 hover:to-orange-500 text-white font-bold rounded-xl shadow-md hover:shadow-lg hover:-translate-y-0.5 transition-all duration-200 text-sm">
                                        🔐 Ubah Password
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- Danger Zone -->
                        <div class="bg-white rounded-3xl border border-red-100 shadow-sm p-8 mt-6">
                            <h2 class="text-xl font-bold text-red-700 mb-2 flex items-center gap-2"><span>⚠️</span> Zona Berbahaya</h2>
                            <p class="text-slate-500 text-sm mb-4">Tindakan ini bersifat permanen dan tidak dapat dibatalkan.</p>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="px-6 py-3 border-2 border-red-500 text-red-600 hover:bg-red-500 hover:text-white font-bold rounded-xl transition-all duration-200 text-sm">
                                    🚪 Keluar dari Semua Sesi
                                </button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </main>

    <footer class="bg-white border-t border-slate-200 pt-16 pb-8 mt-auto">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-start gap-12 mb-12">
                <div class="flex flex-col gap-4 max-w-sm">
                    <a href="/search" class="text-2xl font-bold tracking-tight bg-gradient-to-r from-rose-500 to-orange-400 bg-clip-text text-transparent flex items-center gap-2">
                        <img src="/images/logo.png" alt="BudgetBite Logo" class="h-8 w-8 object-contain rounded-lg"> BudgetBite
                    </a>
                    <p class="text-slate-500 text-sm leading-relaxed">Solusi cerdas perencanaan makan harian Anda. Temukan resep lezat, hemat, dan praktis untuk keluarga tercinta setiap harinya.</p>
                </div>
                
                <div class="flex flex-wrap gap-12 md:gap-24">
                    <div class="flex flex-col gap-3">
                        <h4 class="text-slate-800 font-bold text-sm uppercase tracking-wider mb-1">Eksplorasi</h4>
                        <a class="text-slate-500 text-sm hover:text-rose-500 transition-colors" href="/search">Cari Resep</a>
                        <a class="text-slate-500 text-sm hover:text-rose-500 transition-colors" href="/search?category=1">Makanan Berat</a>
                        <a class="text-slate-500 text-sm hover:text-rose-500 transition-colors" href="/search?category=2">Cemilan</a>
                    </div>
                    
                    <div class="flex flex-col gap-3">
                        <h4 class="text-slate-800 font-bold text-sm uppercase tracking-wider mb-1">Bantuan</h4>
                        <a class="text-slate-500 text-sm hover:text-rose-500 transition-colors" href="/about">Tentang Kami</a>
                        <a class="text-slate-500 text-sm hover:text-rose-500 transition-colors" href="/privacy">Kebijakan Privasi</a>
                        <a class="text-slate-500 text-sm hover:text-rose-500 transition-colors" href="/contact">Hubungi Kami</a>
                    </div>
                </div>
            </div>
            
            <div class="border-t border-slate-100 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-slate-400 text-xs text-center md:text-left">© 2026 BudgetBite. Dikembangkan dengan ❤️. Hak Cipta Dilindungi.</p>
            </div>
        </div>
    </footer>

    <script>
        // Profile dropdown
        function toggleProfileMenu() {
            document.getElementById('profileMenu').classList.toggle('hidden');
        }
        document.addEventListener('click', function(e) {
            const wrapper = document.getElementById('profileDropdownWrapper');
            if (wrapper && !wrapper.contains(e.target)) {
                document.getElementById('profileMenu').classList.add('hidden');
            }
        });

        // Tab switching
        const tabs = ['profile', 'settings', 'security'];
        function switchTab(tab) {
            tabs.forEach(t => {
                document.getElementById('tab-' + t).classList.remove('active');
                const btn = document.getElementById('tab-btn-' + t);
                btn.classList.remove('active');
                btn.style.borderLeftWidth = '0';
            });
            document.getElementById('tab-' + tab).classList.add('active');
            const activeBtn = document.getElementById('tab-btn-' + tab);
            activeBtn.classList.add('active');
            activeBtn.style.borderLeftWidth = '3px';
        }

        // Check URL param for tab
        const urlParams = new URLSearchParams(window.location.search);
        const tabParam = urlParams.get('tab');
        if (tabParam && tabs.includes(tabParam)) switchTab(tabParam);

        // Auto-open relevant tab if there are errors
        @if($errors->has('current_password') || $errors->has('password'))
            switchTab('security');
        @elseif($errors->has('name') || $errors->has('email'))
            switchTab('settings');
        @endif
    </script>
</body>
</html>

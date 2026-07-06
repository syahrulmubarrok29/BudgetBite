<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>BudgetBite - Daftar</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
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
        .glass-panel {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }
        
        .floating-input:focus ~ .floating-label,
        .floating-input:not(:placeholder-shown) ~ .floating-label {
            transform: translateY(-1.5rem) scale(0.85);
            color: #9a4600; /* primary color */
        }
    </style>
</head>
<body class="bg-background text-on-background font-body-md h-screen overflow-hidden flex">
    <!-- Split Screen Layout -->
    <div class="flex w-full h-full">
        <!-- Left Side: Visual/Photography (Hidden on Mobile) -->
        <div class="hidden md:flex md:w-1/2 lg:w-3/5 relative">
            <div class="absolute inset-0 bg-black/20 z-10"></div>
            <div class="w-full h-full bg-cover bg-center absolute inset-0 z-0" data-alt="A top-down view of a beautifully plated, affordable yet gourmet-looking meal, perhaps a vibrant roasted vegetable bowl with a drizzle of sauce. The lighting is soft, natural, and inviting, creating a fresh and appetizing mood. The style is high-end editorial food photography with clean lines and warm, comforting colors, reflecting a modern, budget-conscious lifestyle." style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuDie5W4B0JMg8N564CkMV-8AET4W38DTMsYazTnFrR3jp8rfom-EaGKY3GdOWeZDcRTyDdOerj_KfU3lH3bYi0G-KBYp3PLhc9iaTtNJM1OoH46H6YFTXcR-A2NpMHXVTXpdrGXxUUCMHuJTCn-1slZSZs0p9S_kQ9HhMtuPq6MievlxRRMtCaQcJNAp6390H7ir8qBxqyWMx9IcJqProgMxP5Am1BCbHoE2RZe-tNCCv4DdDu0Oe1M')"></div>
            <div class="z-20 relative p-xl flex flex-col justify-end h-full text-white">
                <h1 class="font-display-lg text-display-lg mb-4 max-w-lg drop-shadow-md">Makan enak tetap hemat.</h1>
                <p class="font-body-lg text-body-lg max-w-md opacity-90 drop-shadow-md">Bergabunglah dengan ribuan pengguna lain untuk merencanakan hidangan lezat dan ramah kantong setiap hari.</p>
            </div>
        </div>

        <!-- Right Side: Form Container -->
        <div class="w-full md:w-1/2 lg:w-2/5 flex items-center justify-center p-6 sm:p-12 relative overflow-y-auto overflow-x-hidden bg-surface-container-lowest">
            <!-- Minimalist Decorative Background Element -->
            <div class="absolute top-0 right-0 w-64 h-64 bg-primary-fixed/20 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2 pointer-events-none"></div>
            
            <div class="w-full max-w-md relative z-10">
                <!-- Brand Anchor -->
                <div class="mb-10 text-center md:text-left">
                    <h2 class="font-headline-lg text-headline-lg text-primary mb-2 flex items-center justify-center md:justify-start gap-2">
                        <span class="material-symbols-outlined text-[32px]">restaurant</span>
                        BudgetBite
                    </h2>
                    <p class="font-body-md text-body-md text-on-surface-variant">Buat akun baru dan mulailah berhemat.</p>
                </div>

                <!-- Toggle Navigation -->
                <div class="flex space-x-8 border-b border-surface-variant mb-8 relative">
                    <a href="{{ url('/login') }}" class="pb-3 px-1 font-label-md text-label-md text-on-surface-variant hover:text-primary transition-colors focus:outline-none inline-block">Login</a>
                    <button aria-current="page" class="pb-3 px-1 font-label-md text-label-md text-primary border-b-2 border-primary transition-colors focus:outline-none">Daftar</button>
                </div>

                @if($errors->any())
                    <div class="bg-error-container border border-error/20 text-on-error-container px-4 py-3 rounded-lg font-label-sm text-label-sm mb-6 flex items-start gap-2">
                        <span class="material-symbols-outlined text-[20px]">error</span>
                        <div class="flex flex-col">
                            <span class="font-bold">Oops! Ada yang salah:</span>
                            <ul class="list-disc pl-4 mt-1">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                <!-- Form Card -->
                <form class="space-y-6" action="{{ url('/register') }}" method="POST">
                    @csrf

                    <!-- Name Input -->
                    <div>
                        <label class="block font-label-md text-on-surface-variant mb-1.5" for="name">Nama Lengkap</label>
                        <input class="w-full bg-white border border-gray-200 rounded-[10px] text-on-surface py-3 px-4 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors placeholder:text-gray-400" id="name" name="name" placeholder="Masukkan nama Anda" required="" type="text" value="{{ old('name') }}"/>
                    </div>

                    <!-- Email Input -->
                    <div>
                        <label class="block font-label-md text-on-surface-variant mb-1.5" for="email">Alamat Email</label>
                        <input class="w-full bg-white border border-gray-200 rounded-[10px] text-on-surface py-3 px-4 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors placeholder:text-gray-400" id="email" name="email" placeholder="Masukkan email Anda" required="" type="email" value="{{ old('email') }}"/>
                    </div>

                    <!-- Password Input -->
                    <div class="relative">
                        <label class="block font-label-md text-on-surface-variant mb-1.5" for="password">Kata Sandi</label>
                        <input class="w-full bg-white border border-gray-200 rounded-[10px] text-on-surface py-3 px-4 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors placeholder:text-gray-400" id="password" name="password" placeholder="Masukkan kata sandi Anda" required="" type="password"/>
                        <button class="absolute right-3 top-[38px] text-gray-400 hover:text-primary transition-colors focus:outline-none" type="button" onclick="const p = document.getElementById('password'); p.type = p.type === 'password' ? 'text' : 'password'; this.querySelector('span').textContent = p.type === 'password' ? 'visibility' : 'visibility_off';">
                            <span class="material-symbols-outlined text-[20px]" data-icon="visibility">visibility</span>
                        </button>
                    </div>

                    <!-- Password Confirmation Input -->
                    <div class="relative">
                        <label class="block font-label-md text-on-surface-variant mb-1.5" for="password_confirmation">Konfirmasi Kata Sandi</label>
                        <input class="w-full bg-white border border-gray-200 rounded-[10px] text-on-surface py-3 px-4 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors placeholder:text-gray-400" id="password_confirmation" name="password_confirmation" placeholder="Ulangi kata sandi Anda" required="" type="password"/>
                        <button class="absolute right-3 top-[38px] text-gray-400 hover:text-primary transition-colors focus:outline-none" type="button" onclick="const p = document.getElementById('password_confirmation'); p.type = p.type === 'password' ? 'text' : 'password'; this.querySelector('span').textContent = p.type === 'password' ? 'visibility' : 'visibility_off';">
                            <span class="material-symbols-outlined text-[20px]" data-icon="visibility">visibility</span>
                        </button>
                    </div>

                    <!-- Submit Button -->
                    <button class="w-full mt-8 bg-primary text-on-primary font-label-md text-label-md py-4 px-6 rounded-full hover:bg-primary/90 hover:scale-[1.02] shadow-[0_4px_20px_rgba(0,0,0,0.04)] hover:shadow-[0_8px_24px_rgba(0,0,0,0.08)] transition-all duration-200 flex justify-center items-center gap-2" type="submit">
                        <span>Daftar Sekarang</span>
                        <span class="material-symbols-outlined" data-icon="arrow_forward">arrow_forward</span>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const inputs = document.querySelectorAll('.floating-input');
            inputs.forEach(input => {
                // Ensure label stays up if there's a value on load
                if(input.value) {
                    input.classList.add('not-empty');
                }
                
                input.addEventListener('blur', () => {
                    if (input.value) {
                        input.classList.add('not-empty');
                    } else {
                        input.classList.remove('not-empty');
                    }
                });
            });
        });
    </script>
</body>
</html>

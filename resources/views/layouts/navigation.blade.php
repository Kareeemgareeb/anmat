<nav x-data="{ open: false }" class="bg-white dark:bg-slate-900 border-b border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white sticky top-0 z-40">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16 w-full">
            <div class="flex items-center gap-4 xl:gap-6 shrink-0">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2.5 shrink-0">
                        <img src="{{ asset('images/logo-dark.png') }}" alt="ANMAT" class="h-9 w-auto object-contain">
                        <div class="flex flex-col">
                            <span class="font-extrabold text-sm sm:text-base tracking-tight text-slate-900 dark:text-white leading-tight whitespace-nowrap">{{ __('ANMAT Engineering') }}</span>
                            <span class="text-[10px] sm:text-xs text-amber-600 dark:text-amber-400 font-semibold tracking-wider uppercase leading-tight whitespace-nowrap">{{ __('Admin Portal') }}</span>
                        </div>
                    </a>
                </div>

                <!-- Navigation Links (Desktop xl+) -->
                <div class="hidden xl:flex items-center gap-1">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-slate-700 dark:text-slate-200 hover:text-amber-500 px-2.5 py-2 text-sm font-medium whitespace-nowrap shrink-0">
                        <i class="fa-solid fa-chart-pie me-1.5 text-amber-500"></i> {{ __('Dashboard') }}
                    </x-nav-link>

                    <x-nav-link :href="route('admin.correspondences.index')" :active="request()->routeIs('admin.correspondences.*')" class="text-slate-700 dark:text-slate-200 hover:text-amber-500 px-2.5 py-2 text-sm font-medium whitespace-nowrap shrink-0">
                        <i class="fa-solid fa-folder-tree me-1.5 text-amber-500"></i> {{ __('Archive & Letters') }}
                    </x-nav-link>

                    <x-nav-link :href="route('admin.services.index')" :active="request()->routeIs('admin.services.*')" class="text-slate-700 dark:text-slate-200 hover:text-amber-500 px-2.5 py-2 text-sm font-medium whitespace-nowrap shrink-0">
                        <i class="fa-solid fa-compass-drafting me-1.5 text-amber-500"></i> {{ __('Services') }}
                    </x-nav-link>

                    <x-nav-link :href="route('admin.projects.index')" :active="request()->routeIs('admin.projects.*')" class="text-slate-700 dark:text-slate-200 hover:text-amber-500 px-2.5 py-2 text-sm font-medium whitespace-nowrap shrink-0">
                        <i class="fa-solid fa-city me-1.5 text-amber-500"></i> {{ __('Projects') }}
                    </x-nav-link>

                    <x-nav-link :href="route('admin.inquiries.index')" :active="request()->routeIs('admin.inquiries.*')" class="text-slate-700 dark:text-slate-200 hover:text-amber-500 px-2.5 py-2 text-sm font-medium whitespace-nowrap shrink-0 relative">
                        <i class="fa-solid fa-envelope me-1.5 text-amber-500"></i> {{ __('Inquiries') }}
                        @php $newCount = \App\Models\Inquiry::where('status', 'new')->count(); @endphp
                        @if($newCount > 0)
                            <span class="ms-1 px-1.5 py-0.2 text-[10px] font-bold bg-amber-500 text-slate-950 rounded-full">{{ $newCount }}</span>
                        @endif
                    </x-nav-link>

                    <x-nav-link :href="route('admin.settings.index')" :active="request()->routeIs('admin.settings.*')" class="text-slate-700 dark:text-slate-200 hover:text-amber-500 px-2.5 py-2 text-sm font-medium whitespace-nowrap shrink-0">
                        <i class="fa-solid fa-sliders me-1.5 text-amber-500"></i> {{ __('Site Settings') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Right Actions (Desktop xl+) -->
            <div class="hidden xl:flex items-center gap-2 shrink-0">
                <!-- Language Switcher -->
                @if(app()->getLocale() == 'ar')
                    <a href="{{ route('lang.switch', 'en') }}" class="inline-flex items-center gap-1.5 px-2.5 py-1.5 rounded-lg text-xs font-bold text-slate-700 dark:text-slate-200 hover:text-amber-600 dark:hover:text-amber-400 bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 border border-slate-300 dark:border-slate-700 whitespace-nowrap shrink-0 transition" title="Switch to English">
                        <i class="fa-solid fa-globe text-amber-500"></i>
                        <span>English</span>
                    </a>
                @else
                    <a href="{{ route('lang.switch', 'ar') }}" class="inline-flex items-center gap-1.5 px-2.5 py-1.5 rounded-lg text-xs font-bold text-slate-700 dark:text-slate-200 hover:text-amber-600 dark:hover:text-amber-400 bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 border border-slate-300 dark:border-slate-700 whitespace-nowrap shrink-0 transition" title="التحويل إلى العربية">
                        <i class="fa-solid fa-globe text-amber-500"></i>
                        <span>عربي</span>
                    </a>
                @endif

                <!-- View Website -->
                <a href="{{ route('home') }}" target="_blank" class="inline-flex items-center gap-1.5 px-2.5 py-1.5 text-xs font-semibold rounded-lg text-amber-700 dark:text-amber-300 bg-amber-50 dark:bg-slate-800 hover:bg-amber-100 dark:hover:bg-slate-700 border border-amber-200 dark:border-slate-700 whitespace-nowrap shrink-0 transition">
                    <i class="fa-solid fa-arrow-up-right-from-square"></i>
                    <span>{{ __('View Website') }}</span>
                </a>

                <!-- Theme Toggle Button -->
                <button id="theme-toggle" type="button" class="text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 border border-slate-300 dark:border-slate-700 focus:outline-none rounded-lg text-sm p-2 shrink-0 transition" title="{{ __('Toggle Theme') }}">
                    <i id="theme-toggle-dark-icon" class="hidden fa-solid fa-moon text-slate-700"></i>
                    <i id="theme-toggle-light-icon" class="hidden fa-solid fa-sun text-amber-400"></i>
                </button>

                <!-- Profile Dropdown -->
                <x-dropdown align="{{ app()->getLocale() == 'ar' ? 'left' : 'right' }}" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-1.5 border border-slate-300 dark:border-slate-700 text-xs sm:text-sm font-semibold rounded-lg text-slate-700 dark:text-slate-300 bg-slate-100 dark:bg-slate-800 hover:text-slate-900 dark:hover:text-white focus:outline-none shrink-0 transition">
                            <i class="fa-regular fa-user-circle text-base me-1.5 text-amber-500"></i>
                            <div class="max-w-[120px] truncate">{{ Auth::user()?->name ?? __('Admin Portal') }}</div>
                            <i class="fa-solid fa-chevron-down ms-1.5 text-[10px] text-slate-400"></i>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            <i class="fa-solid fa-user-gear me-2 text-slate-400"></i> {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                <i class="fa-solid fa-arrow-right-from-bracket me-2 text-red-400"></i> {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger & Quick Mobile/Tablet Controls (Mobile/Tablet xl:hidden) -->
            <div class="flex items-center gap-2 xl:hidden shrink-0">
                <!-- Mobile Lang Switcher Direct Access -->
                @if(app()->getLocale() == 'ar')
                    <a href="{{ route('lang.switch', 'en') }}" class="px-2.5 py-1.5 rounded-lg text-xs font-bold text-slate-700 dark:text-slate-200 bg-slate-100 dark:bg-slate-800 border border-slate-300 dark:border-slate-700">
                        EN
                    </a>
                @else
                    <a href="{{ route('lang.switch', 'ar') }}" class="px-2.5 py-1.5 rounded-lg text-xs font-bold text-slate-700 dark:text-slate-200 bg-slate-100 dark:bg-slate-800 border border-slate-300 dark:border-slate-700">
                        عربي
                    </a>
                @endif

                <button id="theme-toggle-mobile" type="button" class="p-2 rounded-lg text-slate-600 dark:text-slate-300 bg-slate-100 dark:bg-slate-800 border border-slate-300 dark:border-slate-700">
                    <i id="theme-toggle-mobile-dark-icon" class="hidden fa-solid fa-moon"></i>
                    <i id="theme-toggle-mobile-light-icon" class="hidden fa-solid fa-sun text-amber-400"></i>
                </button>

                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-lg text-slate-600 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white bg-slate-100 dark:bg-slate-800 border border-slate-300 dark:border-slate-700 focus:outline-none transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Mobile/Tablet Navigation Drawer (xl:hidden) -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden xl:hidden bg-white dark:bg-slate-950 border-t border-slate-200 dark:border-slate-800 px-4 py-4 space-y-3">
        <div class="space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="rounded-lg">
                <i class="fa-solid fa-chart-pie me-2 text-amber-500"></i> {{ __('Dashboard') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('admin.correspondences.index')" :active="request()->routeIs('admin.correspondences.*')" class="rounded-lg">
                <i class="fa-solid fa-folder-tree me-2 text-amber-500"></i> {{ __('Archive & Letters') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('admin.services.index')" :active="request()->routeIs('admin.services.*')" class="rounded-lg">
                <i class="fa-solid fa-compass-drafting me-2 text-amber-500"></i> {{ __('Services') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('admin.projects.index')" :active="request()->routeIs('admin.projects.*')" class="rounded-lg">
                <i class="fa-solid fa-city me-2 text-amber-500"></i> {{ __('Projects') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('admin.inquiries.index')" :active="request()->routeIs('admin.inquiries.*')" class="rounded-lg flex items-center justify-between">
                <div>
                    <i class="fa-solid fa-envelope me-2 text-amber-500"></i> {{ __('Inquiries') }}
                </div>
                @php $newCount = \App\Models\Inquiry::where('status', 'new')->count(); @endphp
                @if($newCount > 0)
                    <span class="px-2 py-0.5 text-xs font-bold bg-amber-500 text-slate-950 rounded-full">{{ $newCount }}</span>
                @endif
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('admin.settings.index')" :active="request()->routeIs('admin.settings.*')" class="rounded-lg">
                <i class="fa-solid fa-sliders me-2 text-amber-500"></i> {{ __('Site Settings') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('home')" target="_blank" class="rounded-lg text-amber-600 dark:text-amber-400">
                <i class="fa-solid fa-arrow-up-right-from-square me-2"></i> {{ __('View Website') }}
            </x-responsive-nav-link>
        </div>

        <div class="pt-3 border-t border-slate-200 dark:border-slate-800">
            <div class="px-2 mb-2">
                <div class="font-bold text-sm text-slate-900 dark:text-white">{{ Auth::user()?->name ?? __('Admin Portal') }}</div>
                <div class="text-xs text-slate-500 dark:text-slate-400">{{ Auth::user()?->email ?? '' }}</div>
            </div>

            <div class="space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')" class="rounded-lg">
                    <i class="fa-solid fa-user-gear me-2 text-slate-400"></i> {{ __('Profile') }}
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();"
                            class="rounded-lg text-red-500 hover:text-red-600">
                        <i class="fa-solid fa-arrow-right-from-bracket me-2"></i> {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>

<script>
    function updateThemeIcons() {
        var isDark = document.documentElement.classList.contains('dark');
        var dDark = document.getElementById('theme-toggle-dark-icon');
        var dLight = document.getElementById('theme-toggle-light-icon');
        var mDark = document.getElementById('theme-toggle-mobile-dark-icon');
        var mLight = document.getElementById('theme-toggle-mobile-light-icon');

        if (isDark) {
            if(dLight) dLight.classList.remove('hidden');
            if(dDark) dDark.classList.add('hidden');
            if(mLight) mLight.classList.remove('hidden');
            if(mDark) mDark.classList.add('hidden');
        } else {
            if(dDark) dDark.classList.remove('hidden');
            if(dLight) dLight.classList.add('hidden');
            if(mDark) mDark.classList.remove('hidden');
            if(mLight) mLight.classList.add('hidden');
        }
    }

    function toggleThemeMode() {
        if (document.documentElement.classList.contains('dark')) {
            document.documentElement.classList.remove('dark');
            localStorage.setItem('color-theme', 'light');
        } else {
            document.documentElement.classList.add('dark');
            localStorage.setItem('color-theme', 'dark');
        }
        updateThemeIcons();
    }

    // Initialize icons on load
    updateThemeIcons();

    var themeToggleBtn = document.getElementById('theme-toggle');
    if (themeToggleBtn) {
        themeToggleBtn.addEventListener('click', toggleThemeMode);
    }
    var themeToggleMobileBtn = document.getElementById('theme-toggle-mobile');
    if (themeToggleMobileBtn) {
        themeToggleMobileBtn.addEventListener('click', toggleThemeMode);
    }
</script>

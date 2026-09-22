<nav x-data="{ open: false }" class="bg-slate-900 border-b border-slate-800 text-white">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
                        <img src="{{ asset('images/logo-dark.png') }}" alt="ANMAT" class="h-10 w-auto" style="height: 38px; width: auto; max-height: 38px; object-fit: contain;">
                        <div class="hidden md:flex flex-col">
                            <span class="font-extrabold text-base tracking-tight text-white">أنماط الهندسية</span>
                            <span class="text-xs text-amber-400 font-semibold tracking-wider uppercase">Admin Portal</span>
                        </div>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-6 sm:-my-px sm:ms-8 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-slate-200 hover:text-amber-400">
                        <i class="fa-solid fa-chart-pie me-1 text-amber-400"></i> {{ __('Dashboard') }}
                    </x-nav-link>

                    <x-nav-link :href="route('admin.correspondences.index')" :active="request()->routeIs('admin.correspondences.*')" class="text-slate-200 hover:text-amber-400">
                        <i class="fa-solid fa-folder-tree me-1 text-amber-400"></i> {{ __('Archive & Letters') }}
                    </x-nav-link>

                    <x-nav-link :href="route('admin.services.index')" :active="request()->routeIs('admin.services.*')" class="text-slate-200 hover:text-amber-400">
                        <i class="fa-solid fa-compass-drafting me-1 text-amber-400"></i> {{ __('Services') }}
                    </x-nav-link>

                    <x-nav-link :href="route('admin.projects.index')" :active="request()->routeIs('admin.projects.*')" class="text-slate-200 hover:text-amber-400">
                        <i class="fa-solid fa-city me-1 text-amber-400"></i> {{ __('Projects') }}
                    </x-nav-link>

                    <x-nav-link :href="route('admin.inquiries.index')" :active="request()->routeIs('admin.inquiries.*')" class="text-slate-200 hover:text-amber-400 relative">
                        <i class="fa-solid fa-envelope me-1 text-amber-400"></i> {{ __('Inquiries') }}
                        @php $newCount = \App\Models\Inquiry::where('status', 'new')->count(); @endphp
                        @if($newCount > 0)
                            <span class="ms-1.5 px-1.5 py-0.5 text-xs font-bold bg-amber-500 text-black rounded-full">{{ $newCount }}</span>
                        @endif
                    </x-nav-link>

                    <x-nav-link :href="route('admin.settings.index')" :active="request()->routeIs('admin.settings.*')" class="text-slate-200 hover:text-amber-400">
                        <i class="fa-solid fa-sliders me-1 text-amber-400"></i> {{ __('Site Settings') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Right Actions (View Site & Profile) -->
            <div class="hidden sm:flex sm:items-center sm:ms-6 gap-3">
                <a href="{{ route('home') }}" target="_blank" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold rounded-md text-amber-300 bg-slate-800 hover:bg-slate-700 border border-slate-700 transition">
                    <i class="fa-solid fa-arrow-up-right-from-square"></i>
                    <span>{{ __('View Website') }}</span>
                </a>

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-slate-700 text-sm leading-4 font-medium rounded-md text-slate-300 bg-slate-800 hover:text-white focus:outline-none transition ease-in-out duration-150">
                            <i class="fa-regular fa-user-circle text-lg me-2 text-amber-400"></i>
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-slate-400 hover:text-white hover:bg-slate-800 focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-slate-950 border-t border-slate-800">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-slate-200">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.correspondences.index')" :active="request()->routeIs('admin.correspondences.*')" class="text-slate-200">
                {{ __('Archive & Letters') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.services.index')" :active="request()->routeIs('admin.services.*')" class="text-slate-200">
                {{ __('Services') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.projects.index')" :active="request()->routeIs('admin.projects.*')" class="text-slate-200">
                {{ __('Projects') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.inquiries.index')" :active="request()->routeIs('admin.inquiries.*')" class="text-slate-200">
                {{ __('Inquiries') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.settings.index')" :active="request()->routeIs('admin.settings.*')" class="text-slate-200">
                {{ __('Site Settings') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('home')" target="_blank" class="text-amber-400">
                {{ __('View Website') }}
            </x-responsive-nav-link>
        </div>

        <div class="pt-4 pb-1 border-t border-slate-800">
            <div class="px-4">
                <div class="font-medium text-base text-white">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-slate-400">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>

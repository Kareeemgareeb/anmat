<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta name="description" content="{{ app()->getLocale() == 'ar' ? 'أنماط للأعمال والاستشارات الهندسية - بيت خبرة متخصص في الرفع المساحي، التصميم الإنشائي والمعماري، وإدارة المشاريع.' : 'ANMAT Engineering Works & Consultancy - Specialized in geodetic surveying, structural & architectural design, and project supervision.' }}">
    <title>@yield('title', app()->getLocale() == 'ar' ? 'أنماط للأعمال والاستشارات الهندسية | ANMAT' : 'ANMAT Engineering Works & Consultancy')</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/jpeg" href="{{ asset('images/logo-light.jpg') }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&family=Tajawal:wght@300;400;500;700;800;900&display=swap" rel="stylesheet">
    
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Global Stylesheet -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}?v={{ time() }}">

    <script>
        // Initialize Theme from LocalStorage or default to dark luxury theme
        const savedTheme = localStorage.getItem('theme') || 'dark';
        document.documentElement.setAttribute('data-theme', savedTheme);
    </script>
</head>
<body>

    <!-- Main Navigation Bar -->
    <header class="navbar">
        <div class="container nav-container">
            <a href="{{ route('home') }}" class="brand-link">
                <!-- Dark theme logo -->
                <img src="{{ asset('images/logo-dark.png') }}" alt="ANMAT Logo" class="brand-logo-img logo-for-dark">
                <!-- Light theme logo -->
                <img src="{{ asset('images/logo-light.jpg') }}" alt="ANMAT Logo" class="brand-logo-img logo-for-light">
                
                <div class="brand-text-block">
                    <span class="brand-title">{{ app()->getLocale() == 'ar' ? 'أنماط' : 'ANMAT' }}</span>
                    <span class="brand-subtitle">{{ app()->getLocale() == 'ar' ? 'للأعمال والاستشارات الهندسية' : 'Works & Consultancy' }}</span>
                </div>
            </a>

            <!-- Desktop Links -->
            <ul class="nav-links">
                <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">{{ app()->getLocale() == 'ar' ? 'الرئيسية' : 'Home' }}</a></li>
                <li><a href="{{ route('services') }}" class="{{ request()->routeIs('services') ? 'active' : '' }}">{{ app()->getLocale() == 'ar' ? 'خدماتنا' : 'Services' }}</a></li>
                <li><a href="{{ route('projects') }}" class="{{ request()->routeIs('projects') ? 'active' : '' }}">{{ app()->getLocale() == 'ar' ? 'مشاريعنا' : 'Projects' }}</a></li>
                <li><a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">{{ app()->getLocale() == 'ar' ? 'من نحن' : 'About' }}</a></li>
                <li><a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">{{ app()->getLocale() == 'ar' ? 'اتصل بنا' : 'Contact' }}</a></li>
                <li><a href="{{ route('verify.document') }}" class="{{ request()->routeIs('verify.document') ? 'active' : '' }}" title="{{ app()->getLocale() == 'ar' ? 'التحقق من صحة وثيقة أو خطاب' : 'Verify Official Document' }}"><i class="fa-solid fa-stamp" style="color:var(--gold-light);"></i> {{ app()->getLocale() == 'ar' ? 'التحقق من وثيقة' : 'Verify Doc' }}</a></li>
            </ul>

            <!-- Actions (Theme, Lang, Portal, Hamburger) -->
            <div class="nav-actions">
                <!-- Theme Toggle -->
                <button class="btn-icon-switch" onclick="toggleTheme()" title="{{ app()->getLocale() == 'ar' ? 'تبديل المظهر' : 'Toggle Theme' }}" aria-label="Toggle Theme">
                    <i class="fa-solid fa-moon theme-icon-moon"></i>
                </button>

                <!-- Language Switcher -->
                @if(app()->getLocale() == 'ar')
                    <a href="{{ route('lang.switch', 'en') }}" class="lang-switch-btn" title="Switch to English">
                        <i class="fa-solid fa-globe"></i> <span>EN</span>
                    </a>
                @else
                    <a href="{{ route('lang.switch', 'ar') }}" class="lang-switch-btn" title="التحويل إلى العربية">
                        <i class="fa-solid fa-globe"></i> <span>عربي</span>
                    </a>
                @endif

                <!-- Staff Portal (Desktop) -->
                <div class="desktop-only">
                    @auth
                        <a href="{{ route('dashboard') }}" class="btn-gold" style="padding: 0.5rem 1rem; font-size: 0.85rem;">
                            <i class="fa-solid fa-gauge-high"></i>
                            <span>{{ app()->getLocale() == 'ar' ? 'لوحة التحكم' : 'Dashboard' }}</span>
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn-outline" style="padding: 0.5rem 0.9rem; font-size: 0.85rem;">
                            <i class="fa-solid fa-lock"></i>
                            <span>{{ app()->getLocale() == 'ar' ? 'دخول الموظفين' : 'Portal' }}</span>
                        </a>
                    @endauth
                </div>

                <!-- Mobile Menu Button -->
                <button class="btn-icon-switch mobile-menu-btn" onclick="toggleMobileMenu()" aria-label="Open Navigation Menu">
                    <i class="fa-solid fa-bars mobile-menu-icon"></i>
                </button>
            </div>
        </div>

        <!-- Mobile Navigation Drawer -->
        <div id="mobile-nav-drawer" class="mobile-nav-drawer">
            <ul class="mobile-nav-links">
                <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}"><i class="fa-solid fa-house"></i> {{ app()->getLocale() == 'ar' ? 'الرئيسية' : 'Home' }}</a></li>
                <li><a href="{{ route('services') }}" class="{{ request()->routeIs('services') ? 'active' : '' }}"><i class="fa-solid fa-compass-drafting"></i> {{ app()->getLocale() == 'ar' ? 'خدماتنا الهندسية' : 'Services' }}</a></li>
                <li><a href="{{ route('projects') }}" class="{{ request()->routeIs('projects') ? 'active' : '' }}"><i class="fa-solid fa-city"></i> {{ app()->getLocale() == 'ar' ? 'مشاريعنا' : 'Projects' }}</a></li>
                <li><a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}"><i class="fa-solid fa-building-user"></i> {{ app()->getLocale() == 'ar' ? 'من نحن' : 'About Us' }}</a></li>
                <li><a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}"><i class="fa-solid fa-envelope"></i> {{ app()->getLocale() == 'ar' ? 'اتصل بنا' : 'Contact' }}</a></li>
                <li><a href="{{ route('verify.document') }}" class="{{ request()->routeIs('verify.document') ? 'active' : '' }}"><i class="fa-solid fa-stamp text-gold"></i> {{ app()->getLocale() == 'ar' ? 'التحقق من وثيقة' : 'Verify Document' }}</a></li>
                <li style="margin-top: 1rem; padding-top: 1rem; border-top: 1px solid var(--border-subtle);">
                    @auth
                        <a href="{{ route('dashboard') }}" class="btn-gold" style="width: 100%; justify-content: center;">
                            <i class="fa-solid fa-gauge-high"></i> {{ app()->getLocale() == 'ar' ? 'لوحة التحكم' : 'Admin Dashboard' }}
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn-outline" style="width: 100%; justify-content: center;">
                            <i class="fa-solid fa-lock"></i> {{ app()->getLocale() == 'ar' ? 'دخول الموظفين' : 'Staff Portal' }}
                        </a>
                    @endauth
                </li>
            </ul>
        </div>
    </header>

    <!-- Main Content Area -->
    <main style="width: 100%; overflow-x: hidden;">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="site-footer">
        <div class="container">
            <div class="footer-grid">
                <!-- Col 1: Brand Info -->
                <div>
                    <div style="display:flex; align-items:center; gap:0.75rem; margin-bottom:1rem;">
                        <img src="{{ asset('images/logo-dark.png') }}" alt="ANMAT" class="logo-for-dark" style="height:44px; width:auto;">
                        <img src="{{ asset('images/logo-light.jpg') }}" alt="ANMAT" class="logo-for-light" style="height:44px; width:auto; border-radius:6px;">
                        <div>
                            <h4 style="font-size:1.15rem; font-weight:800; color:var(--text-primary); line-height:1.2;">{{ app()->getLocale() == 'ar' ? 'أنماط الهندسية' : 'ANMAT Engineering' }}</h4>
                            <span style="font-size:0.72rem; color:var(--gold-light);">{{ app()->getLocale() == 'ar' ? 'للأعمال والاستشارات الهندسية' : 'Works & Consultancy' }}</span>
                        </div>
                    </div>
                    <p class="footer-brand-p">
                        {{ \App\Models\Setting::getLocalized('company_tagline', null, 'رؤية هندسية دقيقة تبني المستقبل وتجسد الإتقان والمصداقية في كل مشروع.') }}
                    </p>
                    <div style="display:flex; gap:0.75rem; margin-top:1rem;">
                        @if($fb = \App\Models\Setting::get('facebook'))
                            <a href="{{ $fb }}" target="_blank" class="btn-icon-switch" style="width:36px; height:36px;" title="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
                        @endif
                        @if($li = \App\Models\Setting::get('linkedin'))
                            <a href="{{ $li }}" target="_blank" class="btn-icon-switch" style="width:36px; height:36px;" title="LinkedIn"><i class="fa-brands fa-linkedin-in"></i></a>
                        @endif
                        @if($wa = \App\Models\Setting::get('whatsapp'))
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $wa) }}" target="_blank" class="btn-icon-switch" style="width:36px; height:36px; color:#25D366;" title="WhatsApp"><i class="fa-brands fa-whatsapp"></i></a>
                        @endif
                    </div>
                </div>

                <!-- Col 2: Quick Links -->
                <div>
                    <h5 class="footer-title">{{ app()->getLocale() == 'ar' ? 'روابط سريعة' : 'Quick Links' }}</h5>
                    <ul class="footer-links">
                        <li><a href="{{ route('home') }}"><i class="fa-solid fa-chevron-left" style="font-size:0.7rem; margin-inline-end:6px; color:var(--gold-light);"></i>{{ app()->getLocale() == 'ar' ? 'الرئيسية' : 'Home' }}</a></li>
                        <li><a href="{{ route('services') }}"><i class="fa-solid fa-chevron-left" style="font-size:0.7rem; margin-inline-end:6px; color:var(--gold-light);"></i>{{ app()->getLocale() == 'ar' ? 'خدماتنا الهندسية' : 'Engineering Services' }}</a></li>
                        <li><a href="{{ route('projects') }}"><i class="fa-solid fa-chevron-left" style="font-size:0.7rem; margin-inline-end:6px; color:var(--gold-light);"></i>{{ app()->getLocale() == 'ar' ? 'سجل المشاريع' : 'Project Portfolio' }}</a></li>
                        <li><a href="{{ route('about') }}"><i class="fa-solid fa-chevron-left" style="font-size:0.7rem; margin-inline-end:6px; color:var(--gold-light);"></i>{{ app()->getLocale() == 'ar' ? 'نبذة عن أنماط' : 'About ANMAT' }}</a></li>
                        <li><a href="{{ route('verify.document') }}"><i class="fa-solid fa-chevron-left" style="font-size:0.7rem; margin-inline-end:6px; color:var(--gold-light);"></i>{{ app()->getLocale() == 'ar' ? 'التحقق من الوثائق الرسمية' : 'Document Verification' }}</a></li>
                    </ul>
                </div>

                <!-- Col 3: Services -->
                <div>
                    <h5 class="footer-title">{{ app()->getLocale() == 'ar' ? 'مجالات التخصص' : 'Core Disciplines' }}</h5>
                    <ul class="footer-links">
                        <li><a href="{{ route('services') }}">{{ app()->getLocale() == 'ar' ? 'المسح الطبوغرافي والجيوديسيا' : 'Topographic Surveying' }}</a></li>
                        <li><a href="{{ route('services') }}">{{ app()->getLocale() == 'ar' ? 'التصميم الإنشائي ودراسة الأحمال' : 'Structural Design & Analysis' }}</a></li>
                        <li><a href="{{ route('services') }}">{{ app()->getLocale() == 'ar' ? 'التصميم المعماري والمخططات' : 'Architectural Design' }}</a></li>
                        <li><a href="{{ route('services') }}">{{ app()->getLocale() == 'ar' ? 'الإشراف الهندسي الميداني' : 'Site Project Supervision' }}</a></li>
                        <li><a href="{{ route('services') }}">{{ app()->getLocale() == 'ar' ? 'حصر الكميات والمستخلصات BOQ' : 'Quantity Take-Off (BOQ)' }}</a></li>
                    </ul>
                </div>

                <!-- Col 4: Contact Info -->
                <div>
                    <h5 class="footer-title">{{ app()->getLocale() == 'ar' ? 'معلومات التواصل' : 'Contact ANMAT' }}</h5>
                    <ul class="footer-links" style="line-height:2;">
                        <li><i class="fa-solid fa-location-dot" style="color:var(--gold-light); margin-inline-end:8px;"></i>{{ \App\Models\Setting::getLocalized('address', null, 'طرابلس، ليبيا') }}</li>
                        <li><i class="fa-solid fa-phone" style="color:var(--gold-light); margin-inline-end:8px;"></i><span dir="ltr">{{ \App\Models\Setting::get('phone', '+218 91 000 0000') }}</span></li>
                        <li><i class="fa-solid fa-envelope" style="color:var(--gold-light); margin-inline-end:8px;"></i>{{ \App\Models\Setting::get('email', 'info@anmat.ly') }}</li>
                        <li><i class="fa-solid fa-clock" style="color:var(--gold-light); margin-inline-end:8px;"></i>{{ \App\Models\Setting::getLocalized('working_hours', null, 'الأحد - الخميس: 8:30 ص - 4:30 م') }}</li>
                    </ul>
                </div>
            </div>

            <!-- Footer Bottom -->
            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} {{ app()->getLocale() == 'ar' ? 'أنماط للأعمال والاستشارات الهندسية. جميع الحقوق محفوظة.' : 'ANMAT Engineering Works & Consultancy. All rights reserved.' }}</p>
                <div style="display:flex; gap:1.5rem;">
                    <a href="{{ route('verify.document') }}" style="color:var(--gold-light);"><i class="fa-solid fa-shield-halved"></i> {{ app()->getLocale() == 'ar' ? 'نظام الأرشفة والتحقق الرقمي' : 'Digital Verification Registry' }}</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Theme Toggle & Mobile Menu Scripts -->
    <script>
        function toggleTheme() {
            const current = document.documentElement.getAttribute('data-theme');
            const target = current === 'dark' ? 'light' : 'dark';
            document.documentElement.setAttribute('data-theme', target);
            localStorage.setItem('theme', target);
            updateThemeIcons(target);
        }

        function updateThemeIcons(theme) {
            const icon = document.querySelector('.theme-icon-moon');
            if (icon) {
                icon.className = theme === 'dark' ? 'fa-solid fa-moon theme-icon-moon' : 'fa-solid fa-sun theme-icon-moon';
            }
        }

        function toggleMobileMenu() {
            const drawer = document.getElementById('mobile-nav-drawer');
            const icon = document.querySelector('.mobile-menu-icon');
            if (drawer) {
                drawer.classList.toggle('open');
                if (icon) {
                    icon.className = drawer.classList.contains('open') ? 'fa-solid fa-xmark mobile-menu-icon' : 'fa-solid fa-bars mobile-menu-icon';
                }
            }
        }

        // Initialize icon state
        document.addEventListener('DOMContentLoaded', function() {
            const current = document.documentElement.getAttribute('data-theme') || 'dark';
            updateThemeIcons(current);
        });
    </script>
</body>
</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}" class="overflow-x-hidden max-w-full">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, viewport-fit=cover">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ isset($title) ? $title . ' | ' : '' }}{{ app()->getLocale() == 'ar' ? 'أنماط للأعمال والاستشارات الهندسية - بوابة الإدارة' : 'ANMAT Engineering - Admin Portal' }}</title>
        <link rel="icon" type="image/jpeg" href="{{ asset('images/logo-light.jpg') }}">

        <!-- Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800&family=Tajawal:wght@400;500;700;800&display=swap" rel="stylesheet" />

        <!-- FontAwesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

        <!-- Tailwind CSS CDN (Ensures 100% reliable rendering without relying on build status) -->
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                darkMode: 'class',
                theme: {
                    extend: {
                        colors: {
                            gold: {
                                400: '#E2B165',
                                500: '#C6923E',
                                600: '#9F722B',
                            },
                        },
                        fontFamily: {
                            sans: {{ app()->getLocale() == 'ar' ? "['Tajawal', 'sans-serif']" : "['Outfit', 'sans-serif']" }},
                        }
                    }
                }
            }
        </script>

        <!-- Compiled Vite Assets (if available) -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Flatpickr CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        
        <style>
            html, body {
                overflow-x: hidden !important;
                max-width: 100vw;
                width: 100%;
            }
            body { 
                font-family: {{ app()->getLocale() == 'ar' ? "'Tajawal', sans-serif" : "'Outfit', sans-serif" }}; 
            }
            [dir="rtl"] { text-align: right; }
            [dir="ltr"] { text-align: left; }

            /* Universal Custom Dropdown Styling with Locale-Aware Chevron Arrow */
            select {
                appearance: none !important;
                -webkit-appearance: none !important;
                -moz-appearance: none !important;
                background-repeat: no-repeat !important;
                cursor: pointer;
            }

            /* LTR Layout: Arrow strictly on the RIGHT */
            [dir="ltr"] select,
            html[dir="ltr"] select {
                background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%2364748b' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M6 8l4 4 4-4'/%3e%3c/svg%3e") !important;
                background-position: right 0.75rem center !important;
                background-size: 1.1em 1.1em !important;
                padding-right: 2.25rem !important;
                padding-left: 0.875rem !important;
            }

            /* RTL Layout: Arrow strictly on the LEFT */
            [dir="rtl"] select,
            html[dir="rtl"] select {
                background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%2364748b' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M6 8l4 4 4-4'/%3e%3c/svg%3e") !important;
                background-position: left 0.75rem center !important;
                background-size: 1.1em 1.1em !important;
                padding-left: 2.25rem !important;
                padding-right: 0.875rem !important;
            }

            /* Dark Mode Chevrons */
            html.dark[dir="ltr"] select,
            .dark [dir="ltr"] select {
                background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%23cbd5e1' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M6 8l4 4 4-4'/%3e%3c/svg%3e") !important;
            }

            html.dark[dir="rtl"] select,
            .dark [dir="rtl"] select {
                background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%23cbd5e1' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M6 8l4 4 4-4'/%3e%3c/svg%3e") !important;
            }

            /* Flatpickr Styling Adaptations */
            .flatpickr-calendar {
                font-family: inherit !important;
                border-radius: 0.75rem !important;
                box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.2), 0 8px 10px -6px rgba(0, 0, 0, 0.1) !important;
            }
            .dark .flatpickr-calendar {
                background: #0f172a !important;
                border: 1px solid #334155 !important;
                color: #f8fafc !important;
            }
            .dark .flatpickr-day {
                color: #e2e8f0 !important;
            }
            .dark .flatpickr-day.today {
                border-color: #f59e0b !important;
            }
            .dark .flatpickr-day.selected {
                background: #d97706 !important;
                border-color: #d97706 !important;
                color: #fff !important;
            }
            .dark .flatpickr-current-month,
            .dark .flatpickr-months .flatpickr-month {
                color: #f8fafc !important;
                fill: #f8fafc !important;
            }
            .dark span.flatpickr-weekday {
                color: #94a3b8 !important;
            }

            /* Calendar Icon & Styling inside Date Inputs */
            .flatpickr-date,
            .flatpickr-alt-input {
                cursor: pointer !important;
                background-repeat: no-repeat !important;
                background-size: 1.25em 1.25em !important;
                background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%2394a3b8'%3e%3cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z'/%3e%3c/svg%3e") !important;
            }

            [dir="ltr"] .flatpickr-date,
            [dir="ltr"] .flatpickr-alt-input {
                background-position: right 0.75rem center !important;
                padding-right: 2.25rem !important;
            }

            [dir="rtl"] .flatpickr-date,
            [dir="rtl"] .flatpickr-alt-input {
                background-position: left 0.75rem center !important;
                padding-left: 2.25rem !important;
            }

            /* Dark mode calendar icon color */
            html.dark .flatpickr-date,
            html.dark .flatpickr-alt-input,
            .dark .flatpickr-date,
            .dark .flatpickr-alt-input {
                background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%23cbd5e1'%3e%3cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z'/%3e%3c/svg%3e") !important;
            }
        </style>
        
        <script>
            if (localStorage.getItem('color-theme') === 'dark') {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        </script>
    </head>
    <body class="font-sans antialiased bg-slate-50 text-slate-800 dark:bg-slate-950 dark:text-slate-100 min-h-screen flex flex-col transition-colors duration-200 overflow-x-hidden w-full max-w-full">
        <div class="min-h-screen bg-slate-50 dark:bg-slate-950 flex-grow transition-colors duration-200 overflow-x-hidden w-full max-w-full">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white dark:bg-slate-900 border-b border-slate-200 dark:border-slate-800 shadow-sm transition-colors duration-200 overflow-x-hidden w-full">
                    <div class="max-w-7xl mx-auto py-4 sm:py-5 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="overflow-x-hidden w-full max-w-full">
                {{ $slot }}
            </main>
        </div>
        
        <!-- Flatpickr JS -->
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        @if(app()->getLocale() == 'ar')
        <script src="https://npmcdn.com/flatpickr/dist/l10n/ar.js"></script>
        @endif
        <script>
            // Initialize Flatpickr globally everywhere in the app
            document.addEventListener('DOMContentLoaded', function() {
                // Convert any native HTML date inputs to text to enforce dd/mm/yyyy popup across all browsers
                document.querySelectorAll('input[type="date"]').forEach(function(input) {
                    input.type = 'text';
                    input.classList.add('flatpickr-date');
                });

                document.querySelectorAll('.flatpickr-date, input[name*="date"]').forEach(function(input) {
                    flatpickr(input, {
                        dateFormat: "Y-m-d",
                        altInput: true,
                        altFormat: "d/m/Y",
                        allowInput: false,
                        disableMobile: true,
                        locale: "{{ app()->getLocale() == 'ar' ? 'ar' : 'default' }}",
                        altInputClass: (input.className ? input.className : '') + ' flatpickr-alt-input'
                    });
                });
            });
        </script>
    </body>
</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'ANMAT Portal') }} - {{ __('Log in') }}</title>

        <!-- Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800&family=Tajawal:wght@400;500;700;800&display=swap" rel="stylesheet" />

        <!-- Tailwind CSS CDN -->
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
                        }
                    }
                }
            }
        </script>
        <style>
            body {
                font-family: 'Tajawal', 'Outfit', sans-serif;
            }
        </style>
    </head>
    <body class="font-sans text-slate-100 antialiased bg-slate-950 min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 p-4">
        <div class="mb-6 text-center">
            <a href="/" class="inline-block transition hover:scale-105">
                <img src="/images/logo-dark.png" alt="ANMAT" class="h-16 w-auto mx-auto drop-shadow-lg" />
            </a>
            <h2 class="text-xl font-bold text-white mt-3 tracking-wide">بوابة الإدارة | ANMAT Admin</h2>
            <p class="text-xs text-slate-400 mt-1">أنماط للأعمال والاستشارات الهندسية</p>
        </div>

        <div class="w-full sm:max-w-md px-8 py-8 bg-slate-900 border border-slate-800 shadow-2xl rounded-2xl">
            {{ $slot }}
        </div>

        <div class="mt-8 text-center text-xs text-slate-500">
            &copy; {{ date('Y') }} ANMAT Engineering. All rights reserved.
        </div>
    </body>
</html>

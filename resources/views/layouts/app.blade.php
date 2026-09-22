<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'ANMAT Portal') }}</title>

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
                            sans: ['Tajawal', 'Outfit', 'sans-serif'],
                        }
                    }
                }
            }
        </script>

        <!-- Compiled Vite Assets (if available) -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body { font-family: 'Tajawal', 'Outfit', sans-serif; }
            [dir="rtl"] { text-align: right; }
            [dir="ltr"] { text-align: left; }
        </style>
    </head>
    <body class="font-sans antialiased bg-slate-950 text-slate-100 min-h-screen flex flex-col">
        <div class="min-h-screen bg-slate-950 flex-grow">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-slate-900 border-b border-slate-800 shadow-sm">
                    <div class="max-w-7xl mx-auto py-5 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>

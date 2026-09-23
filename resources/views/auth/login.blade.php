<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-semibold text-slate-300 mb-1">
                {{ app()->getLocale() == 'ar' ? 'البريد الإلكتروني' : 'Email Address' }}
            </label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                   class="w-full px-4 py-3 bg-slate-950 border border-slate-700 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-500 transition text-sm">
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-rose-400 text-xs" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-semibold text-slate-300 mb-1">
                {{ app()->getLocale() == 'ar' ? 'كلمة المرور' : 'Password' }}
            </label>
            <input id="password" type="password" name="password" required autocomplete="current-password"
                   class="w-full px-4 py-3 bg-slate-950 border border-slate-700 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-500 transition text-sm">
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-rose-400 text-xs" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between text-xs text-slate-400">
            <label for="remember_me" class="inline-flex items-center cursor-pointer select-none">
                <input id="remember_me" type="checkbox" class="rounded bg-slate-950 border-slate-700 text-amber-500 shadow-sm focus:ring-amber-500 focus:ring-offset-slate-900" name="remember">
                <span class="ms-2">{{ app()->getLocale() == 'ar' ? 'تذكر تسجيل دخولي' : 'Remember me' }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-amber-400 hover:text-amber-300 transition" href="{{ route('password.request') }}">
                    {{ app()->getLocale() == 'ar' ? 'نسيت كلمة المرور؟' : 'Forgot password?' }}
                </a>
            @endif
        </div>

        <div>
            <button type="submit" class="w-full py-3.5 px-4 bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-slate-950 font-bold rounded-xl shadow-lg shadow-amber-500/20 transition-all hover:scale-[1.01] active:scale-[0.99] text-sm flex items-center justify-center gap-2">
                <i class="fa-solid fa-arrow-right-to-bracket"></i>
                {{ app()->getLocale() == 'ar' ? 'تسجيل الدخول إلى البوابة' : 'Log in to Portal' }}
            </button>
        </div>
    </form>
</x-guest-layout>

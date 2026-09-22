<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-extrabold text-2xl text-white tracking-tight flex items-center gap-3">
                    <span class="p-2 rounded-lg bg-amber-500/20 text-amber-400">
                        <i class="fa-solid fa-sliders"></i>
                    </span>
                    {{ __('Website & Company Profile Settings') }} (إعدادات الموقع وهوية الشركة)
                </h2>
                <p class="text-sm text-slate-400 mt-1">
                    {{ __('Customize company contacts, hero text, about us story, and homepage statistics live.') }}
                </p>
            </div>
            <a href="{{ route('home') }}" target="_blank" class="px-3.5 py-1.5 rounded-lg bg-slate-800 text-amber-400 hover:text-white text-xs font-bold border border-slate-700 flex items-center gap-1.5">
                <i class="fa-solid fa-arrow-up-right-from-square"></i>
                <span>{{ __('Preview Live Site') }}</span>
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if(session('status'))
                <div class="p-4 rounded-lg bg-emerald-500/15 border border-emerald-500/30 text-emerald-400 flex items-center gap-3">
                    <i class="fa-solid fa-circle-check text-lg"></i>
                    <span>{{ session('status') }}</span>
                </div>
            @endif

            <form action="{{ route('admin.settings.update') }}" method="POST" class="space-y-8">
                @csrf

                <!-- Section 1: Hero & Header Branding -->
                <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6 sm:p-8 shadow-sm space-y-6">
                    <h3 class="text-lg font-black text-white flex items-center gap-2.5 pb-3 border-b border-slate-800">
                        <i class="fa-solid fa-heading text-amber-400"></i>
                        <span>{{ __('1. Hero Section & Main Slogan (الواجهة الرئيسية والشعار)') }}</span>
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-bold text-slate-300 mb-1.5">
                                {{ __('Hero Badge (Arabic) وسام التميز بالعربية') }}
                            </label>
                            <input type="text" name="hero_badge[ar]" value="{{ \App\Models\Setting::getLocalized('hero_badge', 'ar') }}" class="w-full bg-slate-950 border border-slate-700 rounded-lg px-3.5 py-2.5 text-white text-sm focus:border-amber-400 outline-none">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-300 mb-1.5">
                                {{ __('Hero Badge (English) وسام التميز بالإنجليزية') }}
                            </label>
                            <input type="text" name="hero_badge[en]" value="{{ \App\Models\Setting::getLocalized('hero_badge', 'en') }}" class="w-full bg-slate-950 border border-slate-700 rounded-lg px-3.5 py-2.5 text-white text-sm focus:border-amber-400 outline-none">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-bold text-slate-300 mb-1.5">
                                {{ __('Hero Title (Arabic) * العنوان الرئيسي بالعربية') }}
                            </label>
                            <textarea name="hero_title[ar]" rows="2" required class="w-full bg-slate-950 border border-slate-700 rounded-lg px-3.5 py-2 text-white text-sm focus:border-amber-400 outline-none">{{ \App\Models\Setting::getLocalized('hero_title', 'ar') }}</textarea>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-300 mb-1.5">
                                {{ __('Hero Title (English) العنوان الرئيسي بالإنجليزية') }}
                            </label>
                            <textarea name="hero_title[en]" rows="2" class="w-full bg-slate-950 border border-slate-700 rounded-lg px-3.5 py-2 text-white text-sm focus:border-amber-400 outline-none">{{ \App\Models\Setting::getLocalized('hero_title', 'en') }}</textarea>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-bold text-slate-300 mb-1.5">
                                {{ __('Hero Subtitle (Arabic) الوصف التوضيحي بالعربية') }}
                            </label>
                            <textarea name="hero_subtitle[ar]" rows="3" class="w-full bg-slate-950 border border-slate-700 rounded-lg px-3.5 py-2 text-white text-sm focus:border-amber-400 outline-none">{{ \App\Models\Setting::getLocalized('hero_subtitle', 'ar') }}</textarea>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-300 mb-1.5">
                                {{ __('Hero Subtitle (English) الوصف التوضيحي بالإنجليزية') }}
                            </label>
                            <textarea name="hero_subtitle[en]" rows="3" class="w-full bg-slate-950 border border-slate-700 rounded-lg px-3.5 py-2 text-white text-sm focus:border-amber-400 outline-none">{{ \App\Models\Setting::getLocalized('hero_subtitle', 'en') }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Section 2: Key Statistics -->
                <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6 sm:p-8 shadow-sm space-y-6">
                    <h3 class="text-lg font-black text-white flex items-center gap-2.5 pb-3 border-b border-slate-800">
                        <i class="fa-solid fa-chart-simple text-amber-400"></i>
                        <span>{{ __('2. Numerical Key Metrics (الأرقام والإحصائيات الرئيسية)') }}</span>
                    </h3>

                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                        <div>
                            <label class="block text-xs font-bold text-slate-300 mb-1.5">
                                {{ __('Years of Experience (سنوات الخبرة)') }}
                            </label>
                            <input type="text" name="stat_years" value="{{ \App\Models\Setting::get('stat_years', '15+') }}" class="w-full bg-slate-950 border border-slate-700 rounded-lg px-3.5 py-2.5 text-amber-400 font-bold text-sm focus:border-amber-400 outline-none">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-300 mb-1.5">
                                {{ __('Completed Projects (المشاريع المنجزة)') }}
                            </label>
                            <input type="text" name="stat_projects" value="{{ \App\Models\Setting::get('stat_projects', '120+') }}" class="w-full bg-slate-950 border border-slate-700 rounded-lg px-3.5 py-2.5 text-amber-400 font-bold text-sm focus:border-amber-400 outline-none">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-300 mb-1.5">
                                {{ __('Surveying Missions (أعمال الرفع المساحي)') }}
                            </label>
                            <input type="text" name="stat_surveys" value="{{ \App\Models\Setting::get('stat_surveys', '450+') }}" class="w-full bg-slate-950 border border-slate-700 rounded-lg px-3.5 py-2.5 text-amber-400 font-bold text-sm focus:border-amber-400 outline-none">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-300 mb-1.5">
                                {{ __('Specialized Engineers (طاقم الاستشاريين)') }}
                            </label>
                            <input type="text" name="stat_engineers" value="{{ \App\Models\Setting::get('stat_engineers', '25+') }}" class="w-full bg-slate-950 border border-slate-700 rounded-lg px-3.5 py-2.5 text-amber-400 font-bold text-sm focus:border-amber-400 outline-none">
                        </div>
                    </div>
                </div>

                <!-- Section 3: Contact & Working Hours -->
                <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6 sm:p-8 shadow-sm space-y-6">
                    <h3 class="text-lg font-black text-white flex items-center gap-2.5 pb-3 border-b border-slate-800">
                        <i class="fa-solid fa-address-book text-amber-400"></i>
                        <span>{{ __('3. Contact Channels & Office Details (قنوات الاتصال والمقر)') }}</span>
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-xs font-bold text-slate-300 mb-1.5">
                                {{ __('Primary Phone (الهاتف المباشر)') }}
                            </label>
                            <input type="text" name="phone" value="{{ \App\Models\Setting::get('phone', '+218 91 000 0000') }}" dir="ltr" class="w-full bg-slate-950 border border-slate-700 rounded-lg px-3.5 py-2.5 text-white text-sm focus:border-amber-400 outline-none">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-300 mb-1.5">
                                {{ __('Secondary Phone (هاتف ثانوي / أرضي)') }}
                            </label>
                            <input type="text" name="phone_secondary" value="{{ \App\Models\Setting::get('phone_secondary') }}" dir="ltr" class="w-full bg-slate-950 border border-slate-700 rounded-lg px-3.5 py-2.5 text-white text-sm focus:border-amber-400 outline-none">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-300 mb-1.5">
                                {{ __('WhatsApp Number (رقم الواتساب مع المفتاح)') }}
                            </label>
                            <input type="text" name="whatsapp" value="{{ \App\Models\Setting::get('whatsapp', '+218910000000') }}" dir="ltr" class="w-full bg-slate-950 border border-slate-700 rounded-lg px-3.5 py-2.5 text-emerald-400 font-bold text-sm focus:border-amber-400 outline-none">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-bold text-slate-300 mb-1.5">
                                {{ __('Official Email (البريد الإلكتروني الرسمي)') }}
                            </label>
                            <input type="email" name="email" value="{{ \App\Models\Setting::get('email', 'info@anmat.ly') }}" class="w-full bg-slate-950 border border-slate-700 rounded-lg px-3.5 py-2.5 text-white text-sm focus:border-amber-400 outline-none">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-300 mb-1.5">
                                {{ __('Support Email (بريد الاستشارات الفنية)') }}
                            </label>
                            <input type="email" name="email_support" value="{{ \App\Models\Setting::get('email_support', 'support@anmat.ly') }}" class="w-full bg-slate-950 border border-slate-700 rounded-lg px-3.5 py-2.5 text-white text-sm focus:border-amber-400 outline-none">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-bold text-slate-300 mb-1.5">
                                {{ __('Office Address (Arabic) المقر بالعربية') }}
                            </label>
                            <input type="text" name="address[ar]" value="{{ \App\Models\Setting::getLocalized('address', 'ar') }}" class="w-full bg-slate-950 border border-slate-700 rounded-lg px-3.5 py-2.5 text-white text-sm focus:border-amber-400 outline-none">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-300 mb-1.5">
                                {{ __('Office Address (English) المقر بالإنجليزية') }}
                            </label>
                            <input type="text" name="address[en]" value="{{ \App\Models\Setting::getLocalized('address', 'en') }}" class="w-full bg-slate-950 border border-slate-700 rounded-lg px-3.5 py-2.5 text-white text-sm focus:border-amber-400 outline-none">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-bold text-slate-300 mb-1.5">
                                {{ __('Working Hours (Arabic) ساعات الدوام بالعربية') }}
                            </label>
                            <input type="text" name="working_hours[ar]" value="{{ \App\Models\Setting::getLocalized('working_hours', 'ar') }}" class="w-full bg-slate-950 border border-slate-700 rounded-lg px-3.5 py-2.5 text-white text-sm focus:border-amber-400 outline-none">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-300 mb-1.5">
                                {{ __('Working Hours (English) ساعات الدوام بالإنجليزية') }}
                            </label>
                            <input type="text" name="working_hours[en]" value="{{ \App\Models\Setting::getLocalized('working_hours', 'en') }}" class="w-full bg-slate-950 border border-slate-700 rounded-lg px-3.5 py-2.5 text-white text-sm focus:border-amber-400 outline-none">
                        </div>
                    </div>
                </div>

                <!-- Section 4: Social Media Links -->
                <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6 sm:p-8 shadow-sm space-y-6">
                    <h3 class="text-lg font-black text-white flex items-center gap-2.5 pb-3 border-b border-slate-800">
                        <i class="fa-solid fa-share-nodes text-amber-400"></i>
                        <span>{{ __('4. Social Media Presence (منصات التواصل الاجتماعي)') }}</span>
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-xs font-bold text-slate-300 mb-1.5">Facebook URL</label>
                            <input type="text" name="facebook" value="{{ \App\Models\Setting::get('facebook') }}" placeholder="https://facebook.com/..." class="w-full bg-slate-950 border border-slate-700 rounded-lg px-3.5 py-2.5 text-white text-sm focus:border-amber-400 outline-none">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-300 mb-1.5">LinkedIn URL</label>
                            <input type="text" name="linkedin" value="{{ \App\Models\Setting::get('linkedin') }}" placeholder="https://linkedin.com/company/..." class="w-full bg-slate-950 border border-slate-700 rounded-lg px-3.5 py-2.5 text-white text-sm focus:border-amber-400 outline-none">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-300 mb-1.5">Twitter / X URL</label>
                            <input type="text" name="twitter" value="{{ \App\Models\Setting::get('twitter') }}" placeholder="https://twitter.com/..." class="w-full bg-slate-950 border border-slate-700 rounded-lg px-3.5 py-2.5 text-white text-sm focus:border-amber-400 outline-none">
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end">
                    <button type="submit" class="px-8 py-3 rounded-xl bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-slate-950 font-black text-base shadow-xl shadow-amber-500/25 transition">
                        <i class="fa-solid fa-check me-2"></i>
                        {{ __('Save All Website Settings') }}
                    </button>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>

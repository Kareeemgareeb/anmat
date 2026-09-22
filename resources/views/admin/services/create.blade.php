<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-extrabold text-2xl text-white tracking-tight flex items-center gap-3">
                <span class="p-2 rounded-lg bg-purple-500/20 text-purple-400">
                    <i class="fa-solid fa-plus"></i>
                </span>
                {{ __('Create Engineering Service') }} (إضافة خدمة هندسية جديدة)
            </h2>
            <a href="{{ route('admin.services.index') }}" class="px-3.5 py-1.5 rounded-lg bg-slate-800 text-slate-300 hover:text-white text-xs font-bold border border-slate-700">
                &larr; {{ __('Back to Services') }}
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6 sm:p-8 shadow-sm">
                
                @if ($errors->any())
                    <div class="mb-6 p-4 rounded-lg bg-red-500/15 border border-red-500/30 text-red-400 text-sm">
                        <ul class="list-disc list-inside space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.services.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <!-- Titles (AR / EN) -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-bold text-slate-300 mb-1.5">
                                {{ __('Service Title (Arabic) * عنوان الخدمة بالعربية') }}
                            </label>
                            <input type="text" name="title_ar" value="{{ old('title_ar') }}" required placeholder="مثال: الأعمال والمساحة الطبوغرافية" class="w-full bg-slate-950 border border-slate-700 rounded-lg px-3.5 py-2.5 text-white text-sm focus:border-purple-400 outline-none">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-300 mb-1.5">
                                {{ __('Service Title (English) عنوان الخدمة بالإنجليزية') }}
                            </label>
                            <input type="text" name="title_en" value="{{ old('title_en') }}" placeholder="e.g. Geodetic & Topographic Surveying" class="w-full bg-slate-950 border border-slate-700 rounded-lg px-3.5 py-2.5 text-white text-sm focus:border-purple-400 outline-none">
                        </div>
                    </div>

                    <!-- Category (AR / EN) -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-bold text-slate-300 mb-1.5">
                                {{ __('Category (Arabic) التصنيف بالعربية') }}
                            </label>
                            <input type="text" name="category_ar" value="{{ old('category_ar') }}" placeholder="مثال: المساحة والجيوديسيا" class="w-full bg-slate-950 border border-slate-700 rounded-lg px-3.5 py-2.5 text-white text-sm focus:border-purple-400 outline-none">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-300 mb-1.5">
                                {{ __('Category (English) التصنيف بالإنجليزية') }}
                            </label>
                            <input type="text" name="category_en" value="{{ old('category_en') }}" placeholder="e.g. Surveying & Geodesy" class="w-full bg-slate-950 border border-slate-700 rounded-lg px-3.5 py-2.5 text-white text-sm focus:border-purple-400 outline-none">
                        </div>
                    </div>

                    <!-- Icon & Display Settings -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 p-4 rounded-xl bg-slate-950/60 border border-slate-800">
                        <div>
                            <label class="block text-xs font-bold text-slate-300 mb-1.5">
                                {{ __('Service Icon رمز الخدمة') }}
                            </label>
                            <select name="icon" class="w-full bg-slate-900 border border-slate-700 rounded-lg px-3.5 py-2 text-white text-sm focus:border-purple-400 outline-none">
                                <option value="compass">Compass / Drafting (مساحة ورسم)</option>
                                <option value="building">Building / City (إنشائي وبرج)</option>
                                <option value="home">Architecture / Heritage (معماري)</option>
                                <option value="clipboard-check">Supervision (إشراف ميداني)</option>
                                <option value="calculator">BOQ / Quantity (حساب كميات)</option>
                                <option value="shield-check">Consultancy / Health (استشارات وجدوى)</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-300 mb-1.5">
                                {{ __('Display Order ترتيب الظهور') }}
                            </label>
                            <input type="number" name="order" value="{{ old('order', 0) }}" class="w-full bg-slate-900 border border-slate-700 rounded-lg px-3.5 py-2 text-white text-sm focus:border-purple-400 outline-none">
                        </div>

                        <div class="flex items-center pt-6">
                            <label class="inline-flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', 1) ? 'checked' : '' }} class="rounded border-slate-700 text-purple-600 focus:ring-purple-500 bg-slate-900">
                                <span class="text-xs font-bold text-slate-300">{{ __('Feature on Homepage (إبراز في الرئيسية)') }}</span>
                            </label>
                        </div>
                    </div>

                    <!-- Short Description -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-bold text-slate-300 mb-1.5">
                                {{ __('Short Excerpt (Arabic) نبذة موجزة للبطاقة') }}
                            </label>
                            <textarea name="short_description_ar" rows="2" placeholder="وصف مقتضب يظهر في البطاقة الرئيسية..." class="w-full bg-slate-950 border border-slate-700 rounded-lg px-3.5 py-2 text-white text-sm focus:border-purple-400 outline-none">{{ old('short_description_ar') }}</textarea>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-300 mb-1.5">
                                {{ __('Short Excerpt (English) نبذة موجزة إنجليزية') }}
                            </label>
                            <textarea name="short_description_en" rows="2" placeholder="Brief card summary..." class="w-full bg-slate-950 border border-slate-700 rounded-lg px-3.5 py-2 text-white text-sm focus:border-purple-400 outline-none">{{ old('short_description_en') }}</textarea>
                        </div>
                    </div>

                    <!-- Full Description -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-bold text-slate-300 mb-1.5">
                                {{ __('Full Description (Arabic) التفاصيل الكاملة بالعربية') }}
                            </label>
                            <textarea name="description_ar" rows="4" placeholder="الشرح الهندسي التفصيلي للخدمة..." class="w-full bg-slate-950 border border-slate-700 rounded-lg px-3.5 py-2.5 text-white text-sm focus:border-purple-400 outline-none">{{ old('description_ar') }}</textarea>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-300 mb-1.5">
                                {{ __('Full Description (English) التفاصيل الكاملة بالإنجليزية') }}
                            </label>
                            <textarea name="description_en" rows="4" placeholder="Detailed engineering service breakdown..." class="w-full bg-slate-950 border border-slate-700 rounded-lg px-3.5 py-2.5 text-white text-sm focus:border-purple-400 outline-none">{{ old('description_en') }}</textarea>
                        </div>
                    </div>

                    <!-- Features (1 per line) -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-bold text-slate-300 mb-1.5">
                                {{ __('Features (Arabic - One per line) نقاط ومميزات الخدمة') }}
                            </label>
                            <textarea name="features_ar" rows="4" placeholder="رفع مساحي طبوغرافي ورقمي&#10;تحديد الحدود وتثبيت النقاط&#10;حساب كميات الحفر والردم" class="w-full bg-slate-950 border border-slate-700 rounded-lg px-3.5 py-2 text-white text-sm focus:border-purple-400 outline-none">{{ old('features_ar') }}</textarea>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-300 mb-1.5">
                                {{ __('Features (English - One per line) نقاط الخدمة بالإنجليزية') }}
                            </label>
                            <textarea name="features_en" rows="4" placeholder="Digital topographic mapping&#10;Boundary & geodetic control&#10;Earthworks volumetric calculations" class="w-full bg-slate-950 border border-slate-700 rounded-lg px-3.5 py-2 text-white text-sm focus:border-purple-400 outline-none">{{ old('features_en') }}</textarea>
                        </div>
                    </div>

                    <!-- Submit -->
                    <div class="pt-4 border-t border-slate-800 flex justify-end gap-3">
                        <a href="{{ route('admin.services.index') }}" class="px-5 py-2.5 rounded-lg bg-slate-800 text-slate-300 hover:text-white text-sm font-semibold">
                            {{ __('Cancel') }}
                        </a>
                        <button type="submit" class="px-6 py-2.5 rounded-lg bg-gradient-to-r from-purple-500 to-purple-600 hover:from-purple-600 hover:to-purple-700 text-white font-bold text-sm shadow-lg shadow-purple-500/20">
                            <i class="fa-solid fa-save me-1.5"></i>
                            {{ __('Save Service') }}
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>

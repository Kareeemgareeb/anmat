<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <h2 class="font-extrabold text-xl sm:text-2xl text-slate-900 dark:text-white tracking-tight flex items-center gap-3">
                <span class="p-2 rounded-lg bg-purple-500/20 text-purple-500">
                    <i class="fa-solid fa-pen-to-square"></i>
                </span>
                <span>{{ __('Edit Engineering Service') }}: <span class="text-purple-600 dark:text-purple-400">{{ $service->title }}</span></span>
            </h2>
            <a href="{{ route('admin.services.index') }}" class="w-fit inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-lg bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white text-xs font-bold border border-slate-300 dark:border-slate-700 transition">
                <i class="fa-solid {{ app()->getLocale() == 'ar' ? 'fa-arrow-right' : 'fa-arrow-left' }}"></i>
                <span>{{ __('Back to Services') }}</span>
            </a>
        </div>
    </x-slot>

    <div class="py-6 sm:py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl p-5 sm:p-8 shadow-sm">
                
                @if ($errors->any())
                    <div class="mb-6 p-4 rounded-lg bg-red-500/15 border border-red-500/30 text-red-500 text-sm">
                        <ul class="list-disc list-inside space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.services.update', $service->id) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Titles (AR / EN) -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 sm:gap-6">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">
                                {{ __('Service Title (Arabic)') }} <span class="text-red-500 text-sm font-black">*</span>
                            </label>
                            <input type="text" name="title_ar" value="{{ old('title_ar', $service->getTranslation('title', 'ar', false)) }}" required class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-300 dark:border-slate-700 rounded-lg px-3.5 py-2.5 text-slate-900 dark:text-white text-sm focus:border-purple-500 outline-none">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">
                                {{ __('Service Title (English)') }}
                            </label>
                            <input type="text" name="title_en" value="{{ old('title_en', $service->getTranslation('title', 'en', false)) }}" class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-300 dark:border-slate-700 rounded-lg px-3.5 py-2.5 text-slate-900 dark:text-white text-sm focus:border-purple-500 outline-none">
                        </div>
                    </div>

                    <!-- Category (AR / EN) -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 sm:gap-6">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">
                                {{ __('Category (Arabic)') }}
                            </label>
                            <input type="text" name="category_ar" value="{{ old('category_ar', $service->getTranslation('category', 'ar', false)) }}" class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-300 dark:border-slate-700 rounded-lg px-3.5 py-2.5 text-slate-900 dark:text-white text-sm focus:border-purple-500 outline-none">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">
                                {{ __('Category (English)') }}
                            </label>
                            <input type="text" name="category_en" value="{{ old('category_en', $service->getTranslation('category', 'en', false)) }}" class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-300 dark:border-slate-700 rounded-lg px-3.5 py-2.5 text-slate-900 dark:text-white text-sm focus:border-purple-500 outline-none">
                        </div>
                    </div>

                    <!-- Icon & Display Settings -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5 sm:gap-6 p-4 rounded-xl bg-slate-50 dark:bg-slate-950/60 border border-slate-200 dark:border-slate-800">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">
                                {{ __('Service Icon') }}
                            </label>
                            <select name="icon" class="w-full bg-white dark:bg-slate-900 border border-slate-300 dark:border-slate-700 rounded-lg px-3.5 py-2 text-slate-900 dark:text-white text-sm focus:border-purple-500 outline-none">
                                <option value="compass" {{ $service->icon == 'compass' ? 'selected' : '' }}>{{ __('Compass / Drafting') }}</option>
                                <option value="building" {{ $service->icon == 'building' ? 'selected' : '' }}>{{ __('Building / City') }}</option>
                                <option value="home" {{ $service->icon == 'home' ? 'selected' : '' }}>{{ __('Architecture / Heritage') }}</option>
                                <option value="clipboard-check" {{ $service->icon == 'clipboard-check' ? 'selected' : '' }}>{{ __('Supervision') }}</option>
                                <option value="calculator" {{ $service->icon == 'calculator' ? 'selected' : '' }}>{{ __('BOQ / Quantity') }}</option>
                                <option value="shield-check" {{ $service->icon == 'shield-check' ? 'selected' : '' }}>{{ __('Consultancy / Health') }}</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">
                                {{ __('Display Order') }}
                            </label>
                            <input type="number" name="order" value="{{ old('order', $service->order) }}" class="w-full bg-white dark:bg-slate-900 border border-slate-300 dark:border-slate-700 rounded-lg px-3.5 py-2 text-slate-900 dark:text-white text-sm focus:border-purple-500 outline-none">
                        </div>

                        <div class="flex items-center pt-2 md:pt-6">
                            <label class="inline-flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $service->is_featured) ? 'checked' : '' }} class="rounded border-slate-300 dark:border-slate-700 text-purple-600 focus:ring-purple-500 bg-white dark:bg-slate-900">
                                <span class="text-xs font-bold text-slate-700 dark:text-slate-300">{{ __('Feature on Homepage') }}</span>
                            </label>
                        </div>
                    </div>

                    <!-- Short Description -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 sm:gap-6">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">
                                {{ __('Short Excerpt (Arabic)') }}
                            </label>
                            <textarea name="short_description_ar" rows="2" class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-300 dark:border-slate-700 rounded-lg px-3.5 py-2 text-slate-900 dark:text-white text-sm focus:border-purple-500 outline-none">{{ old('short_description_ar', $service->getTranslation('short_description', 'ar', false)) }}</textarea>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">
                                {{ __('Short Excerpt (English)') }}
                            </label>
                            <textarea name="short_description_en" rows="2" class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-300 dark:border-slate-700 rounded-lg px-3.5 py-2 text-slate-900 dark:text-white text-sm focus:border-purple-500 outline-none">{{ old('short_description_en', $service->getTranslation('short_description', 'en', false)) }}</textarea>
                        </div>
                    </div>

                    <!-- Full Description -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 sm:gap-6">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">
                                {{ __('Full Description (Arabic)') }}
                            </label>
                            <textarea name="description_ar" rows="4" class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-300 dark:border-slate-700 rounded-lg px-3.5 py-2.5 text-slate-900 dark:text-white text-sm focus:border-purple-500 outline-none">{{ old('description_ar', $service->getTranslation('description', 'ar', false)) }}</textarea>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">
                                {{ __('Full Description (English)') }}
                            </label>
                            <textarea name="description_en" rows="4" class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-300 dark:border-slate-700 rounded-lg px-3.5 py-2.5 text-slate-900 dark:text-white text-sm focus:border-purple-500 outline-none">{{ old('description_en', $service->getTranslation('description', 'en', false)) }}</textarea>
                        </div>
                    </div>

                    <!-- Features -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 sm:gap-6">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">
                                {{ __('Features (Arabic - One per line)') }}
                            </label>
                            <textarea name="features_ar" rows="4" class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-300 dark:border-slate-700 rounded-lg px-3.5 py-2 text-slate-900 dark:text-white text-sm focus:border-purple-500 outline-none">{{ old('features_ar', is_array($f = $service->getTranslation('features', 'ar', false)) ? implode("\n", $f) : $f) }}</textarea>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">
                                {{ __('Features (English - One per line)') }}
                            </label>
                            <textarea name="features_en" rows="4" class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-300 dark:border-slate-700 rounded-lg px-3.5 py-2 text-slate-900 dark:text-white text-sm focus:border-purple-500 outline-none">{{ old('features_en', is_array($f = $service->getTranslation('features', 'en', false)) ? implode("\n", $f) : $f) }}</textarea>
                        </div>
                    </div>

                    <!-- Submit -->
                    <div class="pt-4 border-t border-slate-200 dark:border-slate-800 flex flex-col-reverse sm:flex-row sm:justify-end gap-3">
                        <a href="{{ route('admin.services.index') }}" class="w-full sm:w-auto text-center px-5 py-2.5 rounded-lg bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white text-sm font-semibold border border-slate-300 dark:border-slate-700 transition">
                            {{ __('Cancel') }}
                        </a>
                        <button type="submit" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-2.5 rounded-lg bg-gradient-to-r from-purple-600 to-purple-700 hover:from-purple-700 hover:to-purple-800 text-white font-bold text-sm shadow-md shadow-purple-500/20 transition">
                            <i class="fa-solid fa-save"></i>
                            <span>{{ __('Update Service') }}</span>
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>

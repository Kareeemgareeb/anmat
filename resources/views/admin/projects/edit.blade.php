<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <h2 class="font-extrabold text-xl sm:text-2xl text-slate-900 dark:text-white tracking-tight flex items-center gap-3">
                <span class="p-2 rounded-lg bg-blue-500/20 text-blue-500">
                    <i class="fa-solid fa-pen-to-square"></i>
                </span>
                <span>{{ __('Edit Project') }}: <span class="text-blue-600 dark:text-blue-400">{{ $project->title }}</span></span>
            </h2>
            <a href="{{ route('admin.projects.index') }}" class="w-fit inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-lg bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white text-xs font-bold border border-slate-300 dark:border-slate-700 transition">
                <i class="fa-solid {{ app()->getLocale() == 'ar' ? 'fa-arrow-right' : 'fa-arrow-left' }}"></i>
                <span>{{ __('Back to Projects') }}</span>
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

                <form action="{{ route('admin.projects.update', $project->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Titles (AR / EN) -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 sm:gap-6">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">
                                {{ __('Project Title (Arabic)') }} <span class="text-red-500 text-sm font-black">*</span>
                            </label>
                            <input type="text" name="title_ar" value="{{ old('title_ar', $project->getTranslation('title', 'ar', false)) }}" required class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-300 dark:border-slate-700 rounded-lg px-3.5 py-2.5 text-slate-900 dark:text-white text-sm focus:border-blue-500 outline-none">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">
                                {{ __('Project Title (English)') }}
                            </label>
                            <input type="text" name="title_en" value="{{ old('title_en', $project->getTranslation('title', 'en', false)) }}" class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-300 dark:border-slate-700 rounded-lg px-3.5 py-2.5 text-slate-900 dark:text-white text-sm focus:border-blue-500 outline-none">
                        </div>
                    </div>

                    <!-- Category (AR / EN) -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 sm:gap-6">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">
                                {{ __('Category (Arabic)') }}
                            </label>
                            <input type="text" name="category_ar" value="{{ old('category_ar', $project->getTranslation('category', 'ar', false)) }}" class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-300 dark:border-slate-700 rounded-lg px-3.5 py-2.5 text-slate-900 dark:text-white text-sm focus:border-blue-500 outline-none">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">
                                {{ __('Category (English)') }}
                            </label>
                            <input type="text" name="category_en" value="{{ old('category_en', $project->getTranslation('category', 'en', false)) }}" class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-300 dark:border-slate-700 rounded-lg px-3.5 py-2.5 text-slate-900 dark:text-white text-sm focus:border-blue-500 outline-none">
                        </div>
                    </div>

                    <!-- Client & Location -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 sm:gap-6">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">
                                {{ __('Client / Owner') }}
                            </label>
                            <input type="text" name="client_ar" value="{{ old('client_ar', $project->getTranslation('client', 'ar', false)) }}" class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-300 dark:border-slate-700 rounded-lg px-3.5 py-2.5 text-slate-900 dark:text-white text-sm focus:border-blue-500 outline-none">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">
                                {{ __('Location') }}
                            </label>
                            <input type="text" name="location_ar" value="{{ old('location_ar', $project->getTranslation('location', 'ar', false)) }}" class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-300 dark:border-slate-700 rounded-lg px-3.5 py-2.5 text-slate-900 dark:text-white text-sm focus:border-blue-500 outline-none">
                        </div>
                    </div>

                    <!-- Area, Status, Completion Date -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5 sm:gap-6">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">
                                {{ __('Scope / Area') }}
                            </label>
                            <input type="text" name="area" value="{{ old('area', $project->area) }}" class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-300 dark:border-slate-700 rounded-lg px-3.5 py-2.5 text-slate-900 dark:text-white text-sm focus:border-blue-500 outline-none">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">
                                {{ __('Project Status') }}
                            </label>
                            <select name="status" class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-300 dark:border-slate-700 rounded-lg px-3.5 py-2.5 text-slate-900 dark:text-white text-sm focus:border-blue-500 outline-none">
                                <option value="completed" {{ old('status', $project->status) == 'completed' ? 'selected' : '' }}>{{ __('Completed') }}</option>
                                <option value="ongoing" {{ old('status', $project->status) == 'ongoing' ? 'selected' : '' }}>{{ __('Ongoing') }}</option>
                                <option value="planning" {{ old('status', $project->status) == 'planning' ? 'selected' : '' }}>{{ __('Planning') }}</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">
                                {{ __('Completion / Milestone Date') }}
                            </label>
                            <input type="text" name="completion_date" value="{{ old('completion_date', $project->completion_date ? $project->completion_date->format('Y-m-d') : '') }}" placeholder="dd/mm/yyyy" class="flatpickr-date w-full bg-slate-50 dark:bg-slate-950 border border-slate-300 dark:border-slate-700 rounded-lg px-3.5 py-2.5 text-slate-900 dark:text-white text-sm focus:border-blue-500 outline-none">
                        </div>
                    </div>

                    <!-- Main Image & Options -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5 sm:gap-6 p-4 rounded-xl bg-slate-50 dark:bg-slate-950/60 border border-slate-200 dark:border-slate-800">
                        <div class="md:col-span-2">
                            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">
                                {{ __('Project Main Image') }}
                            </label>
                            @if($project->image_path)
                                <div class="mb-2 flex items-center gap-3">
                                    <img src="{{ $project->image_url }}" class="w-16 h-12 object-cover rounded border border-slate-300 dark:border-slate-700">
                                    <span class="text-xs text-slate-500 dark:text-slate-400">{{ __('Current Image') }}</span>
                                </div>
                            @endif
                            <input type="file" name="image" accept="image/*" class="w-full bg-white dark:bg-slate-900 border border-slate-300 dark:border-slate-700 rounded-lg p-2 text-slate-700 dark:text-slate-300 text-sm focus:border-blue-500 outline-none file:mr-4 file:py-1 file:px-3 file:rounded-md file:border-0 file:text-xs file:font-bold file:bg-blue-600 file:text-white hover:file:bg-blue-700 transition">
                        </div>

                        <div class="flex items-center pt-2 md:pt-6">
                            <label class="inline-flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $project->is_featured) ? 'checked' : '' }} class="rounded border-slate-300 dark:border-slate-700 text-blue-600 focus:ring-blue-500 bg-white dark:bg-slate-900">
                                <span class="text-xs font-bold text-slate-700 dark:text-slate-300">{{ __('Feature on Homepage') }}</span>
                            </label>
                        </div>
                    </div>

                    <!-- Description (AR / EN) -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 sm:gap-6">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">
                                {{ __('Project Description (Arabic)') }} <span class="text-red-500 text-sm font-black">*</span>
                            </label>
                            <textarea name="description_ar" rows="4" required class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-300 dark:border-slate-700 rounded-lg px-3.5 py-2.5 text-slate-900 dark:text-white text-sm focus:border-blue-500 outline-none">{{ old('description_ar', $project->getTranslation('description', 'ar', false)) }}</textarea>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">
                                {{ __('Project Description (English)') }}
                            </label>
                            <textarea name="description_en" rows="4" class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-300 dark:border-slate-700 rounded-lg px-3.5 py-2.5 text-slate-900 dark:text-white text-sm focus:border-blue-500 outline-none">{{ old('description_en', $project->getTranslation('description', 'en', false)) }}</textarea>
                        </div>
                    </div>

                    <!-- Submit -->
                    <div class="pt-4 border-t border-slate-200 dark:border-slate-800 flex flex-col-reverse sm:flex-row sm:justify-end gap-3">
                        <a href="{{ route('admin.projects.index') }}" class="w-full sm:w-auto text-center px-5 py-2.5 rounded-lg bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white text-sm font-semibold border border-slate-300 dark:border-slate-700 transition">
                            {{ __('Cancel') }}
                        </a>
                        <button type="submit" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-2.5 rounded-lg bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-bold text-sm shadow-md shadow-blue-500/20 transition">
                            <i class="fa-solid fa-save"></i>
                            <span>{{ __('Update Project') }}</span>
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-extrabold text-2xl text-white tracking-tight flex items-center gap-3">
                <span class="p-2 rounded-lg bg-blue-500/20 text-blue-400">
                    <i class="fa-solid fa-pen-to-square"></i>
                </span>
                {{ __('Edit Project') }}: {{ $project->getTranslation('title', 'ar') }}
            </h2>
            <a href="{{ route('admin.projects.index') }}" class="px-3.5 py-1.5 rounded-lg bg-slate-800 text-slate-300 hover:text-white text-xs font-bold border border-slate-700">
                &larr; {{ __('Back to Projects') }}
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

                <form action="{{ route('admin.projects.update', $project->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Titles (AR / EN) -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-bold text-slate-300 mb-1.5">
                                {{ __('Project Title (Arabic) *') }}
                            </label>
                            <input type="text" name="title_ar" value="{{ old('title_ar', $project->getTranslation('title', 'ar', false)) }}" required class="w-full bg-slate-950 border border-slate-700 rounded-lg px-3.5 py-2.5 text-white text-sm focus:border-blue-400 outline-none">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-300 mb-1.5">
                                {{ __('Project Title (English)') }}
                            </label>
                            <input type="text" name="title_en" value="{{ old('title_en', $project->getTranslation('title', 'en', false)) }}" class="w-full bg-slate-950 border border-slate-700 rounded-lg px-3.5 py-2.5 text-white text-sm focus:border-blue-400 outline-none">
                        </div>
                    </div>

                    <!-- Category (AR / EN) -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-bold text-slate-300 mb-1.5">
                                {{ __('Category (Arabic)') }}
                            </label>
                            <input type="text" name="category_ar" value="{{ old('category_ar', $project->getTranslation('category', 'ar', false)) }}" class="w-full bg-slate-950 border border-slate-700 rounded-lg px-3.5 py-2.5 text-white text-sm focus:border-blue-400 outline-none">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-300 mb-1.5">
                                {{ __('Category (English)') }}
                            </label>
                            <input type="text" name="category_en" value="{{ old('category_en', $project->getTranslation('category', 'en', false)) }}" class="w-full bg-slate-950 border border-slate-700 rounded-lg px-3.5 py-2.5 text-white text-sm focus:border-blue-400 outline-none">
                        </div>
                    </div>

                    <!-- Client & Location -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-bold text-slate-300 mb-1.5">
                                {{ __('Client / Owner') }}
                            </label>
                            <input type="text" name="client_ar" value="{{ old('client_ar', $project->getTranslation('client', 'ar', false)) }}" class="w-full bg-slate-950 border border-slate-700 rounded-lg px-3.5 py-2.5 text-white text-sm focus:border-blue-400 outline-none">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-300 mb-1.5">
                                {{ __('Location') }}
                            </label>
                            <input type="text" name="location_ar" value="{{ old('location_ar', $project->getTranslation('location', 'ar', false)) }}" class="w-full bg-slate-950 border border-slate-700 rounded-lg px-3.5 py-2.5 text-white text-sm focus:border-blue-400 outline-none">
                        </div>
                    </div>

                    <!-- Area, Status, Completion Date -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-xs font-bold text-slate-300 mb-1.5">
                                {{ __('Scope / Area') }}
                            </label>
                            <input type="text" name="area" value="{{ old('area', $project->area) }}" class="w-full bg-slate-950 border border-slate-700 rounded-lg px-3.5 py-2.5 text-white text-sm focus:border-blue-400 outline-none">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-300 mb-1.5">
                                {{ __('Status') }}
                            </label>
                            <select name="status" class="w-full bg-slate-950 border border-slate-700 rounded-lg px-3.5 py-2.5 text-white text-sm focus:border-blue-400 outline-none">
                                <option value="completed" {{ old('status', $project->status) == 'completed' ? 'selected' : '' }}>{{ __('مكتمل (Completed)') }}</option>
                                <option value="ongoing" {{ old('status', $project->status) == 'ongoing' ? 'selected' : '' }}>{{ __('قيد التنفيذ (Ongoing)') }}</option>
                                <option value="planning" {{ old('status', $project->status) == 'planning' ? 'selected' : '' }}>{{ __('مرحلة الدراسة والتخطيط (Planning)') }}</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-300 mb-1.5">
                                {{ __('Completion / Milestone Date') }}
                            </label>
                            <input type="date" name="completion_date" value="{{ old('completion_date', $project->completion_date ? $project->completion_date->format('Y-m-d') : '') }}" class="w-full bg-slate-950 border border-slate-700 rounded-lg px-3.5 py-2.5 text-white text-sm focus:border-blue-400 outline-none">
                        </div>
                    </div>

                    <!-- Main Image & Options -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 p-4 rounded-xl bg-slate-950/60 border border-slate-800">
                        <div class="md:col-span-2">
                            <label class="block text-xs font-bold text-slate-300 mb-1.5">
                                {{ __('Project Main Image (Optional update)') }}
                            </label>
                            @if($project->image_path)
                                <div class="mb-2 flex items-center gap-3">
                                    <img src="{{ $project->image_url }}" class="w-16 h-12 object-cover rounded border border-slate-700">
                                    <span class="text-xs text-slate-400">Current Image</span>
                                </div>
                            @endif
                            <input type="file" name="image" accept="image/*" class="w-full bg-slate-900 border border-slate-700 rounded-lg p-2 text-slate-300 text-sm focus:border-blue-400 outline-none file:mr-4 file:py-1 file:px-3 file:rounded-md file:border-0 file:text-xs file:font-bold file:bg-blue-600 file:text-white hover:file:bg-blue-700">
                        </div>

                        <div class="flex items-center pt-6">
                            <label class="inline-flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $project->is_featured) ? 'checked' : '' }} class="rounded border-slate-700 text-blue-600 focus:ring-blue-500 bg-slate-900">
                                <span class="text-xs font-bold text-slate-300">{{ __('Feature on Homepage') }}</span>
                            </label>
                        </div>
                    </div>

                    <!-- Description (AR / EN) -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-bold text-slate-300 mb-1.5">
                                {{ __('Project Description (Arabic) *') }}
                            </label>
                            <textarea name="description_ar" rows="4" required class="w-full bg-slate-950 border border-slate-700 rounded-lg px-3.5 py-2.5 text-white text-sm focus:border-blue-400 outline-none">{{ old('description_ar', $project->getTranslation('description', 'ar', false)) }}</textarea>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-300 mb-1.5">
                                {{ __('Project Description (English)') }}
                            </label>
                            <textarea name="description_en" rows="4" class="w-full bg-slate-950 border border-slate-700 rounded-lg px-3.5 py-2.5 text-white text-sm focus:border-blue-400 outline-none">{{ old('description_en', $project->getTranslation('description', 'en', false)) }}</textarea>
                        </div>
                    </div>

                    <!-- Submit -->
                    <div class="pt-4 border-t border-slate-800 flex justify-end gap-3">
                        <a href="{{ route('admin.projects.index') }}" class="px-5 py-2.5 rounded-lg bg-slate-800 text-slate-300 hover:text-white text-sm font-semibold">
                            {{ __('Cancel') }}
                        </a>
                        <button type="submit" class="px-6 py-2.5 rounded-lg bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-bold text-sm shadow-lg shadow-blue-500/20">
                            <i class="fa-solid fa-save me-1.5"></i>
                            {{ __('Update Project') }}
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>

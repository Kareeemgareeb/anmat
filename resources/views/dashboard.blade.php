<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-extrabold text-xl sm:text-2xl text-slate-900 dark:text-white tracking-tight flex items-center gap-3">
                    <span class="p-2 rounded-lg bg-amber-500/20 text-amber-500">
                        <i class="fa-solid fa-gauge-high"></i>
                    </span>
                    <span>{{ __('Admin Control Panel') }}</span>
                </h2>
                <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400 mt-1">
                    {{ __('Manage projects, services, document archives, client inquiries, and live website settings.') }}
                </p>
            </div>
            
            <div class="flex items-center">
                <a href="{{ route('admin.correspondences.create') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-slate-950 font-bold rounded-lg shadow-md shadow-amber-500/20 text-sm transition">
                    <i class="fa-solid fa-plus"></i>
                    <span>{{ __('Log New Correspondence') }}</span>
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6 sm:py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6 sm:space-y-8">

            <!-- KPI Stats Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-5">
                <!-- Archive Card -->
                <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl p-5 shadow-sm hover:border-amber-500/40 transition">
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-xs font-bold text-amber-700 dark:text-amber-400 uppercase tracking-wider">{{ __('Archive & Letters') }}</span>
                        <div class="w-10 h-10 rounded-lg bg-amber-500/10 text-amber-500 flex items-center justify-center text-lg">
                            <i class="fa-solid fa-folder-closed"></i>
                        </div>
                    </div>
                    <div class="text-3xl font-extrabold text-slate-900 dark:text-white">{{ $stats['correspondences'] ?? 0 }}</div>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">{{ __('Archived official letters & reports') }}</p>
                    <div class="mt-4 pt-3 border-t border-slate-200 dark:border-slate-800">
                        <a href="{{ route('admin.correspondences.index') }}" class="text-xs font-semibold text-amber-600 dark:text-amber-400 hover:underline inline-flex items-center gap-1.5">
                            <span>{{ __('View Archive Registry') }}</span>
                            <i class="fa-solid {{ app()->getLocale() == 'ar' ? 'fa-arrow-left' : 'fa-arrow-right' }} text-xs"></i>
                        </a>
                    </div>
                </div>

                <!-- Projects Card -->
                <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl p-5 shadow-sm hover:border-blue-500/40 transition">
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-xs font-bold text-blue-600 dark:text-blue-400 uppercase tracking-wider">{{ __('Engineering Projects') }}</span>
                        <div class="w-10 h-10 rounded-lg bg-blue-500/10 text-blue-500 flex items-center justify-center text-lg">
                            <i class="fa-solid fa-city"></i>
                        </div>
                    </div>
                    <div class="text-3xl font-extrabold text-slate-900 dark:text-white">{{ $stats['projects'] ?? 0 }}</div>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">{{ __('Active and delivered projects') }}</p>
                    <div class="mt-4 pt-3 border-t border-slate-200 dark:border-slate-800">
                        <a href="{{ route('admin.projects.index') }}" class="text-xs font-semibold text-blue-600 dark:text-blue-400 hover:underline inline-flex items-center gap-1.5">
                            <span>{{ __('Manage Projects') }}</span>
                            <i class="fa-solid {{ app()->getLocale() == 'ar' ? 'fa-arrow-left' : 'fa-arrow-right' }} text-xs"></i>
                        </a>
                    </div>
                </div>

                <!-- Services Card -->
                <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl p-5 shadow-sm hover:border-purple-500/40 transition">
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-xs font-bold text-purple-600 dark:text-purple-400 uppercase tracking-wider">{{ __('Active Services') }}</span>
                        <div class="w-10 h-10 rounded-lg bg-purple-500/10 text-purple-500 flex items-center justify-center text-lg">
                            <i class="fa-solid fa-compass-drafting"></i>
                        </div>
                    </div>
                    <div class="text-3xl font-extrabold text-slate-900 dark:text-white">{{ $stats['services'] ?? 0 }}</div>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">{{ __('Published services on site') }}</p>
                    <div class="mt-4 pt-3 border-t border-slate-200 dark:border-slate-800">
                        <a href="{{ route('admin.services.index') }}" class="text-xs font-semibold text-purple-600 dark:text-purple-400 hover:underline inline-flex items-center gap-1.5">
                            <span>{{ __('Manage Services') }}</span>
                            <i class="fa-solid {{ app()->getLocale() == 'ar' ? 'fa-arrow-left' : 'fa-arrow-right' }} text-xs"></i>
                        </a>
                    </div>
                </div>

                <!-- Inquiries Card -->
                <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl p-5 shadow-sm hover:border-emerald-500/40 transition">
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-xs font-bold text-emerald-600 dark:text-emerald-400 uppercase tracking-wider">{{ __('Client Inquiries') }}</span>
                        <div class="w-10 h-10 rounded-lg bg-emerald-500/10 text-emerald-500 flex items-center justify-center text-lg">
                            <i class="fa-solid fa-envelope"></i>
                        </div>
                    </div>
                    <div class="text-3xl font-extrabold text-slate-900 dark:text-white flex items-center gap-3">
                        <span>{{ $stats['inquiries'] ?? 0 }}</span>
                        @if(($stats['new_inquiries'] ?? 0) > 0)
                            <span class="text-xs font-bold px-2 py-0.5 rounded-full bg-emerald-100 text-emerald-800 dark:bg-emerald-500/20 dark:text-emerald-400 border border-emerald-300 dark:border-emerald-500/30">
                                {{ $stats['new_inquiries'] }} {{ __('New') }}
                            </span>
                        @endif
                    </div>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">{{ __('New received requests') }}</p>
                    <div class="mt-4 pt-3 border-t border-slate-200 dark:border-slate-800">
                        <a href="{{ route('admin.inquiries.index') }}" class="text-xs font-semibold text-emerald-600 dark:text-emerald-400 hover:underline inline-flex items-center gap-1.5">
                            <span>{{ __('View Inquiries') }}</span>
                            <i class="fa-solid {{ app()->getLocale() == 'ar' ? 'fa-arrow-left' : 'fa-arrow-right' }} text-xs"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Quick Action Buttons Bar -->
            <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl p-4 flex flex-col sm:flex-row sm:items-center justify-between gap-3 shadow-sm">
                <div class="flex items-center gap-2 text-xs sm:text-sm text-slate-700 dark:text-slate-300 font-bold">
                    <i class="fa-solid fa-bolt text-amber-500"></i>
                    <span>{{ __('Quick Actions') }}:</span>
                </div>
                <div class="flex items-center gap-2 flex-wrap">
                    <a href="{{ route('admin.correspondences.create') }}" class="px-3 py-1.5 bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 text-amber-700 dark:text-amber-400 border border-slate-300 dark:border-slate-700 rounded-lg text-xs font-bold flex items-center gap-1.5 transition">
                        <i class="fa-solid fa-plus"></i> {{ __('Log New Correspondence') }}
                    </a>
                    <a href="{{ route('admin.services.create') }}" class="px-3 py-1.5 bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 text-purple-700 dark:text-purple-400 border border-slate-300 dark:border-slate-700 rounded-lg text-xs font-bold flex items-center gap-1.5 transition">
                        <i class="fa-solid fa-plus"></i> {{ __('New Service') }}
                    </a>
                    <a href="{{ route('admin.projects.create') }}" class="px-3 py-1.5 bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 text-blue-700 dark:text-blue-400 border border-slate-300 dark:border-slate-700 rounded-lg text-xs font-bold flex items-center gap-1.5 transition">
                        <i class="fa-solid fa-plus"></i> {{ __('New Project') }}
                    </a>
                    <a href="{{ route('admin.settings.index') }}" class="px-3 py-1.5 bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-200 border border-slate-300 dark:border-slate-700 rounded-lg text-xs font-bold flex items-center gap-1.5 transition">
                        <i class="fa-solid fa-sliders"></i> {{ __('Site Settings') }}
                    </a>
                </div>
            </div>

            <!-- 2-Column Split: Recent Correspondences & Recent Inquiries -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 sm:gap-8">
                <!-- Recent Archive Documents -->
                <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl p-5 sm:p-6 shadow-sm">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="font-extrabold text-sm sm:text-base text-slate-900 dark:text-white flex items-center gap-2">
                            <i class="fa-solid fa-folder-tree text-amber-500"></i>
                            <span>{{ __('Recent Documents & Letters') }}</span>
                        </h3>
                        <a href="{{ route('admin.correspondences.index') }}" class="text-xs font-bold text-amber-600 dark:text-amber-400 hover:underline inline-flex items-center gap-1">
                            <span>{{ __('View All') }}</span>
                            <i class="fa-solid {{ app()->getLocale() == 'ar' ? 'fa-arrow-left' : 'fa-arrow-right' }} text-[10px]"></i>
                        </a>
                    </div>

                    <div class="space-y-3">
                        @forelse($recentCorrespondences as $doc)
                            <div class="p-3.5 rounded-lg bg-slate-50 dark:bg-slate-950/60 border border-slate-200 dark:border-slate-800/80 hover:border-slate-300 dark:border-slate-700 flex items-center justify-between gap-3 transition">
                                <div class="min-w-0">
                                    <div class="flex items-center gap-2 mb-1 flex-wrap">
                                        <span class="font-mono text-xs font-bold text-amber-700 dark:text-amber-400 bg-amber-100 dark:bg-amber-400/10 px-2 py-0.5 rounded border border-amber-300 dark:border-amber-400/20">
                                            {{ $doc->reference_number }}
                                        </span>
                                        <span class="text-[10px] font-semibold uppercase px-1.5 py-0.5 rounded bg-slate-200 dark:bg-slate-800 text-slate-700 dark:text-slate-300">
                                            {{ $doc->type_label }}
                                        </span>
                                    </div>
                                    <h4 class="text-sm font-bold text-slate-900 dark:text-white truncate">{{ $doc->subject }}</h4>
                                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5 truncate">{{ $doc->sender }} &rarr; {{ $doc->receiver }}</p>
                                </div>

                                <div class="flex items-center gap-1.5 flex-shrink-0">
                                    <a href="{{ route('admin.correspondences.show', $doc->id) }}" class="p-2 rounded-lg bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white border border-slate-200 dark:border-slate-700" title="{{ __('View Document') }}">
                                        <i class="fa-solid fa-eye text-xs"></i>
                                    </a>
                                    @if($doc->file_path)
                                        <a href="{{ route('admin.correspondences.download', $doc->id) }}" class="p-2 rounded-lg bg-emerald-100 dark:bg-emerald-500/20 text-emerald-700 dark:text-emerald-400 hover:bg-emerald-200 dark:hover:bg-emerald-500/30 border border-emerald-200 dark:border-emerald-500/30" title="{{ __('Download') }}">
                                            <i class="fa-solid fa-download text-xs"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <p class="text-sm text-slate-500 dark:text-slate-400 text-center py-6">{{ __('No documents found matching your filter criteria.') }}</p>
                        @endforelse
                    </div>
                </div>

                <!-- Recent Client Inquiries -->
                <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl p-5 sm:p-6 shadow-sm">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="font-extrabold text-sm sm:text-base text-slate-900 dark:text-white flex items-center gap-2">
                            <i class="fa-solid fa-inbox text-emerald-500"></i>
                            <span>{{ __('Recent Client Inquiries') }}</span>
                        </h3>
                        <a href="{{ route('admin.inquiries.index') }}" class="text-xs font-bold text-emerald-600 dark:text-emerald-400 hover:underline inline-flex items-center gap-1">
                            <span>{{ __('View All') }}</span>
                            <i class="fa-solid {{ app()->getLocale() == 'ar' ? 'fa-arrow-left' : 'fa-arrow-right' }} text-[10px]"></i>
                        </a>
                    </div>

                    <div class="space-y-3">
                        @forelse($recentInquiries as $inq)
                            <div class="p-3.5 rounded-lg bg-slate-50 dark:bg-slate-950/60 border border-slate-200 dark:border-slate-800/80 hover:border-slate-300 dark:border-slate-700 flex items-center justify-between gap-3 transition">
                                <div class="min-w-0">
                                    <div class="flex items-center gap-2 mb-1">
                                        <span class="text-sm font-bold text-slate-900 dark:text-white truncate">{{ $inq->name }}</span>
                                        {!! $inq->status_badge !!}
                                    </div>
                                    <p class="text-xs text-amber-600 dark:text-amber-400 font-medium">{{ $inq->service ?: 'General Inquiry' }}</p>
                                    <p class="text-xs text-slate-500 dark:text-slate-400 truncate mt-0.5">{{ $inq->message }}</p>
                                </div>

                                <div class="flex items-center gap-2 flex-shrink-0">
                                    <a href="{{ route('admin.inquiries.show', $inq->id) }}" class="px-3 py-1.5 rounded-lg bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-200 hover:text-slate-900 dark:hover:text-white text-xs font-bold border border-slate-200 dark:border-slate-700">
                                        {{ __('View Document') }}
                                    </a>
                                </div>
                            </div>
                        @empty
                            <p class="text-sm text-slate-500 dark:text-slate-400 text-center py-6">{{ __('No inquiries received yet.') }}</p>
                        @endforelse
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>

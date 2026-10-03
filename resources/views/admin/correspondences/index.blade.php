<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-extrabold text-xl sm:text-2xl text-slate-900 dark:text-white tracking-tight flex items-center gap-3">
                    <span class="p-2 rounded-lg bg-amber-500/20 text-amber-500">
                        <i class="fa-solid fa-folder-tree"></i>
                    </span>
                    <span>{{ __('Document & Correspondence Archive') }}</span>
                </h2>
                <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400 mt-1">
                    {{ __('Centralized registry of all official incoming, outgoing, internal letters, and technical reports.') }}
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
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            @if(session('status'))
                <div class="p-4 rounded-lg bg-emerald-500/15 border border-emerald-500/30 text-emerald-600 dark:text-emerald-400 flex items-center gap-3 text-sm">
                    <i class="fa-solid fa-circle-check text-lg"></i>
                    <span>{{ session('status') }}</span>
                </div>
            @endif

            <!-- Filter & Search Bar -->
            <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl p-4 sm:p-5 shadow-sm">
                <form action="{{ route('admin.correspondences.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <!-- Search Query -->
                    <div class="md:col-span-2">
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">{{ __('Search Reference, Subject, Sender, or Archive Box') }}</label>
                        <div class="relative">
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="{{ app()->getLocale() == 'ar' ? 'ابحث بالرقم الإشاري، الموضوع، الراسل...' : 'Search reference code, subject, sender...' }}" class="w-full bg-white dark:bg-slate-950 border border-slate-300 dark:border-slate-700 rounded-lg px-3.5 py-2 text-sm text-slate-900 dark:text-white focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 outline-none">
                            @if(request('search'))
                                <a href="{{ route('admin.correspondences.index') }}" class="absolute {{ app()->getLocale() == 'ar' ? 'left-3' : 'right-3' }} top-2 text-sm text-slate-400 hover:text-slate-900 dark:hover:text-white">&times;</a>
                            @endif
                        </div>
                    </div>

                    <!-- Type Filter -->
                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">{{ __('Document Classification') }}</label>
                        <select name="type" class="w-full bg-white dark:bg-slate-950 border border-slate-300 dark:border-slate-700 rounded-lg px-3 py-2 text-sm text-slate-900 dark:text-white focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 outline-none" onchange="this.form.submit()">
                            <option value="">{{ __('All Types') }}</option>
                            <option value="outgoing" {{ request('type') == 'outgoing' ? 'selected' : '' }}>{{ __('Outgoing Letter') }}</option>
                            <option value="incoming" {{ request('type') == 'incoming' ? 'selected' : '' }}>{{ __('Incoming Letter') }}</option>
                            <option value="internal" {{ request('type') == 'internal' ? 'selected' : '' }}>{{ __('Internal Memo') }}</option>
                            <option value="technical_report" {{ request('type') == 'technical_report' ? 'selected' : '' }}>{{ __('Technical Report') }}</option>
                            <option value="contract_drawing" {{ request('type') == 'contract_drawing' ? 'selected' : '' }}>{{ __('Contract & Drawings') }}</option>
                        </select>
                    </div>

                    <!-- Status Filter -->
                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">{{ __('Action Status') }}</label>
                        <select name="status" class="w-full bg-white dark:bg-slate-950 border border-slate-300 dark:border-slate-700 rounded-lg px-3 py-2 text-sm text-slate-900 dark:text-white focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 outline-none" onchange="this.form.submit()">
                            <option value="">{{ __('All Statuses') }}</option>
                            <option value="pending_action" {{ request('status') == 'pending_action' ? 'selected' : '' }}>{{ __('Pending Action') }}</option>
                            <option value="closed" {{ request('status') == 'closed' ? 'selected' : '' }}>{{ __('Completed') }}</option>
                            <option value="archived" {{ request('status') == 'archived' ? 'selected' : '' }}>{{ __('Archived') }}</option>
                        </select>
                    </div>
                </form>
            </div>

            <!-- Documents Table -->
            <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl overflow-hidden shadow-sm">
                <div class="overflow-x-auto w-full">
                    <table class="min-w-full divide-y divide-slate-200 dark:divide-slate-800 text-sm">
                        <thead class="bg-slate-50 dark:bg-slate-950 text-slate-600 dark:text-slate-400 uppercase text-xs">
                            <tr>
                                <th class="py-3.5 px-4 text-start font-bold whitespace-nowrap">{{ __('Reference Code') }}</th>
                                <th class="py-3.5 px-4 text-start font-bold whitespace-nowrap">{{ __('Type') }}</th>
                                <th class="py-3.5 px-4 text-start font-bold">{{ __('Subject & Topic') }}</th>
                                <th class="py-3.5 px-4 text-start font-bold whitespace-nowrap">{{ __('Parties (From / To)') }}</th>
                                <th class="py-3.5 px-4 text-start font-bold whitespace-nowrap">{{ __('Date') }}</th>
                                <th class="py-3.5 px-4 text-start font-bold whitespace-nowrap">{{ __('Physical Archive') }}</th>
                                <th class="py-3.5 px-4 text-start font-bold whitespace-nowrap">{{ __('Status') }}</th>
                                <th class="py-3.5 px-4 text-center font-bold whitespace-nowrap">{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200 dark:divide-slate-800 text-slate-800 dark:text-slate-200">
                            @forelse($correspondences as $doc)
                                <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/40 transition">
                                    <!-- Reference Code -->
                                    <td class="py-3.5 px-4 whitespace-nowrap">
                                        <a href="{{ route('admin.correspondences.show', $doc->id) }}" class="font-mono text-xs font-bold text-amber-700 dark:text-amber-400 bg-amber-100 dark:bg-amber-400/10 px-2.5 py-1 rounded border border-amber-300 dark:border-amber-400/25 hover:bg-amber-200 dark:hover:bg-amber-400/20 transition">
                                            {{ $doc->reference_number }}
                                        </a>
                                    </td>

                                    <!-- Type -->
                                    <td class="py-3.5 px-4 whitespace-nowrap">
                                        <span class="text-xs font-semibold px-2 py-0.5 rounded bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 border border-slate-200 dark:border-slate-700">
                                            {{ $doc->type_label }}
                                        </span>
                                    </td>

                                    <!-- Subject -->
                                    <td class="py-3.5 px-4">
                                        <a href="{{ route('admin.correspondences.show', $doc->id) }}" class="font-bold text-slate-900 dark:text-white hover:text-amber-600 dark:hover:text-amber-400 line-clamp-1">
                                            {{ $doc->subject }}
                                        </a>
                                        @if($doc->tags)
                                            <span class="text-[11px] text-slate-500 dark:text-slate-400 mt-0.5 block">{{ $doc->tags }}</span>
                                        @endif
                                    </td>

                                    <!-- Parties -->
                                    <td class="py-3.5 px-4 text-xs whitespace-nowrap">
                                        <div class="text-slate-800 dark:text-slate-200 font-semibold">{{ $doc->sender }}</div>
                                        <div class="text-slate-500 dark:text-slate-400 mt-0.5">&rarr; {{ $doc->receiver }}</div>
                                    </td>

                                    <!-- Date -->
                                    <td class="py-3.5 px-4 whitespace-nowrap text-xs text-slate-600 dark:text-slate-300">
                                        {{ $doc->date_issued ? $doc->date_issued->format('d/m/Y') : '-' }}
                                    </td>

                                    <!-- Physical Archive -->
                                    <td class="py-3.5 px-4 whitespace-nowrap text-xs text-amber-700 dark:text-amber-300 font-mono">
                                        {{ $doc->physical_location ?: '-' }}
                                    </td>

                                    <!-- Status -->
                                    <td class="py-3.5 px-4 whitespace-nowrap">
                                        <span class="text-xs font-semibold px-2 py-0.5 rounded {{ $doc->status == 'closed' ? 'bg-emerald-100 text-emerald-800 dark:bg-emerald-500/20 dark:text-emerald-400' : 'bg-amber-100 text-amber-800 dark:bg-amber-500/20 dark:text-amber-400' }}">
                                            {{ $doc->status_label }}
                                        </span>
                                    </td>

                                    <!-- Actions -->
                                    <td class="py-3.5 px-4 whitespace-nowrap text-center text-xs">
                                        <div class="flex items-center justify-center gap-1.5">
                                            <a href="{{ route('admin.correspondences.show', $doc->id) }}" class="p-2 rounded-lg bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white border border-slate-200 dark:border-slate-700" title="{{ __('View Document') }}">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>
                                            @if($doc->file_path)
                                                <a href="{{ route('admin.correspondences.download', $doc->id) }}" class="p-2 rounded-lg bg-emerald-100 dark:bg-emerald-500/20 hover:bg-emerald-200 dark:hover:bg-emerald-500/30 text-emerald-700 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-500/30" title="{{ __('Download') }}">
                                                    <i class="fa-solid fa-download"></i>
                                                </a>
                                            @endif
                                            <a href="{{ route('admin.correspondences.edit', $doc->id) }}" class="p-2 rounded-lg bg-amber-100 dark:bg-amber-500/20 hover:bg-amber-200 dark:hover:bg-amber-500/30 text-amber-700 dark:text-amber-400 border border-amber-200 dark:border-amber-500/30" title="{{ __('Edit') }}">
                                                <i class="fa-solid fa-pen"></i>
                                            </a>
                                            <form action="{{ route('admin.correspondences.destroy', $doc->id) }}" method="POST" class="inline" onsubmit="return confirm('{{ __('Are you sure you want to delete this document?') }}');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-2 rounded-lg bg-red-100 dark:bg-red-500/20 hover:bg-red-200 dark:hover:bg-red-500/30 text-red-600 dark:text-red-400 border border-red-200 dark:border-red-500/30" title="{{ __('Delete') }}">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="py-10 text-center text-slate-500 dark:text-slate-400 text-sm">
                                        <i class="fa-solid fa-inbox text-3xl mb-2 text-slate-400 block"></i>
                                        {{ __('No correspondences found matching criteria.') }}
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($correspondences->hasPages())
                    <div class="p-4 border-t border-slate-200 dark:border-slate-800">
                        {{ $correspondences->links() }}
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>

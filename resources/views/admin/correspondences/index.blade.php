<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h2 class="font-extrabold text-2xl text-white tracking-tight flex items-center gap-3">
                    <span class="p-2 rounded-lg bg-amber-500/20 text-amber-400">
                        <i class="fa-solid fa-folder-tree"></i>
                    </span>
                    {{ __('Document & Correspondence Archive') }} (أرشيف الوثائق والمراسلات)
                </h2>
                <p class="text-sm text-slate-400 mt-1">
                    {{ __('Centralized registry of all official incoming, outgoing, internal letters, and technical reports.') }}
                </p>
            </div>

            <div class="flex items-center gap-3">
                <a href="{{ route('admin.correspondences.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-slate-950 font-bold rounded-lg shadow-lg shadow-amber-500/20 transition">
                    <i class="fa-solid fa-plus"></i>
                    <span>{{ __('+ Log New Correspondence') }}</span>
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if(session('status'))
                <div class="p-4 rounded-lg bg-emerald-500/15 border border-emerald-500/30 text-emerald-400 flex items-center gap-3">
                    <i class="fa-solid fa-circle-check text-lg"></i>
                    <span>{{ session('status') }}</span>
                </div>
            @endif

            <!-- Filter & Search Bar -->
            <div class="bg-slate-900 border border-slate-800 rounded-xl p-5 shadow-sm">
                <form action="{{ route('admin.correspondences.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <!-- Search Query -->
                    <div class="md:col-span-2">
                        <label class="block text-xs font-semibold text-slate-400 mb-1">{{ __('Search Reference, Subject, Sender, or Archive Box') }}</label>
                        <div class="relative">
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="e.g. ANMAT-OUT-2026-0001, Tripoli Tower, etc..." class="w-full bg-slate-950 border border-slate-700 rounded-lg px-3 py-2 text-sm text-white focus:border-amber-400 outline-none">
                            @if(request('search'))
                                <a href="{{ route('admin.correspondences.index') }}" class="absolute right-3 top-2.5 text-xs text-slate-400 hover:text-white">&times;</a>
                            @endif
                        </div>
                    </div>

                    <!-- Type Filter -->
                    <div>
                        <label class="block text-xs font-semibold text-slate-400 mb-1">{{ __('Document Classification') }}</label>
                        <select name="type" class="w-full bg-slate-950 border border-slate-700 rounded-lg px-3 py-2 text-sm text-white focus:border-amber-400 outline-none" onchange="this.form.submit()">
                            <option value="">{{ __('All Types (الكل)') }}</option>
                            <option value="outgoing" {{ request('type') == 'outgoing' ? 'selected' : '' }}>{{ __('صادر رسمي (Outgoing)') }}</option>
                            <option value="incoming" {{ request('type') == 'incoming' ? 'selected' : '' }}>{{ __('وارد رسمي (Incoming)') }}</option>
                            <option value="internal" {{ request('type') == 'internal' ? 'selected' : '' }}>{{ __('مذكرة داخلية (Internal)') }}</option>
                            <option value="technical_report" {{ request('type') == 'technical_report' ? 'selected' : '' }}>{{ __('تقرير فني (Technical Report)') }}</option>
                            <option value="contract_drawing" {{ request('type') == 'contract_drawing' ? 'selected' : '' }}>{{ __('عقد / مخططات (Contract)') }}</option>
                        </select>
                    </div>

                    <!-- Status Filter -->
                    <div>
                        <label class="block text-xs font-semibold text-slate-400 mb-1">{{ __('Action Status') }}</label>
                        <select name="status" class="w-full bg-slate-950 border border-slate-700 rounded-lg px-3 py-2 text-sm text-white focus:border-amber-400 outline-none" onchange="this.form.submit()">
                            <option value="">{{ __('All Statuses (كل الحالات)') }}</option>
                            <option value="pending_action" {{ request('status') == 'pending_action' ? 'selected' : '' }}>{{ __('قيد المتابعة (Pending)') }}</option>
                            <option value="closed" {{ request('status') == 'closed' ? 'selected' : '' }}>{{ __('مكتمل (Closed)') }}</option>
                            <option value="archived" {{ request('status') == 'archived' ? 'selected' : '' }}>{{ __('مؤرشف نهائياً (Archived)') }}</option>
                        </select>
                    </div>
                </form>
            </div>

            <!-- Documents Table -->
            <div class="bg-slate-900 border border-slate-800 rounded-xl overflow-hidden shadow-sm">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-800 text-sm">
                        <thead class="bg-slate-950 text-slate-400 uppercase text-xs">
                            <tr>
                                <th class="py-3.5 px-4 text-start font-bold">{{ __('Reference Code') }}</th>
                                <th class="py-3.5 px-4 text-start font-bold">{{ __('Type') }}</th>
                                <th class="py-3.5 px-4 text-start font-bold">{{ __('Subject & Topic') }}</th>
                                <th class="py-3.5 px-4 text-start font-bold">{{ __('Parties (From / To)') }}</th>
                                <th class="py-3.5 px-4 text-start font-bold">{{ __('Date') }}</th>
                                <th class="py-3.5 px-4 text-start font-bold">{{ __('Physical Archive') }}</th>
                                <th class="py-3.5 px-4 text-start font-bold">{{ __('Status') }}</th>
                                <th class="py-3.5 px-4 text-center font-bold">{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-800 text-slate-200">
                            @forelse($correspondences as $doc)
                                <tr class="hover:bg-slate-800/40 transition">
                                    <!-- Reference Code -->
                                    <td class="py-3.5 px-4 whitespace-nowrap">
                                        <a href="{{ route('admin.correspondences.show', $doc->id) }}" class="font-mono text-xs font-bold text-amber-400 bg-amber-400/10 px-2.5 py-1 rounded border border-amber-400/25 hover:bg-amber-400/20 transition">
                                            {{ $doc->reference_number }}
                                        </a>
                                    </td>

                                    <!-- Type -->
                                    <td class="py-3.5 px-4 whitespace-nowrap">
                                        <span class="text-xs font-semibold px-2 py-0.5 rounded bg-slate-800 text-slate-300">
                                            {{ $doc->type_label }}
                                        </span>
                                    </td>

                                    <!-- Subject -->
                                    <td class="py-3.5 px-4">
                                        <a href="{{ route('admin.correspondences.show', $doc->id) }}" class="font-bold text-white hover:text-amber-400 line-clamp-1">
                                            {{ $doc->subject }}
                                        </a>
                                        @if($doc->tags)
                                            <span class="text-[11px] text-slate-400 mt-0.5 block">{{ $doc->tags }}</span>
                                        @endif
                                    </td>

                                    <!-- Parties -->
                                    <td class="py-3.5 px-4 text-xs">
                                        <div class="text-slate-300 font-semibold">{{ $doc->sender }}</div>
                                        <div class="text-slate-400 mt-0.5">&rarr; {{ $doc->receiver }}</div>
                                    </td>

                                    <!-- Date -->
                                    <td class="py-3.5 px-4 whitespace-nowrap text-xs text-slate-300">
                                        {{ $doc->date_issued->format('Y-m-d') }}
                                    </td>

                                    <!-- Physical Archive -->
                                    <td class="py-3.5 px-4 whitespace-nowrap text-xs text-amber-300 font-mono">
                                        {{ $doc->physical_location ?: '-' }}
                                    </td>

                                    <!-- Status -->
                                    <td class="py-3.5 px-4 whitespace-nowrap">
                                        <span class="text-xs font-semibold px-2 py-0.5 rounded {{ $doc->status == 'closed' ? 'bg-emerald-500/20 text-emerald-400' : 'bg-amber-500/20 text-amber-400' }}">
                                            {{ $doc->status_label }}
                                        </span>
                                    </td>

                                    <!-- Actions -->
                                    <td class="py-3.5 px-4 whitespace-nowrap text-center text-xs">
                                        <div class="flex items-center justify-center gap-1.5">
                                            <a href="{{ route('admin.correspondences.show', $doc->id) }}" class="p-1.5 rounded bg-slate-800 hover:bg-slate-700 text-slate-300 hover:text-white" title="{{ __('View Tracking Slip') }}">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>
                                            @if($doc->file_path)
                                                <a href="{{ route('admin.correspondences.download', $doc->id) }}" class="p-1.5 rounded bg-emerald-500/20 hover:bg-emerald-500/30 text-emerald-400" title="{{ __('Download File') }}">
                                                    <i class="fa-solid fa-download"></i>
                                                </a>
                                            @endif
                                            <a href="{{ route('admin.correspondences.edit', $doc->id) }}" class="p-1.5 rounded bg-blue-500/20 hover:bg-blue-500/30 text-blue-400" title="{{ __('Edit') }}">
                                                <i class="fa-solid fa-pen"></i>
                                            </a>
                                            <form action="{{ route('admin.correspondences.destroy', $doc->id) }}" method="POST" class="inline" onsubmit="return confirm('{{ __('Are you sure you want to permanently delete this archived document?') }}');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-1.5 rounded bg-red-500/20 hover:bg-red-500/30 text-red-400" title="{{ __('Delete') }}">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="py-8 text-center text-slate-500">
                                        {{ __('No documents found matching your filter criteria.') }}
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($correspondences->hasPages())
                    <div class="p-4 border-t border-slate-800">
                        {{ $correspondences->links() }}
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>

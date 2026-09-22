<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-extrabold text-2xl text-white tracking-tight flex items-center gap-3">
                    <span class="p-2 rounded-lg bg-emerald-500/20 text-emerald-400">
                        <i class="fa-solid fa-inbox"></i>
                    </span>
                    {{ __('Client Inquiries & Consultation Requests') }} (استفسارات وطلبات العملاء)
                </h2>
                <p class="text-sm text-slate-400 mt-1">
                    {{ __('Manage messages and consultation requests submitted through the public website.') }}
                </p>
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

            <!-- Quick Status Filters -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <a href="{{ route('admin.inquiries.index') }}" class="p-4 rounded-xl bg-slate-900 border {{ !request('status') ? 'border-amber-500/60 bg-slate-800' : 'border-slate-800' }} hover:border-slate-700 transition">
                    <span class="text-xs text-slate-400 font-bold block">{{ __('All Inquiries (الكل)') }}</span>
                    <span class="text-2xl font-black text-white mt-1 block">{{ $counts['total'] }}</span>
                </a>

                <a href="{{ route('admin.inquiries.index', ['status' => 'new']) }}" class="p-4 rounded-xl bg-slate-900 border {{ request('status') == 'new' ? 'border-amber-500/60 bg-slate-800' : 'border-slate-800' }} hover:border-slate-700 transition">
                    <span class="text-xs text-amber-400 font-bold block">{{ __('New Messages (جديد)') }}</span>
                    <span class="text-2xl font-black text-amber-400 mt-1 block">{{ $counts['new'] }}</span>
                </a>

                <a href="{{ route('admin.inquiries.index', ['status' => 'contacted']) }}" class="p-4 rounded-xl bg-slate-900 border {{ request('status') == 'contacted' ? 'border-blue-500/60 bg-slate-800' : 'border-slate-800' }} hover:border-slate-700 transition">
                    <span class="text-xs text-blue-400 font-bold block">{{ __('Contacted (تم التواصل)') }}</span>
                    <span class="text-2xl font-black text-blue-400 mt-1 block">{{ $counts['contacted'] }}</span>
                </a>

                <a href="{{ route('admin.inquiries.index', ['status' => 'closed']) }}" class="p-4 rounded-xl bg-slate-900 border {{ request('status') == 'closed' ? 'border-emerald-500/60 bg-slate-800' : 'border-slate-800' }} hover:border-slate-700 transition">
                    <span class="text-xs text-emerald-400 font-bold block">{{ __('Closed (مكتمل ومغلق)') }}</span>
                    <span class="text-2xl font-black text-emerald-400 mt-1 block">{{ $counts['closed'] }}</span>
                </a>
            </div>

            <!-- Inquiries Table -->
            <div class="bg-slate-900 border border-slate-800 rounded-xl overflow-hidden shadow-sm">
                <table class="min-w-full divide-y divide-slate-800 text-sm">
                    <thead class="bg-slate-950 text-slate-400 uppercase text-xs">
                        <tr>
                            <th class="py-3.5 px-4 text-start font-bold">#</th>
                            <th class="py-3.5 px-4 text-start font-bold">{{ __('Sender Name') }}</th>
                            <th class="py-3.5 px-4 text-start font-bold">{{ __('Contact Info') }}</th>
                            <th class="py-3.5 px-4 text-start font-bold">{{ __('Service Requested') }}</th>
                            <th class="py-3.5 px-4 text-start font-bold">{{ __('Subject & Message') }}</th>
                            <th class="py-3.5 px-4 text-start font-bold">{{ __('Date') }}</th>
                            <th class="py-3.5 px-4 text-start font-bold">{{ __('Status') }}</th>
                            <th class="py-3.5 px-4 text-center font-bold">{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800 text-slate-200">
                        @forelse($inquiries as $inq)
                            <tr class="hover:bg-slate-800/40 transition">
                                <td class="py-3.5 px-4 text-slate-500 text-xs font-mono">{{ $inq->id }}</td>
                                <td class="py-3.5 px-4 font-bold text-white whitespace-nowrap">{{ $inq->name }}</td>
                                <td class="py-3.5 px-4 text-xs whitespace-nowrap">
                                    <div class="text-slate-300">{{ $inq->email }}</div>
                                    @if($inq->phone)
                                        <div class="text-amber-400 font-mono mt-0.5" dir="ltr">{{ $inq->phone }}</div>
                                    @endif
                                </td>
                                <td class="py-3.5 px-4 text-xs text-purple-300 whitespace-nowrap">
                                    {{ $inq->service ?: 'General Inquiry' }}
                                </td>
                                <td class="py-3.5 px-4">
                                    @if($inq->subject)
                                        <div class="font-semibold text-white text-xs mb-0.5">{{ $inq->subject }}</div>
                                    @endif
                                    <div class="text-xs text-slate-400 line-clamp-1">{{ $inq->message }}</div>
                                </td>
                                <td class="py-3.5 px-4 whitespace-nowrap text-xs text-slate-400">
                                    {{ $inq->created_at->diffForHumans() }}
                                </td>
                                <td class="py-3.5 px-4 whitespace-nowrap">
                                    {!! $inq->status_badge !!}
                                </td>
                                <td class="py-3.5 px-4 text-center whitespace-nowrap">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('admin.inquiries.show', $inq->id) }}" class="px-2.5 py-1 rounded bg-slate-800 hover:bg-slate-700 text-slate-200 hover:text-white text-xs font-bold" title="{{ __('View Details') }}">
                                            {{ __('Open') }}
                                        </a>
                                        <form action="{{ route('admin.inquiries.destroy', $inq->id) }}" method="POST" class="inline" onsubmit="return confirm('{{ __('Delete this inquiry message?') }}');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-1 rounded bg-red-500/20 hover:bg-red-500/30 text-red-400" title="{{ __('Delete') }}">
                                                <i class="fa-solid fa-trash-can text-xs"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="py-8 text-center text-slate-500">
                                    {{ __('No client inquiries found.') }}
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($inquiries->hasPages())
                <div class="p-4 border-t border-slate-800">
                    {{ $inquiries->links() }}
                </div>
            @endif

        </div>
    </div>
</x-app-layout>

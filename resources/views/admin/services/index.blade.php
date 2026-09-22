<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-extrabold text-2xl text-white tracking-tight flex items-center gap-3">
                    <span class="p-2 rounded-lg bg-purple-500/20 text-purple-400">
                        <i class="fa-solid fa-compass-drafting"></i>
                    </span>
                    {{ __('Services Management') }} (إدارة الخدمات الهندسية)
                </h2>
                <p class="text-sm text-slate-400 mt-1">
                    {{ __('Create, edit, and organize services displayed dynamically across the public website.') }}
                </p>
            </div>
            <a href="{{ route('admin.services.create') }}" class="px-4 py-2 bg-gradient-to-r from-purple-500 to-purple-600 hover:from-purple-600 hover:to-purple-700 text-white font-bold rounded-lg shadow-lg shadow-purple-500/20 text-sm flex items-center gap-2">
                <i class="fa-solid fa-plus"></i>
                <span>{{ __('+ Add New Service') }}</span>
            </a>
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

            <div class="bg-slate-900 border border-slate-800 rounded-xl overflow-hidden shadow-sm">
                <table class="min-w-full divide-y divide-slate-800 text-sm">
                    <thead class="bg-slate-950 text-slate-400 uppercase text-xs">
                        <tr>
                            <th class="py-3.5 px-4 text-start font-bold">#</th>
                            <th class="py-3.5 px-4 text-start font-bold">{{ __('Icon') }}</th>
                            <th class="py-3.5 px-4 text-start font-bold">{{ __('Service Title (Arabic / English)') }}</th>
                            <th class="py-3.5 px-4 text-start font-bold">{{ __('Category') }}</th>
                            <th class="py-3.5 px-4 text-start font-bold">{{ __('Featured') }}</th>
                            <th class="py-3.5 px-4 text-start font-bold">{{ __('Order') }}</th>
                            <th class="py-3.5 px-4 text-center font-bold">{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800 text-slate-200">
                        @forelse($services as $service)
                            <tr class="hover:bg-slate-800/40 transition">
                                <td class="py-3.5 px-4 text-slate-500 text-xs font-mono">{{ $service->id }}</td>
                                <td class="py-3.5 px-4">
                                    <div class="w-9 h-9 rounded-lg bg-purple-500/15 text-purple-400 flex items-center justify-center text-sm border border-purple-500/30">
                                        <i class="fa-solid fa-{{ $service->icon ?: 'compass-drafting' }}"></i>
                                    </div>
                                </td>
                                <td class="py-3.5 px-4">
                                    <div class="font-bold text-white">{{ $service->getTranslation('title', 'ar') }}</div>
                                    <div class="text-xs text-slate-400">{{ $service->getTranslation('title', 'en') }}</div>
                                </td>
                                <td class="py-3.5 px-4 text-xs text-slate-300">
                                    {{ $service->getTranslation('category', app()->getLocale()) ?: '-' }}
                                </td>
                                <td class="py-3.5 px-4">
                                    @if($service->is_featured)
                                        <span class="text-[11px] font-bold px-2 py-0.5 rounded-full bg-emerald-500/20 text-emerald-400 border border-emerald-500/30">
                                            {{ __('Featured') }}
                                        </span>
                                    @else
                                        <span class="text-[11px] text-slate-500">{{ __('Standard') }}</span>
                                    @endif
                                </td>
                                <td class="py-3.5 px-4 text-xs font-mono text-slate-400">
                                    {{ $service->order }}
                                </td>
                                <td class="py-3.5 px-4 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('admin.services.edit', $service->id) }}" class="p-1.5 rounded bg-blue-500/20 hover:bg-blue-500/30 text-blue-400" title="{{ __('Edit') }}">
                                            <i class="fa-solid fa-pen text-xs"></i>
                                        </a>
                                        <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST" class="inline" onsubmit="return confirm('{{ __('Are you sure you want to delete this service?') }}');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-1.5 rounded bg-red-500/20 hover:bg-red-500/30 text-red-400" title="{{ __('Delete') }}">
                                                <i class="fa-solid fa-trash-can text-xs"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="py-8 text-center text-slate-500">
                                    {{ __('No services added yet.') }}
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>

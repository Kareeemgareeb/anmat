<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-extrabold text-2xl text-white tracking-tight flex items-center gap-3">
                    <span class="p-2 rounded-lg bg-blue-500/20 text-blue-400">
                        <i class="fa-solid fa-city"></i>
                    </span>
                    {{ __('Projects Portfolio Management') }} (إدارة المشاريع وسجل الأعمال)
                </h2>
                <p class="text-sm text-slate-400 mt-1">
                    {{ __('Showcase landmark engineering and surveying achievements on your portfolio.') }}
                </p>
            </div>
            <a href="{{ route('admin.projects.create') }}" class="px-4 py-2 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-bold rounded-lg shadow-lg shadow-blue-500/20 text-sm flex items-center gap-2">
                <i class="fa-solid fa-plus"></i>
                <span>{{ __('+ Add New Project') }}</span>
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
                            <th class="py-3.5 px-4 text-start font-bold">{{ __('Project') }}</th>
                            <th class="py-3.5 px-4 text-start font-bold">{{ __('Client') }}</th>
                            <th class="py-3.5 px-4 text-start font-bold">{{ __('Location') }}</th>
                            <th class="py-3.5 px-4 text-start font-bold">{{ __('Status') }}</th>
                            <th class="py-3.5 px-4 text-start font-bold">{{ __('Featured') }}</th>
                            <th class="py-3.5 px-4 text-center font-bold">{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800 text-slate-200">
                        @forelse($projects as $project)
                            <tr class="hover:bg-slate-800/40 transition">
                                <td class="py-3.5 px-4 text-slate-500 text-xs font-mono">{{ $project->id }}</td>
                                <td class="py-3.5 px-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-12 h-12 rounded-lg bg-slate-950 border border-slate-800 overflow-hidden flex-shrink-0 flex items-center justify-center">
                                            @if($project->image_path)
                                                <img src="{{ $project->image_url }}" class="w-full h-full object-cover">
                                            @else
                                                <i class="fa-solid fa-building text-slate-600"></i>
                                            @endif
                                        </div>
                                        <div>
                                            <div class="font-bold text-white">{{ $project->getTranslation('title', 'ar') }}</div>
                                            <div class="text-xs text-amber-400 font-semibold">{{ $project->getTranslation('category', app()->getLocale()) ?: '-' }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3.5 px-4 text-xs text-slate-300">
                                    {{ $project->getTranslation('client', app()->getLocale()) ?: '-' }}
                                </td>
                                <td class="py-3.5 px-4 text-xs text-slate-300">
                                    {{ $project->getTranslation('location', app()->getLocale()) ?: '-' }}
                                </td>
                                <td class="py-3.5 px-4">
                                    <span class="text-xs font-bold px-2 py-0.5 rounded-full {{ $project->status == 'completed' ? 'bg-emerald-500/20 text-emerald-400' : 'bg-amber-500/20 text-amber-400' }}">
                                        {{ $project->status_label }}
                                    </span>
                                </td>
                                <td class="py-3.5 px-4">
                                    @if($project->is_featured)
                                        <span class="text-[11px] font-bold text-amber-400"><i class="fa-solid fa-star"></i> Featured</span>
                                    @else
                                        <span class="text-[11px] text-slate-500">Standard</span>
                                    @endif
                                </td>
                                <td class="py-3.5 px-4 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('admin.projects.edit', $project->id) }}" class="p-1.5 rounded bg-blue-500/20 hover:bg-blue-500/30 text-blue-400" title="{{ __('Edit') }}">
                                            <i class="fa-solid fa-pen text-xs"></i>
                                        </a>
                                        <form action="{{ route('admin.projects.destroy', $project->id) }}" method="POST" class="inline" onsubmit="return confirm('{{ __('Are you sure you want to delete this project?') }}');">
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
                                    {{ __('No projects added yet.') }}
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>

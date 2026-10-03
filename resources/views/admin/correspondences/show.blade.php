<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <h2 class="font-extrabold text-xl sm:text-2xl text-slate-900 dark:text-white tracking-tight flex items-center gap-3">
                <span class="p-2 rounded-lg bg-amber-500/20 text-amber-500">
                    <i class="fa-solid fa-stamp"></i>
                </span>
                <span>{{ __('Official Tracking Slip') }}: <span class="font-mono text-amber-600 dark:text-amber-400">{{ $correspondence->reference_number }}</span></span>
            </h2>
            <div class="flex items-center gap-2">
                <button onclick="window.print()" class="px-3.5 py-1.5 rounded-lg bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-200 hover:text-slate-900 dark:hover:text-white text-xs font-bold border border-slate-300 dark:border-slate-700 flex items-center gap-1.5 transition">
                    <i class="fa-solid fa-print"></i>
                    <span>{{ __('Print Slip') }}</span>
                </button>
                <a href="{{ route('admin.correspondences.index') }}" class="px-3.5 py-1.5 rounded-lg bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white text-xs font-bold border border-slate-300 dark:border-slate-700 inline-flex items-center gap-1 transition">
                    <i class="fa-solid {{ app()->getLocale() == 'ar' ? 'fa-arrow-right' : 'fa-arrow-left' }}"></i>
                    <span>{{ __('Back') }}</span>
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6 sm:py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Printable Certificate Box -->
            <div class="bg-white text-slate-900 rounded-2xl p-6 sm:p-10 shadow-xl border-2 sm:border-4 border-slate-200 relative overflow-hidden">
                
                <!-- Watermark Logo -->
                <div class="absolute inset-0 flex items-center justify-center opacity-5 pointer-events-none">
                    <img src="{{ asset('images/logo-dark.png') }}" class="w-96">
                </div>

                <!-- Slip Header -->
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 border-b-2 border-slate-200 pb-6 mb-8">
                    <div class="flex items-center gap-4">
                        <img src="{{ asset('images/logo-light.jpg') }}" alt="ANMAT" class="h-14 sm:h-16 w-auto object-contain">
                        <div>
                            <h3 class="font-black text-lg sm:text-xl text-slate-900">{{ __('ANMAT Engineering') }}</h3>
                            <p class="text-xs text-slate-600 font-semibold uppercase tracking-wider">Engineering Works & Consultancy</p>
                            <span class="text-[11px] text-amber-700 font-bold block mt-0.5">{{ __('Certified Electronic Archiving System') }}</span>
                        </div>
                    </div>

                    <div class="sm:text-end">
                        <span class="text-xs font-bold text-slate-500 uppercase block">{{ __('Official Reference Code Card') }}</span>
                        <div class="text-lg font-mono font-black text-amber-700 mt-0.5">{{ $correspondence->reference_number }}</div>
                        <div class="text-xs text-slate-500 mt-1">{{ $correspondence->date_issued ? $correspondence->date_issued->format('d/m/Y') : '-' }}</div>
                    </div>
                </div>

                <!-- Document Details Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-4 sm:gap-y-5 gap-x-8 text-sm mb-8">
                    <div class="border-b border-slate-200 pb-2">
                        <span class="text-xs font-bold text-slate-500 block mb-0.5">{{ __('Document Classification') }}</span>
                        <span class="font-bold text-slate-800">{{ $correspondence->type_label }}</span>
                    </div>

                    <div class="border-b border-slate-200 pb-2">
                        <span class="text-xs font-bold text-slate-500 block mb-0.5">{{ __('Priority & Confidentiality') }}</span>
                        <span class="font-bold text-slate-800">{{ $correspondence->priority_label }}</span>
                    </div>

                    <div class="sm:col-span-2 border-b border-slate-200 pb-2">
                        <span class="text-xs font-bold text-slate-500 block mb-0.5">{{ __('Document Subject') }}</span>
                        <span class="font-bold text-base text-slate-950">{{ $correspondence->subject }}</span>
                    </div>

                    <div class="border-b border-slate-200 pb-2">
                        <span class="text-xs font-bold text-slate-500 block mb-0.5">{{ __('Issuing Party / Sender') }}</span>
                        <span class="font-semibold text-slate-800">{{ $correspondence->sender }}</span>
                    </div>

                    <div class="border-b border-slate-200 pb-2">
                        <span class="text-xs font-bold text-slate-500 block mb-0.5">{{ __('Addressed To / Recipient') }}</span>
                        <span class="font-semibold text-slate-800">{{ $correspondence->receiver }}</span>
                    </div>

                    <div class="border-b border-slate-200 pb-2">
                        <span class="text-xs font-bold text-slate-500 block mb-0.5">{{ __('Physical Archive Reference') }}</span>
                        <span class="font-mono font-bold text-amber-800">{{ $correspondence->physical_location ?: __('Unspecified') }}</span>
                    </div>

                    <div class="border-b border-slate-200 pb-2">
                        <span class="text-xs font-bold text-slate-500 block mb-0.5">{{ __('Action Status') }}</span>
                        <span class="font-bold text-slate-800">{{ $correspondence->status_label }}</span>
                    </div>

                    @if($correspondence->tags)
                        <div class="sm:col-span-2 border-b border-slate-200 pb-2">
                            <span class="text-xs font-bold text-slate-500 block mb-0.5">{{ __('Keywords / Tags') }}</span>
                            <span class="text-slate-700 text-xs">{{ $correspondence->tags }}</span>
                        </div>
                    @endif
                </div>

                @if($correspondence->notes)
                    <div class="bg-slate-50 border border-slate-200 rounded-lg p-4 mb-8">
                        <span class="text-xs font-bold text-slate-700 block mb-1">{{ __('Administrative Follow-up Notes:') }}</span>
                        <p class="text-xs text-slate-600 leading-relaxed">{{ $correspondence->notes }}</p>
                    </div>
                @endif

                <!-- Attachment & Quick Verification Footer -->
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 pt-6 border-t-2 border-slate-200 text-xs">
                    <div>
                        @if($correspondence->file_path)
                            <div class="flex items-center gap-2">
                                <span class="font-bold text-slate-700">{{ __('Attached File:') }}</span>
                                <a href="{{ route('admin.correspondences.download', $correspondence->id) }}" class="text-blue-600 font-bold hover:underline flex items-center gap-1">
                                    <i class="fa-solid fa-paperclip"></i>
                                    <span>{{ $correspondence->file_name ?: basename($correspondence->file_path) }} ({{ $correspondence->formatted_file_size }})</span>
                                </a>
                            </div>
                        @else
                            <span class="text-slate-500">{{ __('No digital file attached') }}</span>
                        @endif
                    </div>

                    <div class="sm:text-end text-[11px] text-slate-500 font-mono">
                        <span>{{ __('Public Verification URL:') }} anmat.ly/verify-document?ref={{ $correspondence->reference_number }}</span>
                    </div>
                </div>
            </div>

            <!-- Bottom Actions -->
            <div class="mt-6 flex flex-col sm:flex-row sm:justify-end gap-3">
                <a href="{{ route('admin.correspondences.edit', $correspondence->id) }}" class="w-full sm:w-auto text-center px-5 py-2.5 rounded-lg bg-amber-600 hover:bg-amber-700 text-white font-bold text-sm shadow-md shadow-amber-600/20 transition">
                    <i class="fa-solid fa-pen me-1.5"></i>
                    <span>{{ __('Edit Document Metadata') }}</span>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>

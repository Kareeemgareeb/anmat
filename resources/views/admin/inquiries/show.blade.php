<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <h2 class="font-extrabold text-xl sm:text-2xl text-slate-900 dark:text-white tracking-tight flex items-center gap-3">
                <span class="p-2 rounded-lg bg-emerald-500/20 text-emerald-400">
                    <i class="fa-solid fa-envelope-open-text"></i>
                </span>
                <span>{{ __('Inquiry Details') }}: {{ $inquiry->name }}</span>
            </h2>
            <a href="{{ route('admin.inquiries.index') }}" class="w-fit inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-lg bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white text-xs font-bold border border-slate-300 dark:border-slate-700 transition">
                <i class="fa-solid {{ app()->getLocale() == 'ar' ? 'fa-arrow-right' : 'fa-arrow-left' }}"></i>
                <span>{{ __('Back to Inquiries') }}</span>
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Message Card -->
            <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl p-6 sm:p-8 shadow-sm">
                
                <div class="flex items-center justify-between border-b border-slate-200 dark:border-slate-800 pb-5 mb-6">
                    <div>
                        <h3 class="text-xl font-bold text-slate-900 dark:text-white">{{ $inquiry->name }}</h3>
                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">
                            <i class="fa-regular fa-clock me-1"></i> {{ $inquiry->created_at->format('d/m/Y H:i') }} ({{ $inquiry->created_at->diffForHumans() }})
                        </p>
                    </div>

                    <div class="flex items-center gap-3">
                        {!! $inquiry->status_badge !!}
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6 p-4 rounded-xl bg-slate-50 dark:bg-slate-950/60 border border-slate-200 dark:border-slate-800 text-xs">
                    <div>
                        <span class="text-slate-500 font-bold block mb-0.5">{{ __('Email Address') }}</span>
                        <a href="mailto:{{ $inquiry->email }}" class="text-amber-400 font-semibold hover:underline">
                            {{ $inquiry->email }}
                        </a>
                    </div>

                    <div>
                        <span class="text-slate-500 font-bold block mb-0.5">{{ __('Phone Number') }}</span>
                        @if($inquiry->phone)
                            <a href="tel:{{ $inquiry->phone }}" class="text-slate-900 dark:text-white font-mono font-semibold hover:underline" dir="ltr">
                                {{ $inquiry->phone }}
                            </a>
                        @else
                            <span class="text-slate-600">-</span>
                        @endif
                    </div>

                    <div>
                        <span class="text-slate-500 font-bold block mb-0.5">{{ __('Requested Service') }}</span>
                        <span class="text-purple-300 font-semibold">{{ $inquiry->service ?: 'General Inquiry' }}</span>
                    </div>
                </div>

                @if($inquiry->subject)
                    <div class="mb-4">
                        <span class="text-xs font-bold text-slate-500 dark:text-slate-400 block mb-1">{{ __('Subject') }}</span>
                        <h4 class="text-base font-bold text-slate-900 dark:text-white">{{ $inquiry->subject }}</h4>
                    </div>
                @endif

                <div class="mb-8">
                    <span class="text-xs font-bold text-slate-500 dark:text-slate-400 block mb-2">{{ __('Client Message Body') }}</span>
                    <div class="p-5 rounded-xl bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800/80 text-sm text-slate-700 dark:text-slate-200 leading-relaxed whitespace-pre-wrap">
                        {{ $inquiry->message }}
                    </div>
                </div>

                <!-- Fast Contact Actions -->
                <div class="flex items-center gap-3 pt-4 border-t border-slate-200 dark:border-slate-800">
                    <a href="mailto:{{ $inquiry->email }}?subject=رد: {{ urlencode($inquiry->subject ?: 'استفساركم لدى شركة أنماط الهندسية') }}" class="px-4 py-2 rounded-lg bg-blue-600 hover:bg-blue-700 text-slate-900 dark:text-white font-bold text-xs flex items-center gap-1.5">
                        <i class="fa-solid fa-reply"></i> {{ __('Reply via Email') }}
                    </a>

                    @if($inquiry->phone)
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $inquiry->phone) }}" target="_blank" class="px-4 py-2 rounded-lg bg-emerald-600 hover:bg-emerald-700 text-slate-900 dark:text-white font-bold text-xs flex items-center gap-1.5">
                            <i class="fa-brands fa-whatsapp"></i> {{ __('Contact via WhatsApp') }}
                        </a>
                    @endif
                </div>

            </div>

            <!-- Follow-up Status & Admin Notes -->
            <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl p-6 sm:p-8 shadow-sm">
                <h4 class="text-base font-bold text-slate-900 dark:text-white mb-4 flex items-center gap-2">
                    <i class="fa-solid fa-clipboard-user text-amber-400"></i>
                    <span>{{ __('Follow-up Management & Administrative Notes') }}</span>
                </h4>

                <form action="{{ route('admin.inquiries.update', $inquiry->id) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-bold text-slate-600 dark:text-slate-300 mb-1.5">{{ __('Update Inquiry Status') }}</label>
                            <select name="status" class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-300 dark:border-slate-700 rounded-lg px-3.5 py-2.5 text-slate-900 dark:text-white text-sm focus:border-amber-400 outline-none">
                                <option value="new" {{ $inquiry->status == 'new' ? 'selected' : '' }}>{{ __('New') }}</option>
                                <option value="contacted" {{ $inquiry->status == 'contacted' ? 'selected' : '' }}>{{ __('Contacted') }}</option>
                                <option value="in_progress" {{ $inquiry->status == 'in_progress' ? 'selected' : '' }}>{{ __('In Progress') }}</option>
                                <option value="closed" {{ $inquiry->status == 'closed' ? 'selected' : '' }}>{{ __('Closed') }}</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-600 dark:text-slate-300 mb-1.5">{{ __('Internal Administrative Notes') }}</label>
                        <textarea name="admin_notes" rows="3" placeholder="أضف ملاحظاتك حول الاتصال بالعميل أو تسعير المشروع..." class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-300 dark:border-slate-700 rounded-lg px-3.5 py-2.5 text-slate-900 dark:text-white text-sm focus:border-amber-400 outline-none">{{ old('admin_notes', $inquiry->admin_notes) }}</textarea>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="px-6 py-2 rounded-lg bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-slate-950 font-bold text-xs shadow-lg shadow-amber-500/20">
                            {{ __('Save Follow-up Notes') }}
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>

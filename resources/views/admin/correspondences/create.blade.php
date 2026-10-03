<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <h2 class="font-extrabold text-xl sm:text-2xl text-slate-900 dark:text-white tracking-tight flex items-center gap-3">
                <span class="p-2 rounded-lg bg-amber-500/20 text-amber-500">
                    <i class="fa-solid fa-file-circle-plus"></i>
                </span>
                <span>{{ __('Archive New Document / Letter') }}</span>
            </h2>
            <a href="{{ route('admin.correspondences.index') }}" class="w-fit inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-lg bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white text-xs font-bold border border-slate-300 dark:border-slate-700 transition">
                <i class="fa-solid {{ app()->getLocale() == 'ar' ? 'fa-arrow-right' : 'fa-arrow-left' }}"></i>
                <span>{{ __('Back to Archive') }}</span>
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

                <form action="{{ route('admin.correspondences.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <!-- Reference Number & Type Row -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 p-4 sm:p-5 rounded-xl bg-amber-50/50 dark:bg-slate-950/70 border border-amber-300/60 dark:border-amber-500/30">
                        <div>
                            <label class="block text-xs font-bold text-amber-800 dark:text-amber-400 uppercase tracking-wider mb-1.5">
                                {{ __('Official Reference Number') }} <span class="text-red-500 text-sm font-black">*</span>
                            </label>
                            <input type="text" name="reference_number" id="reference_number" value="{{ old('reference_number', $suggestedReference) }}" required class="w-full bg-white dark:bg-slate-900 border border-amber-400/60 dark:border-amber-500/50 rounded-lg px-3.5 py-2.5 text-amber-900 dark:text-amber-300 font-mono font-bold text-base focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 outline-none">
                            <span class="text-[11px] text-slate-500 dark:text-slate-400 mt-1 block">
                                {{ __('Automated serial reference code. You can modify it if needed.') }}
                            </span>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">
                                {{ __('Transaction Classification') }} <span class="text-red-500 text-sm font-black">*</span>
                            </label>
                            <select name="type" id="type_select" required class="w-full bg-white dark:bg-slate-900 border border-slate-300 dark:border-slate-700 rounded-lg px-3.5 py-2.5 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 outline-none" onchange="updatePrefix(this.value)">
                                <option value="outgoing" {{ old('type', $type) == 'outgoing' ? 'selected' : '' }}>{{ __('Outgoing Letter') }}</option>
                                <option value="incoming" {{ old('type', $type) == 'incoming' ? 'selected' : '' }}>{{ __('Incoming Letter') }}</option>
                                <option value="internal" {{ old('type', $type) == 'internal' ? 'selected' : '' }}>{{ __('Internal Memo') }}</option>
                                <option value="technical_report" {{ old('type', $type) == 'technical_report' ? 'selected' : '' }}>{{ __('Technical Report') }}</option>
                                <option value="contract_drawing" {{ old('type', $type) == 'contract_drawing' ? 'selected' : '' }}>{{ __('Contract & Drawings') }}</option>
                            </select>
                        </div>
                    </div>

                    <!-- Subject -->
                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">
                            {{ __('Document Subject') }} <span class="text-red-500 text-sm font-black">*</span>
                        </label>
                        <input type="text" name="subject" value="{{ old('subject') }}" required placeholder="{{ app()->getLocale() == 'ar' ? 'مثال: خطاب إحالة نتائج الرفع المساحي لمشروع...' : 'e.g. Survey results submission letter for project...' }}" class="w-full bg-white dark:bg-slate-950 border border-slate-300 dark:border-slate-700 rounded-lg px-3.5 py-2.5 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 outline-none">
                    </div>

                    <!-- Sender & Receiver -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">
                                {{ __('Issuing Party / Sender') }} <span class="text-red-500 text-sm font-black">*</span>
                            </label>
                            <input type="text" name="sender" value="{{ old('sender', app()->getLocale() == 'ar' ? 'أنماط للأعمال والاستشارات الهندسية' : 'ANMAT Engineering Works & Consultancy') }}" required class="w-full bg-white dark:bg-slate-950 border border-slate-300 dark:border-slate-700 rounded-lg px-3.5 py-2.5 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 outline-none">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">
                                {{ __('Addressed To / Recipient') }} <span class="text-red-500 text-sm font-black">*</span>
                            </label>
                            <input type="text" name="receiver" value="{{ old('receiver') }}" required placeholder="{{ app()->getLocale() == 'ar' ? 'مثال: مصلحة التخطيط العمراني / العميل...' : 'e.g. Urban Planning Authority / Client...' }}" class="w-full bg-white dark:bg-slate-950 border border-slate-300 dark:border-slate-700 rounded-lg px-3.5 py-2.5 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 outline-none">
                        </div>
                    </div>

                    <!-- Date, Priority, Status -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">
                                {{ __('Issue Date') }} <span class="text-red-500 text-sm font-black">*</span>
                            </label>
                            <input type="text" name="date_issued" value="{{ old('date_issued', date('Y-m-d')) }}" required class="flatpickr-date w-full bg-white dark:bg-slate-950 border border-slate-300 dark:border-slate-700 rounded-lg px-3.5 py-2.5 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 outline-none">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">
                                {{ __('Priority Level') }}
                            </label>
                            <select name="priority" class="w-full bg-white dark:bg-slate-950 border border-slate-300 dark:border-slate-700 rounded-lg px-3.5 py-2.5 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 outline-none">
                                <option value="normal" {{ old('priority') == 'normal' ? 'selected' : '' }}>{{ __('Normal') }}</option>
                                <option value="urgent" {{ old('priority') == 'urgent' ? 'selected' : '' }}>{{ __('Urgent') }}</option>
                                <option value="top_secret" {{ old('priority') == 'top_secret' ? 'selected' : '' }}>{{ __('Confidential') }}</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">
                                {{ __('Action Status') }}
                            </label>
                            <select name="status" class="w-full bg-white dark:bg-slate-950 border border-slate-300 dark:border-slate-700 rounded-lg px-3.5 py-2.5 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 outline-none">
                                <option value="pending_action" {{ old('status') == 'pending_action' ? 'selected' : '' }}>{{ __('Pending Action') }}</option>
                                <option value="closed" {{ old('status') == 'closed' ? 'selected' : '' }}>{{ __('Completed') }}</option>
                                <option value="archived" {{ old('status') == 'archived' ? 'selected' : '' }}>{{ __('Archived') }}</option>
                            </select>
                        </div>
                    </div>

                    <!-- Physical Archive Location & Tags -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">
                                {{ __('Physical Archive Reference') }}
                            </label>
                            <input type="text" name="physical_location" value="{{ old('physical_location') }}" placeholder="{{ app()->getLocale() == 'ar' ? 'مثال: خزانة ب - رف 2 - ملف 14' : 'e.g. Cabinet B - Shelf 2 - Folder 14' }}" class="w-full bg-white dark:bg-slate-950 border border-slate-300 dark:border-slate-700 rounded-lg px-3.5 py-2.5 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 outline-none">
                            <span class="text-[11px] text-slate-500 dark:text-slate-400 mt-1 block">{{ __('Cabinet, shelf, or folder tracking code.') }}</span>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">
                                {{ __('Keywords / Tags') }}
                            </label>
                            <input type="text" name="tags" value="{{ old('tags') }}" placeholder="{{ app()->getLocale() == 'ar' ? 'مثال: مساحة، بلدية، مقايسة، اعتماد' : 'e.g. Survey, Municipality, BOQ, Approval' }}" class="w-full bg-white dark:bg-slate-950 border border-slate-300 dark:border-slate-700 rounded-lg px-3.5 py-2.5 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 outline-none">
                        </div>
                    </div>

                    <!-- File Upload -->
                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">
                            {{ __('Attach Scanned Document or File') }}
                        </label>
                        <input type="file" name="document" class="w-full bg-white dark:bg-slate-950 border border-slate-300 dark:border-slate-700 rounded-lg p-2.5 text-slate-700 dark:text-slate-300 text-sm focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 outline-none file:mr-4 file:py-1.5 file:px-3.5 file:rounded-md file:border-0 file:text-xs file:font-bold file:bg-amber-500 file:text-slate-950 hover:file:bg-amber-600 transition">
                        <span class="text-[11px] text-slate-500 dark:text-slate-400 mt-1 block">{{ __('Max size: 20MB. Stored securely.') }}</span>
                    </div>

                    <!-- Notes -->
                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">
                            {{ __('Internal Notes & Remarks') }}
                        </label>
                        <textarea name="notes" rows="3" placeholder="{{ app()->getLocale() == 'ar' ? 'ملاحظات المتابعة أو توصيات الإدارة...' : 'Follow-up notes or management recommendations...' }}" class="w-full bg-white dark:bg-slate-950 border border-slate-300 dark:border-slate-700 rounded-lg px-3.5 py-2.5 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 outline-none">{{ old('notes') }}</textarea>
                    </div>

                    <!-- Submit / Cancel -->
                    <div class="pt-4 border-t border-slate-200 dark:border-slate-800 flex flex-col-reverse sm:flex-row sm:justify-end gap-3">
                        <a href="{{ route('admin.correspondences.index') }}" class="w-full sm:w-auto text-center px-5 py-2.5 rounded-lg bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white text-sm font-semibold border border-slate-300 dark:border-slate-700 transition">
                            {{ __('Cancel') }}
                        </a>
                        <button type="submit" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-2.5 rounded-lg bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-slate-950 font-bold text-sm shadow-md shadow-amber-500/20 transition">
                            <i class="fa-solid fa-save"></i>
                            <span>{{ __('Save & Archive Document') }}</span>
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>

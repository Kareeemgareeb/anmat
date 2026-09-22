<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-extrabold text-2xl text-white tracking-tight flex items-center gap-3">
                <span class="p-2 rounded-lg bg-amber-500/20 text-amber-400">
                    <i class="fa-solid fa-file-circle-plus"></i>
                </span>
                {{ __('Archive New Document / Letter') }} (تسجيل وتوثيق معاملة جديدة)
            </h2>
            <a href="{{ route('admin.correspondences.index') }}" class="px-3.5 py-1.5 rounded-lg bg-slate-800 text-slate-300 hover:text-white text-xs font-bold border border-slate-700">
                &larr; {{ __('Back to Archive') }}
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

                <form action="{{ route('admin.correspondences.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <!-- Reference Number & Type Row -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-5 rounded-xl bg-slate-950/70 border border-amber-500/30">
                        <div>
                            <label class="block text-xs font-bold text-amber-400 uppercase tracking-wider mb-1.5">
                                {{ __('Official Reference Number * (الرقم الإشاري المعتمد)') }}
                            </label>
                            <input type="text" name="reference_number" id="reference_number" value="{{ old('reference_number', $suggestedReference) }}" required class="w-full bg-slate-900 border border-amber-500/50 rounded-lg px-3.5 py-2.5 text-amber-300 font-mono font-bold text-base focus:border-amber-400 outline-none">
                            <span class="text-[11px] text-slate-400 mt-1 block">
                                {{ __('Automated serial reference code. You can modify it if needed.') }}
                            </span>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-300 mb-1.5">
                                {{ __('Transaction Classification * (تصنيف المعاملة)') }}
                            </label>
                            <select name="type" id="type_select" required class="w-full bg-slate-900 border border-slate-700 rounded-lg px-3.5 py-2.5 text-white text-sm focus:border-amber-400 outline-none" onchange="updatePrefix(this.value)">
                                <option value="outgoing" {{ old('type', $type) == 'outgoing' ? 'selected' : '' }}>{{ __('صادر رسمي (Outgoing Letter)') }}</option>
                                <option value="incoming" {{ old('type', $type) == 'incoming' ? 'selected' : '' }}>{{ __('وارد رسمي (Incoming Letter)') }}</option>
                                <option value="internal" {{ old('type', $type) == 'internal' ? 'selected' : '' }}>{{ __('مذكرة داخلية (Internal Memo)') }}</option>
                                <option value="technical_report" {{ old('type', $type) == 'technical_report' ? 'selected' : '' }}>{{ __('تقرير فني واستشاري (Technical Report)') }}</option>
                                <option value="contract_drawing" {{ old('type', $type) == 'contract_drawing' ? 'selected' : '' }}>{{ __('عقد ومخططات مساحية (Contract & Drawings)') }}</option>
                            </select>
                        </div>
                    </div>

                    <!-- Subject -->
                    <div>
                        <label class="block text-xs font-bold text-slate-300 mb-1.5">
                            {{ __('Document Subject * (موضوع الخطاب أو المعاملة)') }}
                        </label>
                        <input type="text" name="subject" value="{{ old('subject') }}" required placeholder="e.g. خطاب إحالة نتائج الرفع المساحي لمشروع..." class="w-full bg-slate-950 border border-slate-700 rounded-lg px-3.5 py-2.5 text-white text-sm focus:border-amber-400 outline-none">
                    </div>

                    <!-- Sender & Receiver -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-bold text-slate-300 mb-1.5">
                                {{ __('Issuing Party / Sender * (الجهة المصدرة / الراسل)') }}
                            </label>
                            <input type="text" name="sender" value="{{ old('sender', 'أنماط للأعمال والاستشارات الهندسية') }}" required class="w-full bg-slate-950 border border-slate-700 rounded-lg px-3.5 py-2.5 text-white text-sm focus:border-amber-400 outline-none">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-300 mb-1.5">
                                {{ __('Addressed To / Recipient * (الجهة الموجه إليها / المستلم)') }}
                            </label>
                            <input type="text" name="receiver" value="{{ old('receiver') }}" required placeholder="e.g. مصلحة التخطيط العمراني / العميل..." class="w-full bg-slate-950 border border-slate-700 rounded-lg px-3.5 py-2.5 text-white text-sm focus:border-amber-400 outline-none">
                        </div>
                    </div>

                    <!-- Date, Priority, Status -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-xs font-bold text-slate-300 mb-1.5">
                                {{ __('Issue Date * (تاريخ المعاملة)') }}
                            </label>
                            <input type="date" name="date_issued" value="{{ old('date_issued', date('Y-m-d')) }}" required class="w-full bg-slate-950 border border-slate-700 rounded-lg px-3.5 py-2.5 text-white text-sm focus:border-amber-400 outline-none">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-300 mb-1.5">
                                {{ __('Priority Level (درجة الأسبقية)') }}
                            </label>
                            <select name="priority" class="w-full bg-slate-950 border border-slate-700 rounded-lg px-3.5 py-2.5 text-white text-sm focus:border-amber-400 outline-none">
                                <option value="normal" {{ old('priority') == 'normal' ? 'selected' : '' }}>{{ __('عادي (Normal)') }}</option>
                                <option value="urgent" {{ old('priority') == 'urgent' ? 'selected' : '' }}>{{ __('عاجل (Urgent)') }}</option>
                                <option value="top_secret" {{ old('priority') == 'top_secret' ? 'selected' : '' }}>{{ __('سري وعاجل (Confidential)') }}</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-300 mb-1.5">
                                {{ __('Action Status (حالة المعاملة)') }}
                            </label>
                            <select name="status" class="w-full bg-slate-950 border border-slate-700 rounded-lg px-3.5 py-2.5 text-white text-sm focus:border-amber-400 outline-none">
                                <option value="pending_action" {{ old('status') == 'pending_action' ? 'selected' : '' }}>{{ __('قيد المتابعة والإجراء') }}</option>
                                <option value="closed" {{ old('status') == 'closed' ? 'selected' : '' }}>{{ __('مكتمل ومعتمد') }}</option>
                                <option value="archived" {{ old('status') == 'archived' ? 'selected' : '' }}>{{ __('مؤرشف نهائياً') }}</option>
                            </select>
                        </div>
                    </div>

                    <!-- Physical Archive Location & Tags -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-bold text-amber-300 mb-1.5">
                                {{ __('Physical Archive Reference (موقع الحفظ بالأرشيف الورقي)') }}
                            </label>
                            <input type="text" name="physical_location" value="{{ old('physical_location') }}" placeholder="مثال: خزانة ب - رف 2 - ملف 14" class="w-full bg-slate-950 border border-slate-700 rounded-lg px-3.5 py-2.5 text-white text-sm focus:border-amber-400 outline-none">
                            <span class="text-[11px] text-slate-400 mt-1 block">{{ __('Cabinet, shelf, or folder tracking code.') }}</span>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-300 mb-1.5">
                                {{ __('Keywords / Tags (الكلمات الدلالية للبحث)') }}
                            </label>
                            <input type="text" name="tags" value="{{ old('tags') }}" placeholder="e.g. مساحة, بلدية, مقايسة, اعتماد" class="w-full bg-slate-950 border border-slate-700 rounded-lg px-3.5 py-2.5 text-white text-sm focus:border-amber-400 outline-none">
                        </div>
                    </div>

                    <!-- File Upload -->
                    <div>
                        <label class="block text-xs font-bold text-slate-300 mb-1.5">
                            {{ __('Attach Scanned Document or File (الملف المرفق - PDF, CAD, Docx, Image)') }}
                        </label>
                        <input type="file" name="document" class="w-full bg-slate-950 border border-slate-700 rounded-lg p-2.5 text-slate-300 text-sm focus:border-amber-400 outline-none file:mr-4 file:py-1.5 file:px-3.5 file:rounded-md file:border-0 file:text-xs file:font-bold file:bg-amber-500 file:text-black hover:file:bg-amber-600">
                        <span class="text-[11px] text-slate-400 mt-1 block">{{ __('Max size: 20MB. Stored securely.') }}</span>
                    </div>

                    <!-- Notes -->
                    <div>
                        <label class="block text-xs font-bold text-slate-300 mb-1.5">
                            {{ __('Internal Notes & Remarks (ملاحظات وتأشيرات المتابعة)') }}
                        </label>
                        <textarea name="notes" rows="3" placeholder="ملاحظات المتابعة أو توصيات الإدارة..." class="w-full bg-slate-950 border border-slate-700 rounded-lg px-3.5 py-2.5 text-white text-sm focus:border-amber-400 outline-none">{{ old('notes') }}</textarea>
                    </div>

                    <!-- Submit -->
                    <div class="pt-4 border-t border-slate-800 flex justify-end gap-3">
                        <a href="{{ route('admin.correspondences.index') }}" class="px-5 py-2.5 rounded-lg bg-slate-800 text-slate-300 hover:text-white text-sm font-semibold">
                            {{ __('Cancel') }}
                        </a>
                        <button type="submit" class="px-6 py-2.5 rounded-lg bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-slate-950 font-bold text-sm shadow-lg shadow-amber-500/20">
                            <i class="fa-solid fa-save me-1.5"></i>
                            {{ __('Save & Archive Document') }}
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>

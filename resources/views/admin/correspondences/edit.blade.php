<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-extrabold text-2xl text-white tracking-tight flex items-center gap-3">
                <span class="p-2 rounded-lg bg-amber-500/20 text-amber-400">
                    <i class="fa-solid fa-pen-to-square"></i>
                </span>
                {{ __('Edit Archived Document') }}: <span class="font-mono text-amber-400">{{ $correspondence->reference_number }}</span>
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

                <form action="{{ route('admin.correspondences.update', $correspondence->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Reference Number & Type Row -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-5 rounded-xl bg-slate-950/70 border border-amber-500/30">
                        <div>
                            <label class="block text-xs font-bold text-amber-400 uppercase tracking-wider mb-1.5">
                                {{ __('Official Reference Number *') }}
                            </label>
                            <input type="text" name="reference_number" value="{{ old('reference_number', $correspondence->reference_number) }}" required class="w-full bg-slate-900 border border-amber-500/50 rounded-lg px-3.5 py-2.5 text-amber-300 font-mono font-bold text-base focus:border-amber-400 outline-none">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-300 mb-1.5">
                                {{ __('Transaction Classification *') }}
                            </label>
                            <select name="type" required class="w-full bg-slate-900 border border-slate-700 rounded-lg px-3.5 py-2.5 text-white text-sm focus:border-amber-400 outline-none">
                                <option value="outgoing" {{ old('type', $correspondence->type) == 'outgoing' ? 'selected' : '' }}>{{ __('صادر رسمي (Outgoing Letter)') }}</option>
                                <option value="incoming" {{ old('type', $correspondence->type) == 'incoming' ? 'selected' : '' }}>{{ __('وارد رسمي (Incoming Letter)') }}</option>
                                <option value="internal" {{ old('type', $correspondence->type) == 'internal' ? 'selected' : '' }}>{{ __('مذكرة داخلية (Internal Memo)') }}</option>
                                <option value="technical_report" {{ old('type', $correspondence->type) == 'technical_report' ? 'selected' : '' }}>{{ __('تقرير فني واستشاري (Technical Report)') }}</option>
                                <option value="contract_drawing" {{ old('type', $correspondence->type) == 'contract_drawing' ? 'selected' : '' }}>{{ __('عقد ومخططات مساحية (Contract & Drawings)') }}</option>
                            </select>
                        </div>
                    </div>

                    <!-- Subject -->
                    <div>
                        <label class="block text-xs font-bold text-slate-300 mb-1.5">
                            {{ __('Document Subject *') }}
                        </label>
                        <input type="text" name="subject" value="{{ old('subject', $correspondence->subject) }}" required class="w-full bg-slate-950 border border-slate-700 rounded-lg px-3.5 py-2.5 text-white text-sm focus:border-amber-400 outline-none">
                    </div>

                    <!-- Sender & Receiver -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-bold text-slate-300 mb-1.5">
                                {{ __('Issuing Party / Sender *') }}
                            </label>
                            <input type="text" name="sender" value="{{ old('sender', $correspondence->sender) }}" required class="w-full bg-slate-950 border border-slate-700 rounded-lg px-3.5 py-2.5 text-white text-sm focus:border-amber-400 outline-none">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-300 mb-1.5">
                                {{ __('Addressed To / Recipient *') }}
                            </label>
                            <input type="text" name="receiver" value="{{ old('receiver', $correspondence->receiver) }}" required class="w-full bg-slate-950 border border-slate-700 rounded-lg px-3.5 py-2.5 text-white text-sm focus:border-amber-400 outline-none">
                        </div>
                    </div>

                    <!-- Date, Priority, Status -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-xs font-bold text-slate-300 mb-1.5">
                                {{ __('Issue Date *') }}
                            </label>
                            <input type="date" name="date_issued" value="{{ old('date_issued', $correspondence->date_issued ? $correspondence->date_issued->format('Y-m-d') : '') }}" required class="w-full bg-slate-950 border border-slate-700 rounded-lg px-3.5 py-2.5 text-white text-sm focus:border-amber-400 outline-none">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-300 mb-1.5">
                                {{ __('Priority Level') }}
                            </label>
                            <select name="priority" class="w-full bg-slate-950 border border-slate-700 rounded-lg px-3.5 py-2.5 text-white text-sm focus:border-amber-400 outline-none">
                                <option value="normal" {{ old('priority', $correspondence->priority) == 'normal' ? 'selected' : '' }}>{{ __('عادي (Normal)') }}</option>
                                <option value="urgent" {{ old('priority', $correspondence->priority) == 'urgent' ? 'selected' : '' }}>{{ __('عاجل (Urgent)') }}</option>
                                <option value="top_secret" {{ old('priority', $correspondence->priority) == 'top_secret' ? 'selected' : '' }}>{{ __('سري وعاجل (Confidential)') }}</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-300 mb-1.5">
                                {{ __('Action Status') }}
                            </label>
                            <select name="status" class="w-full bg-slate-950 border border-slate-700 rounded-lg px-3.5 py-2.5 text-white text-sm focus:border-amber-400 outline-none">
                                <option value="pending_action" {{ old('status', $correspondence->status) == 'pending_action' ? 'selected' : '' }}>{{ __('قيد المتابعة والإجراء') }}</option>
                                <option value="closed" {{ old('status', $correspondence->status) == 'closed' ? 'selected' : '' }}>{{ __('مكتمل ومعتمد') }}</option>
                                <option value="archived" {{ old('status', $correspondence->status) == 'archived' ? 'selected' : '' }}>{{ __('مؤرشف نهائياً') }}</option>
                            </select>
                        </div>
                    </div>

                    <!-- Physical Archive Location & Tags -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-bold text-amber-300 mb-1.5">
                                {{ __('Physical Archive Reference') }}
                            </label>
                            <input type="text" name="physical_location" value="{{ old('physical_location', $correspondence->physical_location) }}" class="w-full bg-slate-950 border border-slate-700 rounded-lg px-3.5 py-2.5 text-white text-sm focus:border-amber-400 outline-none">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-300 mb-1.5">
                                {{ __('Keywords / Tags') }}
                            </label>
                            <input type="text" name="tags" value="{{ old('tags', $correspondence->tags) }}" class="w-full bg-slate-950 border border-slate-700 rounded-lg px-3.5 py-2.5 text-white text-sm focus:border-amber-400 outline-none">
                        </div>
                    </div>

                    <!-- File Upload -->
                    <div>
                        <label class="block text-xs font-bold text-slate-300 mb-1.5">
                            {{ __('Replace Attached File (Optional)') }}
                        </label>
                        @if($correspondence->file_path)
                            <div class="mb-2 p-2.5 rounded bg-slate-950 border border-slate-800 flex items-center justify-between text-xs">
                                <span class="text-slate-300"><i class="fa-solid fa-paperclip text-amber-400 me-2"></i>{{ $correspondence->file_name ?: basename($correspondence->file_path) }} ({{ $correspondence->formatted_file_size }})</span>
                                <a href="{{ route('admin.correspondences.download', $correspondence->id) }}" class="text-emerald-400 font-bold hover:underline">{{ __('Download Current') }}</a>
                            </div>
                        @endif
                        <input type="file" name="document" class="w-full bg-slate-950 border border-slate-700 rounded-lg p-2.5 text-slate-300 text-sm focus:border-amber-400 outline-none file:mr-4 file:py-1.5 file:px-3.5 file:rounded-md file:border-0 file:text-xs file:font-bold file:bg-amber-500 file:text-black hover:file:bg-amber-600">
                    </div>

                    <!-- Notes -->
                    <div>
                        <label class="block text-xs font-bold text-slate-300 mb-1.5">
                            {{ __('Internal Notes & Remarks') }}
                        </label>
                        <textarea name="notes" rows="3" class="w-full bg-slate-950 border border-slate-700 rounded-lg px-3.5 py-2.5 text-white text-sm focus:border-amber-400 outline-none">{{ old('notes', $correspondence->notes) }}</textarea>
                    </div>

                    <!-- Submit -->
                    <div class="pt-4 border-t border-slate-800 flex justify-end gap-3">
                        <a href="{{ route('admin.correspondences.index') }}" class="px-5 py-2.5 rounded-lg bg-slate-800 text-slate-300 hover:text-white text-sm font-semibold">
                            {{ __('Cancel') }}
                        </a>
                        <button type="submit" class="px-6 py-2.5 rounded-lg bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-slate-950 font-bold text-sm shadow-lg shadow-amber-500/20">
                            <i class="fa-solid fa-save me-1.5"></i>
                            {{ __('Update Archive Entry') }}
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>

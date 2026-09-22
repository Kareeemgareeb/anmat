<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-extrabold text-2xl text-white tracking-tight flex items-center gap-3">
                <span class="p-2 rounded-lg bg-amber-500/20 text-amber-400">
                    <i class="fa-solid fa-stamp"></i>
                </span>
                {{ __('Official Tracking Slip') }}: <span class="font-mono text-amber-400">{{ $correspondence->reference_number }}</span>
            </h2>
            <div class="flex items-center gap-2">
                <button onclick="window.print()" class="px-3.5 py-1.5 rounded-lg bg-slate-800 text-slate-200 hover:text-white text-xs font-bold border border-slate-700 flex items-center gap-1.5">
                    <i class="fa-solid fa-print"></i> {{ __('Print Slip') }}
                </button>
                <a href="{{ route('admin.correspondences.index') }}" class="px-3.5 py-1.5 rounded-lg bg-slate-800 text-slate-300 hover:text-white text-xs font-bold border border-slate-700">
                    &larr; {{ __('Back') }}
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Printable Certificate Box -->
            <div class="bg-white text-slate-900 rounded-2xl p-8 sm:p-10 shadow-2xl border-4 border-double border-slate-300 relative overflow-hidden">
                
                <!-- Watermark Logo -->
                <div class="absolute inset-0 flex items-center justify-center opacity-5 pointer-events-none">
                    <img src="{{ asset('images/logo-dark.png') }}" class="w-96">
                </div>

                <!-- Slip Header -->
                <div class="flex items-center justify-between border-b-2 border-slate-800 pb-6 mb-8">
                    <div class="flex items-center gap-4">
                        <img src="{{ asset('images/logo-light.jpg') }}" alt="ANMAT" class="h-16 w-auto">
                        <div>
                            <h3 class="font-black text-xl text-slate-900">أنماط للأعمال والاستشارات الهندسية</h3>
                            <p class="text-xs text-slate-600 font-semibold uppercase tracking-wider">ANMAT Engineering Works & Consultancy</p>
                            <span class="text-[11px] text-amber-700 font-bold">منظومة الحفظ والأرشفة الإلكترونية المعتمدة</span>
                        </div>
                    </div>

                    <div class="text-end">
                        <span class="text-xs font-bold text-slate-500 uppercase block">بطاقة تعريف المعاملة الإشارية</span>
                        <div class="text-lg font-mono font-black text-amber-700 mt-0.5">{{ $correspondence->reference_number }}</div>
                        <div class="text-xs text-slate-500 mt-1">{{ $correspondence->date_issued->format('d/m/Y') }}</div>
                    </div>
                </div>

                <!-- Document Details Grid -->
                <div class="grid grid-cols-2 gap-y-5 gap-x-8 text-sm mb-8">
                    <div class="border-b border-slate-200 pb-2">
                        <span class="text-xs font-bold text-slate-500 block mb-0.5">تصنيف الوثيقة</span>
                        <span class="font-bold text-slate-800">{{ $correspondence->type_label }}</span>
                    </div>

                    <div class="border-b border-slate-200 pb-2">
                        <span class="text-xs font-bold text-slate-500 block mb-0.5">درجة الأسبقية والسرية</span>
                        <span class="font-bold text-slate-800">{{ $correspondence->priority_label }}</span>
                    </div>

                    <div class="col-span-2 border-b border-slate-200 pb-2">
                        <span class="text-xs font-bold text-slate-500 block mb-0.5">موضوع الخطاب / المعاملة</span>
                        <span class="font-bold text-base text-slate-950">{{ $correspondence->subject }}</span>
                    </div>

                    <div class="border-b border-slate-200 pb-2">
                        <span class="text-xs font-bold text-slate-500 block mb-0.5">الجهة المصدرة / الراسل</span>
                        <span class="font-semibold text-slate-800">{{ $correspondence->sender }}</span>
                    </div>

                    <div class="border-b border-slate-200 pb-2">
                        <span class="text-xs font-bold text-slate-500 block mb-0.5">الجهة الموجه إليها / المستلم</span>
                        <span class="font-semibold text-slate-800">{{ $correspondence->receiver }}</span>
                    </div>

                    <div class="border-b border-slate-200 pb-2">
                        <span class="text-xs font-bold text-slate-500 block mb-0.5">كود الحفظ بالأرشيف الورقي</span>
                        <span class="font-mono font-bold text-amber-800">{{ $correspondence->physical_location ?: 'غير محدد' }}</span>
                    </div>

                    <div class="border-b border-slate-200 pb-2">
                        <span class="text-xs font-bold text-slate-500 block mb-0.5">حالة المتابعة</span>
                        <span class="font-bold text-slate-800">{{ $correspondence->status_label }}</span>
                    </div>

                    @if($correspondence->tags)
                        <div class="col-span-2 border-b border-slate-200 pb-2">
                            <span class="text-xs font-bold text-slate-500 block mb-0.5">الكلمات المفتاحية</span>
                            <span class="text-slate-700 text-xs">{{ $correspondence->tags }}</span>
                        </div>
                    @endif
                </div>

                @if($correspondence->notes)
                    <div class="bg-slate-50 border border-slate-200 rounded-lg p-4 mb-8">
                        <span class="text-xs font-bold text-slate-700 block mb-1">ملاحظات وتأشيرات المتابعة الإدارية:</span>
                        <p class="text-xs text-slate-600 leading-relaxed">{{ $correspondence->notes }}</p>
                    </div>
                @endif

                <!-- Attachment & Quick Verification Footer -->
                <div class="flex items-center justify-between pt-6 border-t-2 border-slate-800 text-xs">
                    <div>
                        @if($correspondence->file_path)
                            <div class="flex items-center gap-2">
                                <span class="font-bold text-slate-700">الملف المرفق:</span>
                                <a href="{{ route('admin.correspondences.download', $correspondence->id) }}" class="text-blue-600 font-bold hover:underline flex items-center gap-1">
                                    <i class="fa-solid fa-paperclip"></i>
                                    {{ $correspondence->file_name ?: basename($correspondence->file_path) }} ({{ $correspondence->formatted_file_size }})
                                </a>
                            </div>
                        @else
                            <span class="text-slate-400">لا يوجد ملف رقمي مرفق</span>
                        @endif
                    </div>

                    <div class="text-end text-[11px] text-slate-500">
                        <span>رابط التحقق العام: anmat.ly/verify-document?ref={{ $correspondence->reference_number }}</span>
                    </div>
                </div>
            </div>

            <!-- Bottom Actions -->
            <div class="mt-6 flex justify-end gap-3">
                <a href="{{ route('admin.correspondences.edit', $correspondence->id) }}" class="px-5 py-2 rounded-lg bg-blue-600 hover:bg-blue-700 text-white font-bold text-sm">
                    <i class="fa-solid fa-pen me-1.5"></i> {{ __('Edit Document Metadata') }}
                </a>
            </div>
        </div>
    </div>
</x-app-layout>

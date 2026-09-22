@extends('pages.layout')

@section('title', app()->getLocale() == 'ar' ? 'التحقق من صحة الوثائق والمراسلات | أنماط الهندسية' : 'Document Verification | ANMAT')

@section('content')
<!-- Page Header -->
<section style="padding:4.5rem 0 3rem; background:var(--bg-secondary); border-bottom:1px solid var(--border-subtle); text-align:center;">
    <div class="container">
        <span class="section-tag">{{ app()->getLocale() == 'ar' ? 'نظام الحوكمة والتوثيق' : 'Document Authentication' }}</span>
        <h1 style="font-size:2.75rem; font-weight:900; margin-bottom:1rem; color:var(--text-primary);">
            {{ app()->getLocale() == 'ar' ? 'التحقق من صحة الوثائق والخطابات الرسمية' : 'Official Document Verification' }}
        </h1>
        <p style="color:var(--text-secondary); max-width:680px; margin:0 auto; font-size:1.1rem; line-height:1.7;">
            {{ app()->getLocale() == 'ar'
                ? 'تحقق فورياً من أصالة وموثوقية أي كتاب رسمي، تقرير فني، أو محضر مساحي صادر عن شركة أنماط للأعمال والاستشارات الهندسية عبر إدخال الرقم المرجعي.'
                : 'Instantly verify the authenticity of any official letter, survey booklet, or technical report issued by ANMAT by entering its unique reference code.' }}
        </p>

        <!-- Search Input -->
        <form action="{{ route('verify.document') }}" method="GET" class="verify-input-group" style="margin-top:2rem;">
            <input type="text" name="ref" value="{{ $ref ?? '' }}" placeholder="{{ app()->getLocale() == 'ar' ? 'أدخل الرقم المرجعي (مثال: ANMAT-OUT-2026-0001)' : 'Enter Reference Code (e.g. ANMAT-OUT-2026-0001)' }}" class="verify-input" required>
            <button type="submit" class="btn-gold" style="white-space:nowrap;">
                <i class="fa-solid fa-magnifying-glass"></i>
                <span>{{ app()->getLocale() == 'ar' ? 'تحقق الآن' : 'Verify' }}</span>
            </button>
        </form>
    </div>
</section>

<!-- Result Section -->
<section class="section">
    <div class="container" style="max-width:850px;">
        @if($ref)
            @if($document)
                <!-- Verified Card -->
                <div style="background:var(--bg-card); border:2px solid rgba(16,185,129,0.5); border-radius:var(--radius-lg); padding:3rem; box-shadow:0 15px 35px rgba(0,0,0,0.4); position:relative; overflow:hidden;">
                    <div style="position:absolute; top:0; left:0; right:0; height:4px; background:linear-gradient(90deg, #10B981, #34D399);"></div>

                    <!-- Verified Header -->
                    <div style="display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:1rem; margin-bottom:2rem; padding-bottom:1.5rem; border-bottom:1px solid var(--border-subtle);">
                        <div style="display:flex; align-items:center; gap:1rem;">
                            <div style="width:56px; height:56px; border-radius:50%; background:rgba(16,185,129,0.2); color:#10B981; display:flex; align-items:center; justify-content:center; font-size:1.8rem;">
                                <i class="fa-solid fa-certificate"></i>
                            </div>
                            <div>
                                <span style="font-size:0.8rem; font-weight:700; color:#10B981; text-transform:uppercase;">
                                    <i class="fa-solid fa-check-double"></i> {{ app()->getLocale() == 'ar' ? 'وثيقة أصلية ومعتمدة في السجل الرسمي' : 'Authentic Certified Document in Official Registry' }}
                                </span>
                                <h2 style="font-size:1.6rem; font-weight:800; color:var(--text-primary); margin-top:0.25rem;">
                                    {{ $document->reference_number }}
                                </h2>
                            </div>
                        </div>

                        <div>
                            <span class="project-badge-status badge-completed" style="font-size:0.85rem; padding:0.45rem 1rem;">
                                {{ $document->status_label }}
                            </span>
                        </div>
                    </div>

                    <!-- Details Table -->
                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:1.5rem; margin-bottom:2rem;">
                        <div>
                            <span style="font-size:0.75rem; color:var(--text-muted); text-transform:uppercase; display:block;">{{ app()->getLocale() == 'ar' ? 'نوع الوثيقة / المعاملة' : 'Transaction Type' }}</span>
                            <strong style="color:var(--gold-light); font-size:1.05rem;">{{ $document->type_label }}</strong>
                        </div>

                        <div>
                            <span style="font-size:0.75rem; color:var(--text-muted); text-transform:uppercase; display:block;">{{ app()->getLocale() == 'ar' ? 'تاريخ الإصدار' : 'Issue Date' }}</span>
                            <strong style="color:var(--silver-light); font-size:1.05rem;">{{ $document->date_issued->format('Y-m-d') }}</strong>
                        </div>

                        <div style="grid-column:1 / -1;">
                            <span style="font-size:0.75rem; color:var(--text-muted); text-transform:uppercase; display:block;">{{ app()->getLocale() == 'ar' ? 'الموضوع الرئيسي' : 'Subject' }}</span>
                            <p style="color:var(--text-primary); font-size:1.1rem; font-weight:700; margin-top:0.25rem;">{{ $document->subject }}</p>
                        </div>

                        <div>
                            <span style="font-size:0.75rem; color:var(--text-muted); text-transform:uppercase; display:block;">{{ app()->getLocale() == 'ar' ? 'الجهة الصادرة / المرسلة' : 'Issuing Party' }}</span>
                            <strong style="color:var(--silver-mid);">{{ $document->sender }}</strong>
                        </div>

                        <div>
                            <span style="font-size:0.75rem; color:var(--text-muted); text-transform:uppercase; display:block;">{{ app()->getLocale() == 'ar' ? 'الجهة المستلمة' : 'Recipient' }}</span>
                            <strong style="color:var(--silver-mid);">{{ $document->receiver }}</strong>
                        </div>

                        @if($document->priority)
                            <div>
                                <span style="font-size:0.75rem; color:var(--text-muted); text-transform:uppercase; display:block;">{{ app()->getLocale() == 'ar' ? 'درجة الأسبقية' : 'Priority' }}</span>
                                <strong style="color:var(--silver-mid);">{{ $document->priority_label }}</strong>
                            </div>
                        @endif

                        @if($document->physical_location)
                            <div>
                                <span style="font-size:0.75rem; color:var(--text-muted); text-transform:uppercase; display:block;">{{ app()->getLocale() == 'ar' ? 'كود الحفظ بالأرشيف الورقي' : 'Physical Archive Code' }}</span>
                                <strong style="color:var(--silver-mid);">{{ $document->physical_location }}</strong>
                            </div>
                        @endif
                    </div>

                    @if($document->notes)
                        <div style="background:rgba(8,13,21,0.6); border:1px solid var(--border-subtle); border-radius:var(--radius-sm); padding:1.25rem; margin-bottom:1.5rem;">
                            <span style="font-size:0.75rem; color:var(--gold-light); font-weight:700; display:block; margin-bottom:0.25rem;">
                                {{ app()->getLocale() == 'ar' ? 'ملاحظات وتأشيرات المتابعة:' : 'Registry Annotations:' }}
                            </span>
                            <p style="color:var(--text-secondary); font-size:0.9rem; line-height:1.6;">{{ $document->notes }}</p>
                        </div>
                    @endif

                    <div style="border-top:1px solid var(--border-subtle); padding-top:1.5rem; display:flex; justify-content:space-between; align-items:center; font-size:0.85rem; color:var(--text-muted);">
                        <span><i class="fa-solid fa-lock" style="color:var(--gold-light); margin-inline-end:6px;"></i>{{ app()->getLocale() == 'ar' ? 'سجل رقمي مؤمن برمز التحقق' : 'Secured Reference Archive' }}</span>
                        <button onclick="window.print()" class="btn-outline" style="padding:0.4rem 0.9rem; font-size:0.82rem;">
                            <i class="fa-solid fa-print"></i> {{ app()->getLocale() == 'ar' ? 'طباعة إفادة التحقق' : 'Print Certificate' }}
                        </button>
                    </div>
                </div>
            @else
                <!-- Not Found Card -->
                <div style="background:var(--bg-card); border:2px solid rgba(239,68,68,0.4); border-radius:var(--radius-lg); padding:3rem; text-align:center;">
                    <div style="width:64px; height:64px; border-radius:50%; background:rgba(239,68,68,0.15); color:#EF4444; display:flex; align-items:center; justify-content:center; font-size:2rem; margin:0 auto 1.5rem;">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                    </div>
                    <h3 style="font-size:1.6rem; font-weight:800; color:var(--text-primary); margin-bottom:0.75rem;">
                        {{ app()->getLocale() == 'ar' ? 'لم يتم العثور على وثيقة بهذا الرقم المرجعي' : 'No Document Found with This Reference Code' }}
                    </h3>
                    <p style="color:var(--text-secondary); max-width:550px; margin:0 auto 1.75rem; font-size:0.95rem; line-height:1.7;">
                        {{ app()->getLocale() == 'ar'
                            ? 'يرجى التأكد من كتابة الرقم المرجعي بالصيغة الصحيحة المطبوعة أعلى الخطاب الرسمي (مثال: ANMAT-OUT-2026-0001)، أو التواصل مع أمانة السر بالمكتب الهندسي.'
                            : 'Please verify the reference code format printed atop the official letterhead (e.g. ANMAT-OUT-2026-0001), or contact our executive secretariat.' }}
                    </p>
                    <a href="{{ route('contact') }}" class="btn-gold">
                        <i class="fa-solid fa-headset"></i>
                        <span>{{ app()->getLocale() == 'ar' ? 'مراجعة أمانة السر والمكتب' : 'Contact Office Registry' }}</span>
                    </a>
                </div>
            @endif
        @else
            <!-- Helper Instructions -->
            <div style="background:var(--bg-card); border:1px solid var(--border-subtle); border-radius:var(--radius-lg); padding:2.5rem;">
                <h3 style="font-size:1.4rem; font-weight:800; color:var(--text-primary); margin-bottom:1rem; display:flex; align-items:center; gap:0.6rem;">
                    <i class="fa-solid fa-circle-info" style="color:var(--gold-light);"></i>
                    <span>{{ app()->getLocale() == 'ar' ? 'كيف يعمل نظام التحقق من الوثائق؟' : 'How Document Verification Works' }}</span>
                </h3>
                <ul style="color:var(--text-secondary); line-height:1.9; font-size:0.95rem; margin-inline-start:1.5rem; margin-bottom:1.5rem;">
                    <li>{{ app()->getLocale() == 'ar' ? 'جميع الكتب الرسمية والتقارير الفنية الصادرة والواردة تحمل رقماً مرجعياً فريداً أعلى الترويسة.' : 'All letters and technical reports bear a unique alphanumeric reference at the top of the letterhead.' }}</li>
                    <li>{{ app()->getLocale() == 'ar' ? 'صيغة الصادر: ANMAT-OUT-YYYY-XXXX (كتب وتقارير صادرة للجهات الخارجية).' : 'Outgoing letters format: ANMAT-OUT-YYYY-XXXX.' }}</li>
                    <li>{{ app()->getLocale() == 'ar' ? 'صيغة الوارد: ANMAT-IN-YYYY-XXXX (كتب ومعاملات مستلمة من الوزارات والشركات).' : 'Incoming documents format: ANMAT-IN-YYYY-XXXX.' }}</li>
                    <li>{{ app()->getLocale() == 'ar' ? 'صيغة المذكرات الداخلية والتقارير: ANMAT-INT أو ANMAT-REP.' : 'Internal memos and technical reports format: ANMAT-INT or ANMAT-REP.' }}</li>
                </ul>
                <div style="background:rgba(198,146,62,0.1); border-radius:var(--radius-sm); padding:1rem; font-size:0.88rem; color:var(--silver-light);">
                    <i class="fa-solid fa-lightbulb" style="color:var(--gold-light); margin-inline-end:6px;"></i>
                    {{ app()->getLocale() == 'ar' ? 'مثال تجريبي: جرب إدخال الرقم ' : 'Demo Example: Try entering code ' }}
                    <strong style="color:var(--gold-light); font-family:var(--font-en);">ANMAT-OUT-2026-0001</strong>
                </div>
            </div>
        @endif
    </div>
</section>
@endsection

@extends('pages.layout')

@section('title', app()->getLocale() == 'ar' ? 'اتصل بنا | أنماط للأعمال والاستشارات الهندسية' : 'Contact Us | ANMAT')

@section('content')
<!-- Page Header -->
<section style="padding:4.5rem 0 3rem; background:var(--bg-secondary); border-bottom:1px solid var(--border-subtle); text-align:center;">
    <div class="container">
        <span class="section-tag">{{ app()->getLocale() == 'ar' ? 'قنوات التواصل' : 'Get In Touch' }}</span>
        <h1 style="font-size:2.75rem; font-weight:900; margin-bottom:1rem; color:var(--text-primary);">
            {{ app()->getLocale() == 'ar' ? 'تواصل مع فريقنا الهندسي' : 'Contact Our Engineering Office' }}
        </h1>
        <p style="color:var(--text-secondary); max-width:680px; margin:0 auto; font-size:1.1rem; line-height:1.7;">
            {{ app()->getLocale() == 'ar'
                ? 'يسرنا استقبال استفساراتكم ومناقشة متطلبات مشاريعكم الهندسية والمساحية في أي وقت.'
                : 'We welcome your project inquiries and look forward to discussing your engineering and surveying requirements.' }}
        </p>
    </div>
</section>

<!-- Contact Content -->
<section class="section">
    <div class="container">
        @if(session('success'))
            <div style="background:rgba(16,185,129,0.15); border:1px solid rgba(16,185,129,0.4); color:#34D399; padding:1.25rem 1.75rem; border-radius:var(--radius-sm); margin-bottom:2.5rem; display:flex; align-items:center; gap:0.75rem;">
                <i class="fa-solid fa-circle-check" style="font-size:1.5rem;"></i>
                <div style="font-size:1rem; font-weight:600;">{{ session('success') }}</div>
            </div>
        @endif

        <div class="contact-grid">
            <!-- Contact Info -->
            <div class="contact-info-card">
                <span class="section-tag">{{ app()->getLocale() == 'ar' ? 'بيانات المكتب' : 'Office Details' }}</span>
                <h3 style="font-size:1.8rem; font-weight:800; margin-bottom:2rem; color:var(--text-primary);">
                    {{ app()->getLocale() == 'ar' ? 'المقر الرئيسي وخدمة العملاء' : 'Headquarters & Client Support' }}
                </h3>

                <div class="contact-method-item">
                    <div class="contact-method-icon">
                        <i class="fa-solid fa-location-dot"></i>
                    </div>
                    <div>
                        <h4 style="font-size:1.05rem; font-weight:700; color:var(--text-primary); margin-bottom:0.25rem;">
                            {{ app()->getLocale() == 'ar' ? 'العنوان والمقر' : 'Headquarters Location' }}
                        </h4>
                        <p style="color:var(--text-secondary); font-size:0.95rem;">
                            {{ \App\Models\Setting::getLocalized('address', null, 'طرابلس - حي الأندلس، ليبيا') }}
                        </p>
                    </div>
                </div>

                <div class="contact-method-item">
                    <div class="contact-method-icon">
                        <i class="fa-solid fa-phone"></i>
                    </div>
                    <div>
                        <h4 style="font-size:1.05rem; font-weight:700; color:var(--text-primary); margin-bottom:0.25rem;">
                            {{ app()->getLocale() == 'ar' ? 'الهاتف المباشر' : 'Direct Phone' }}
                        </h4>
                        <p style="color:var(--silver-light); font-size:0.95rem; font-weight:600;" dir="ltr">
                            {{ \App\Models\Setting::get('phone', '+218 91 000 0000') }}
                        </p>
                        @if($sec = \App\Models\Setting::get('phone_secondary'))
                            <p style="color:var(--text-muted); font-size:0.85rem;" dir="ltr">{{ $sec }}</p>
                        @endif
                    </div>
                </div>

                <div class="contact-method-item">
                    <div class="contact-method-icon">
                        <i class="fa-solid fa-envelope"></i>
                    </div>
                    <div>
                        <h4 style="font-size:1.05rem; font-weight:700; color:var(--text-primary); margin-bottom:0.25rem;">
                            {{ app()->getLocale() == 'ar' ? 'البريد الإلكتروني' : 'Official Email' }}
                        </h4>
                        <p style="color:var(--gold-light); font-size:0.95rem; font-weight:600;">
                            {{ \App\Models\Setting::get('email', 'info@anmat.ly') }}
                        </p>
                    </div>
                </div>

                <div class="contact-method-item">
                    <div class="contact-method-icon">
                        <i class="fa-solid fa-clock"></i>
                    </div>
                    <div>
                        <h4 style="font-size:1.05rem; font-weight:700; color:var(--text-primary); margin-bottom:0.25rem;">
                            {{ app()->getLocale() == 'ar' ? 'ساعات العمل الرسمية' : 'Business Hours' }}
                        </h4>
                        <p style="color:var(--text-secondary); font-size:0.95rem;">
                            {{ \App\Models\Setting::getLocalized('working_hours', null, 'الأحد - الخميس: 8:30 ص - 4:30 م') }}
                        </p>
                    </div>
                </div>

                @if($wa = \App\Models\Setting::get('whatsapp'))
                    <div style="margin-top:2.5rem; padding-top:1.5rem; border-top:1px solid var(--border-subtle);">
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $wa) }}" target="_blank" class="btn-outline" style="width:100%; border-color:#25D366; color:#25D366; font-size:0.95rem;">
                            <i class="fa-brands fa-whatsapp" style="font-size:1.2rem;"></i>
                            <span>{{ app()->getLocale() == 'ar' ? 'محادثة فورية عبر واتساب' : 'Instant WhatsApp Assistance' }}</span>
                        </a>
                    </div>
                @endif
            </div>

            <!-- Inquiry Form -->
            <div class="contact-form-card">
                <span class="section-tag">{{ app()->getLocale() == 'ar' ? 'نموذج الطلب والاستشارة' : 'Inquiry & Consultation' }}</span>
                <h3 style="font-size:1.8rem; font-weight:800; margin-bottom:1.5rem; color:var(--text-primary);">
                    {{ app()->getLocale() == 'ar' ? 'أرسل تفاصيل مشروعك' : 'Send Project Details' }}
                </h3>

                <form action="{{ route('contact.submit') }}" method="POST">
                    @csrf

                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:1.25rem;">
                        <div class="form-group">
                            <label class="form-label">{{ app()->getLocale() == 'ar' ? 'الاسم الكامل *' : 'Full Name *' }}</label>
                            <input type="text" name="name" class="form-input" required placeholder="{{ app()->getLocale() == 'ar' ? 'الاسم الثلاثي' : 'John Doe' }}">
                        </div>

                        <div class="form-group">
                            <label class="form-label">{{ app()->getLocale() == 'ar' ? 'البريد الإلكتروني *' : 'Email Address *' }}</label>
                            <input type="email" name="email" class="form-input" required placeholder="name@domain.com">
                        </div>
                    </div>

                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:1.25rem;">
                        <div class="form-group">
                            <label class="form-label">{{ app()->getLocale() == 'ar' ? 'رقم الهاتف / الواتساب' : 'Phone / WhatsApp' }}</label>
                            <input type="text" name="phone" class="form-input" placeholder="+218 91 ...">
                        </div>

                        <div class="form-group">
                            <label class="form-label">{{ app()->getLocale() == 'ar' ? 'الخدمة المطلوبة' : 'Interested Service' }}</label>
                            <select name="service" class="form-select">
                                <option value="">{{ app()->getLocale() == 'ar' ? '-- اختر الخدمة الهندسية --' : '-- Select Engineering Service --' }}</option>
                                @foreach($services as $srv)
                                    <option value="{{ $srv->title }}" {{ request('service') == $srv->title ? 'selected' : '' }}>
                                        {{ $srv->title }}
                                    </option>
                                @endforeach
                                <option value="أخرى">{{ app()->getLocale() == 'ar' ? 'استشارة عامة / أخرى' : 'General / Other Inquiry' }}</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">{{ app()->getLocale() == 'ar' ? 'موضوع الرسالة' : 'Subject' }}</label>
                        <input type="text" name="subject" class="form-input" placeholder="{{ app()->getLocale() == 'ar' ? 'عنوان مختصر لطلبكم' : 'Brief project or inquiry topic' }}">
                    </div>

                    <div class="form-group">
                        <label class="form-label">{{ app()->getLocale() == 'ar' ? 'تفاصيل الطلب أو المشروع *' : 'Project Details & Requirements *' }}</label>
                        <textarea name="message" rows="5" class="form-textarea" required placeholder="{{ app()->getLocale() == 'ar' ? 'يرجى توضيح موقع المشروع، المساحة التقريبية، والخدمات المطلوبة بدقة...' : 'Please specify the project location, approximate area, and desired scope of work...' }}"></textarea>
                    </div>

                    <button type="submit" class="btn-gold" style="width:100%; padding:0.9rem; font-size:1rem; margin-top:0.5rem;">
                        <i class="fa-solid fa-paper-plane"></i>
                        <span>{{ app()->getLocale() == 'ar' ? 'إرسال طلب الاستشارة' : 'Submit Consultation Request' }}</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection

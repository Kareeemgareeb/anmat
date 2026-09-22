@extends('pages.layout')

@section('title', app()->getLocale() == 'ar' ? 'من نحن | أنماط للأعمال والاستشارات الهندسية' : 'About Us | ANMAT')

@section('content')
<!-- Page Header -->
<section style="padding:4.5rem 0 3rem; background:var(--bg-secondary); border-bottom:1px solid var(--border-subtle); text-align:center;">
    <div class="container">
        <span class="section-tag">{{ app()->getLocale() == 'ar' ? 'الهوية والرسالة' : 'Identity & Mission' }}</span>
        <h1 style="font-size:2.75rem; font-weight:900; margin-bottom:1rem; color:var(--text-primary);">
            {{ app()->getLocale() == 'ar' ? 'عن شركة أنماط الهندسية' : 'About ANMAT Engineering' }}
        </h1>
        <p style="color:var(--text-secondary); max-width:680px; margin:0 auto; font-size:1.1rem; line-height:1.7;">
            {{ \App\Models\Setting::getLocalized('company_tagline', null, 'رؤية هندسية دقيقة تبني المستقبل وتجسد الإتقان') }}
        </p>
    </div>
</section>

<!-- About Story Section -->
<section class="section">
    <div class="container">
        <div style="display:grid; grid-template-columns:1.1fr 0.9fr; gap:4rem; align-items:center;">
            <div>
                <span class="section-tag">{{ app()->getLocale() == 'ar' ? 'نبذة تعريفية' : 'Company Overview' }}</span>
                <h2 style="font-size:2.3rem; font-weight:800; margin-bottom:1.5rem; line-height:1.3;">
                    {{ app()->getLocale() == 'ar' ? 'بيت خبرة هندسي رائد يواكب مسيرة البناء والتطوير' : 'A Leading Engineering Firm Advancing Infrastructure Excellence' }}
                </h2>
                <p style="color:var(--text-secondary); font-size:1.05rem; line-height:1.8; margin-bottom:1.5rem;">
                    {{ \App\Models\Setting::getLocalized('about_intro', null, 'شركة "أنماط" للأعمال والاستشارات الهندسية هي بيت خبرة رائد يجمع بين التخصص الأكاديمي والخبرة الميدانية الواسعة. تأسست الشركة لتقديم حلول واستشارات هندسية متطورة تلبي متطلبات المشاريع الكبرى وفق المعايير الدولية والمحلية.') }}
                </p>
                <p style="color:var(--text-secondary); font-size:1.05rem; line-height:1.8; margin-bottom:2rem;">
                    {{ app()->getLocale() == 'ar'
                        ? 'تتميز الشركة بطاقم متكامل من الاستشاريين والمهندسين في مجالات الهندسة المساحية والجيوديسية، الهندسة الإنشائية، العمارة والتخطيط الحضري، وإدارة المشاريع، مدعومين بأحدث أجهزة الرصد المساحي والبرمجيات التخصصية المعتمدة عالمياً.'
                        : 'Our multidisciplinary team spans geodetic surveying, structural design, bioclimatic architecture, and rigorous construction supervision, equipped with global-standard GNSS stations and advanced engineering computing.' }}
                </p>

                <div style="display:flex; gap:1.25rem;">
                    <a href="{{ route('services') }}" class="btn-gold">
                        <span>{{ app()->getLocale() == 'ar' ? 'استكشف خدماتنا' : 'Our Services' }}</span>
                    </a>
                    <a href="{{ route('contact') }}" class="btn-outline">
                        <span>{{ app()->getLocale() == 'ar' ? 'تواصل معنا' : 'Contact Us' }}</span>
                    </a>
                </div>
            </div>

            <!-- Visual Card with Logo -->
            <div style="text-align:center;">
                <div class="hero-emblem-card" style="margin:0 auto; max-width:420px;">
                    <img src="{{ asset('images/logo-dark.png') }}" alt="ANMAT Emblem" class="hero-emblem-img logo-for-dark">
                    <img src="{{ asset('images/logo-light.jpg') }}" alt="ANMAT Emblem" class="hero-emblem-img logo-for-light">
                    <h3 style="font-size:1.3rem; font-weight:800; color:var(--silver-light); margin-bottom:0.25rem;">
                        {{ app()->getLocale() == 'ar' ? 'أنماط للأعمال والاستشارات الهندسية' : 'ANMAT Engineering Works & Consultancy' }}
                    </h3>
                    <p style="color:var(--gold-light); font-size:0.85rem; font-weight:600;">Tripoli - Libya | طرابلس - ليبيا</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Vision & Mission Grid -->
<section class="section" style="background:var(--bg-secondary); border-top:1px solid var(--border-subtle); border-bottom:1px solid var(--border-subtle);">
    <div class="container">
        <div style="display:grid; grid-template-columns:1fr 1fr; gap:2.5rem;">
            <!-- Vision -->
            <div style="background:var(--bg-card); border:1px solid var(--border-subtle); border-radius:var(--radius-md); padding:2.5rem; position:relative; overflow:hidden;">
                <div style="width:54px; height:54px; border-radius:var(--radius-sm); background:rgba(198,146,62,0.15); display:flex; align-items:center; justify-content:center; color:var(--gold-light); font-size:1.5rem; margin-bottom:1.5rem;">
                    <i class="fa-solid fa-eye"></i>
                </div>
                <h3 style="font-size:1.6rem; font-weight:800; margin-bottom:1rem; color:var(--text-primary);">
                    {{ app()->getLocale() == 'ar' ? 'رؤيتنا' : 'Our Vision' }}
                </h3>
                <p style="color:var(--text-secondary); line-height:1.8; font-size:1rem;">
                    {{ \App\Models\Setting::getLocalized('about_vision', null, 'أن نكون الخيار الأول والشريك الموثوق في تقديم الاستشارات الهندسية والأعمال المساحية في ليبيا والمنطقة.') }}
                </p>
            </div>

            <!-- Mission -->
            <div style="background:var(--bg-card); border:1px solid var(--border-subtle); border-radius:var(--radius-md); padding:2.5rem; position:relative; overflow:hidden;">
                <div style="width:54px; height:54px; border-radius:var(--radius-sm); background:rgba(37,99,235,0.15); display:flex; align-items:center; justify-content:center; color:var(--accent-blue); font-size:1.5rem; margin-bottom:1.5rem;">
                    <i class="fa-solid fa-bullseye"></i>
                </div>
                <h3 style="font-size:1.6rem; font-weight:800; margin-bottom:1rem; color:var(--text-primary);">
                    {{ app()->getLocale() == 'ar' ? 'رسالتنا' : 'Our Mission' }}
                </h3>
                <p style="color:var(--text-secondary); line-height:1.8; font-size:1rem;">
                    {{ \App\Models\Setting::getLocalized('about_mission', null, 'تمكين عملائنا من تحقيق تطلعاتهم الإنشائية عبر تقديم دراسات هندسية رصينة، وتصاميم مبتكرة، وإشراف ميداني دقيق يضمن سلامة المنشآت وكفاءة التكاليف.') }}
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Values & Pillars -->
<section class="section">
    <div class="container">
        <div class="section-header">
            <span class="section-tag">{{ app()->getLocale() == 'ar' ? 'قيمنا وثوابتنا' : 'Core Principles' }}</span>
            <h2 class="section-title">{{ app()->getLocale() == 'ar' ? 'لماذا يختار العملاء أنماط؟' : 'Why Partners Choose ANMAT' }}</h2>
        </div>

        <div class="grid-3">
            <div class="service-card">
                <div class="service-icon-box" style="margin-bottom:1rem;">
                    <i class="fa-solid fa-crosshairs"></i>
                </div>
                <h3 class="service-title">{{ app()->getLocale() == 'ar' ? 'دقة متناهية والتزام بالجداول' : 'Absolute Precision & Punctuality' }}</h3>
                <p class="service-desc">
                    {{ app()->getLocale() == 'ar' ? 'الالتزام الصارم بالمواعيد والدقة الهندسية في تسليم المخططات والمقايسات ونتائج الرفع المساحي دون تأخير.' : 'Unyielding adherence to milestones, delivering blueprints, BOQs, and geospatial deliverables on schedule.' }}
                </p>
            </div>

            <div class="service-card">
                <div class="service-icon-box" style="margin-bottom:1rem;">
                    <i class="fa-solid fa-satellite-dish"></i>
                </div>
                <h3 class="service-title">{{ app()->getLocale() == 'ar' ? 'تجهيزات مساحية وحسابية متطورة' : 'Advanced Surveying Technology' }}</h3>
                <p class="service-desc">
                    {{ app()->getLocale() == 'ar' ? 'امتلاك أحدث المحطات الشاملة وأجهزة GPS الفضائية والبرمجيات المتوافقة مع كودات البناء العالمية ونظم المعلومات الجغرافية GIS.' : 'Deploying cutting-edge GNSS base/rover setups, drone photogrammetry, and specialized engineering computation tools.' }}
                </p>
            </div>

            <div class="service-card">
                <div class="service-icon-box" style="margin-bottom:1rem;">
                    <i class="fa-solid fa-file-shield"></i>
                </div>
                <h3 class="service-title">{{ app()->getLocale() == 'ar' ? 'أرشفة موثوقة ومراسلات معتمدة' : 'Official Document Governance' }}</h3>
                <p class="service-desc">
                    {{ app()->getLocale() == 'ar' ? 'إصدار خطابات وتقارير رسمية مسجلة بأرقام مرجعية تسلسلية معتمدة لحماية حقوق الأطراف والتوثيق القانوني للمشاريع.' : 'Every technical report, survey book, and client correspondence is archived with authenticated serial tracking codes.' }}
                </p>
            </div>
        </div>
    </div>
</section>
@endsection

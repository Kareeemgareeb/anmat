@extends('pages.layout')

@section('title', app()->getLocale() == 'ar' ? 'أنماط للأعمال والاستشارات الهندسية | ANMAT' : 'ANMAT - Engineering Works & Consultancy')

@section('content')
<!-- Hero Section -->
<section class="hero-section">
    <div class="hero-glow-1"></div>
    <div class="hero-glow-2"></div>
    <div class="container hero-grid">
        <!-- Hero Text -->
        <div>
            <div class="hero-badge">
                <span class="hero-badge-pulse"></span>
                <span>{{ \App\Models\Setting::getLocalized('hero_badge', null, 'بيت خبرة هندسي واستشاري معتمد') }}</span>
            </div>

            <h1 class="hero-title">
                {{ \App\Models\Setting::getLocalized('hero_title', null, 'حلول هندسية ومساحية متكاملة بأعلى معايير الدقة والابتكار') }}
            </h1>

            <p class="hero-subtitle">
                {{ \App\Models\Setting::getLocalized('hero_subtitle', null, 'نقدم استشارات هندسية متخصصة تشمل أعمال المسح الطبوغرافي، التصميم الإنشائي والمعماري، وإدارة المشاريع والإشراف الميداني لضمان جودة استثنائية.') }}
            </p>

            <div class="hero-buttons">
                <a href="{{ route('services') }}" class="btn-gold">
                    <span>{{ app()->getLocale() == 'ar' ? 'استكشف خدماتنا' : 'Explore Services' }}</span>
                    <i class="fa-solid {{ app()->getLocale() == 'ar' ? 'fa-arrow-left' : 'fa-arrow-right' }}"></i>
                </a>
                <a href="{{ route('contact') }}" class="btn-outline">
                    <i class="fa-regular fa-comments"></i>
                    <span>{{ app()->getLocale() == 'ar' ? 'طلب استشارة هندسية' : 'Request Consultation' }}</span>
                </a>
            </div>

            <div style="display:flex; align-items:center; gap:1.5rem; color:var(--silver-mid); font-size:0.88rem;">
                <div style="display:flex; align-items:center; gap:0.4rem;">
                    <i class="fa-solid fa-circle-check" style="color:var(--gold-light);"></i>
                    <span>{{ app()->getLocale() == 'ar' ? 'أجهزة مساحية متقدمة GNSS/GPS' : 'Advanced GNSS/GPS Tools' }}</span>
                </div>
                <div style="display:flex; align-items:center; gap:0.4rem;">
                    <i class="fa-solid fa-circle-check" style="color:var(--gold-light);"></i>
                    <span>{{ app()->getLocale() == 'ar' ? 'اعتماد الكودات العالمية' : 'Certified Global Codes' }}</span>
                </div>
            </div>
        </div>

        <!-- Hero Visual (Emblem 3D Card with Floating Metrics) -->
        <div class="hero-visual">
            <div class="hero-emblem-card">
                <img src="{{ asset('images/logo-dark.png') }}" alt="ANMAT 3D Identity" class="hero-emblem-img logo-for-dark">
                <img src="{{ asset('images/logo-light.jpg') }}" alt="ANMAT 3D Identity" class="hero-emblem-img logo-for-light">
                <h3 class="hero-emblem-label">{{ app()->getLocale() == 'ar' ? 'أنماط الهندسية' : 'ANMAT Engineering' }}</h3>
                <p class="hero-emblem-sublabel">{{ app()->getLocale() == 'ar' ? 'الأعمال والاستشارات الهندسية' : 'Engineering Works & Consultancy' }}</p>
                <div style="margin-top:1.25rem; padding-top:1rem; border-top:1px solid var(--border-subtle); display:flex; justify-content:space-around;">
                    <div>
                        <span style="font-size:0.75rem; color:var(--text-muted); display:block;">{{ app()->getLocale() == 'ar' ? 'رقم السجل' : 'Reg Code' }}</span>
                        <strong style="color:var(--silver-light); font-size:0.9rem;">ANM-LY-ENG</strong>
                    </div>
                    <div>
                        <span style="font-size:0.75rem; color:var(--text-muted); display:block;">{{ app()->getLocale() == 'ar' ? 'التصنيف' : 'Classification' }}</span>
                        <strong style="color:var(--gold-light); font-size:0.9rem;">{{ app()->getLocale() == 'ar' ? 'درجة أولى' : 'Tier 1' }}</strong>
                    </div>
                </div>
            </div>

            <!-- Floating Badges -->
            <div class="floating-badge badge-top">
                <div class="floating-badge-icon">
                    <i class="fa-solid fa-award"></i>
                </div>
                <div>
                    <div class="floating-badge-val">{{ \App\Models\Setting::get('stat_years', '15+') }}</div>
                    <div class="floating-badge-text">{{ app()->getLocale() == 'ar' ? 'سنوات من الخبرة' : 'Years Experience' }}</div>
                </div>
            </div>

            <div class="floating-badge badge-bottom">
                <div class="floating-badge-icon" style="color:var(--accent-cyan); background:rgba(14,165,233,0.15);">
                    <i class="fa-solid fa-map-location-dot"></i>
                </div>
                <div>
                    <div class="floating-badge-val">{{ \App\Models\Setting::get('stat_surveys', '450+') }}</div>
                    <div class="floating-badge-text">{{ app()->getLocale() == 'ar' ? 'مهمة مساحية منجزة' : 'Surveying Missions' }}</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Statistics Bar -->
<section class="stats-bar">
    <div class="container">
        <div class="stats-grid">
            <div class="stat-item">
                <div class="stat-number text-gold">{{ \App\Models\Setting::get('stat_years', '15+') }}</div>
                <div class="stat-label">{{ app()->getLocale() == 'ar' ? 'سنوات الخبرة الهندسية' : 'Years of Field Experience' }}</div>
            </div>
            <div class="stat-item">
                <div class="stat-number text-gold">{{ \App\Models\Setting::get('stat_projects', '120+') }}</div>
                <div class="stat-label">{{ app()->getLocale() == 'ar' ? 'مشروعاً هندسياً مكتملاً' : 'Completed Projects' }}</div>
            </div>
            <div class="stat-item">
                <div class="stat-number text-gold">{{ \App\Models\Setting::get('stat_surveys', '450+') }}</div>
                <div class="stat-label">{{ app()->getLocale() == 'ar' ? 'أعمال رفع مساحي وجيوديسي' : 'Geodetic & Cadastral Surveys' }}</div>
            </div>
            <div class="stat-item">
                <div class="stat-number text-gold">{{ \App\Models\Setting::get('stat_engineers', '25+') }}</div>
                <div class="stat-label">{{ app()->getLocale() == 'ar' ? 'مهندساً واستشارياً متخصصاً' : 'Specialized Consultants' }}</div>
            </div>
        </div>
    </div>
</section>

<!-- Services Showcase -->
<section class="section">
    <div class="container">
        <div class="section-header">
            <span class="section-tag">{{ app()->getLocale() == 'ar' ? 'خدماتنا المتخصصة' : 'Disciplines & Capabilities' }}</span>
            <h2 class="section-title">{{ app()->getLocale() == 'ar' ? 'استشارات وأعمال هندسية متكاملة' : 'Comprehensive Engineering Solutions' }}</h2>
            <p class="section-desc">
                {{ app()->getLocale() == 'ar' 
                    ? 'نوفر باقة متكاملة من الخدمات الهندسية الاحترافية بأعلى معايير الدقة والامتثال الفني.' 
                    : 'We provide an integrated spectrum of professional engineering services adhering to supreme precision and technical governance.' }}
            </p>
        </div>

        <div class="grid-3">
            @forelse($services as $service)
                <div class="service-card">
                    <div>
                        <div class="service-icon-box">
                            @php
                                $iconClass = match($service->icon) {
                                    'compass' => 'fa-solid fa-compass-drafting',
                                    'building' => 'fa-solid fa-city',
                                    'home' => 'fa-solid fa-building-columns',
                                    'clipboard-check' => 'fa-solid fa-clipboard-check',
                                    'calculator' => 'fa-solid fa-calculator',
                                    'shield-check' => 'fa-solid fa-shield-halved',
                                    default => 'fa-solid fa-draw-polygon'
                                };
                            @endphp
                            <i class="{{ $iconClass }}"></i>
                        </div>

                        @if($service->category)
                            <div class="service-category">{{ $service->category }}</div>
                        @endif

                        <h3 class="service-title">{{ $service->title }}</h3>

                        <p class="service-desc">
                            {{ $service->short_description ?: Str::limit($service->description, 140) }}
                        </p>

                        @if(!empty($service->features_list))
                            <ul class="service-features-list">
                                @foreach(array_slice($service->features_list, 0, 3) as $feat)
                                    <li>
                                        <i class="fa-solid fa-check"></i>
                                        <span>{{ $feat }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>

                    <div>
                        <a href="{{ route('contact', ['service' => $service->title]) }}" class="btn-outline" style="width:100%; font-size:0.88rem; padding:0.6rem;">
                            <span>{{ app()->getLocale() == 'ar' ? 'طلب استشارة بهذه الخدمة' : 'Inquire About Service' }}</span>
                            <i class="fa-solid {{ app()->getLocale() == 'ar' ? 'fa-arrow-left' : 'fa-arrow-right' }}"></i>
                        </a>
                    </div>
                </div>
            @empty
                <div style="grid-column: 1 / -1; text-align:center; padding:3rem; color:var(--text-muted);">
                    {{ app()->getLocale() == 'ar' ? 'لا توجد خدمات متاحة حالياً.' : 'No services available currently.' }}
                </div>
            @endforelse
        </div>

        <div style="text-align:center; margin-top:3.5rem;">
            <a href="{{ route('services') }}" class="btn-gold">
                <span>{{ app()->getLocale() == 'ar' ? 'عرض كافة الخدمات والتفاصيل' : 'View All Engineering Services' }}</span>
                <i class="fa-solid {{ app()->getLocale() == 'ar' ? 'fa-arrow-left' : 'fa-arrow-right' }}"></i>
            </a>
        </div>
    </div>
</section>

<!-- Projects Showcase -->
<section class="section" style="background:var(--bg-secondary); border-top:1px solid var(--border-subtle); border-bottom:1px solid var(--border-subtle);">
    <div class="container">
        <div class="section-header">
            <span class="section-tag">{{ app()->getLocale() == 'ar' ? 'سجل الإنجازات' : 'Project Portfolio' }}</span>
            <h2 class="section-title">{{ app()->getLocale() == 'ar' ? 'نماذج من مشاريعنا المنفذة' : 'Featured Benchmark Projects' }}</h2>
            <p class="section-desc">
                {{ app()->getLocale() == 'ar'
                    ? 'نفخر بوضع بصمتنا الهندسية والاستشارية في كبرى المشاريع العمرانية والبنى التحتية.'
                    : 'We take immense pride in leaving our precision engineering fingerprint on landmark urban and infrastructural developments.' }}
            </p>
        </div>

        <div class="grid-3">
            @forelse($projects as $project)
                <div class="project-card">
                    <div class="project-image-wrapper">
                        @if($project->image_path)
                            <img src="{{ $project->image_url }}" alt="{{ $project->title }}" class="project-img">
                        @else
                            <div style="width:100%; height:100%; background:linear-gradient(135deg, #111A29 0%, #1A263C 100%); display:flex; align-items:center; justify-content:center; flex-direction:column; gap:0.75rem;">
                                <i class="fa-solid fa-drafting-compass" style="font-size:3rem; color:rgba(198,146,62,0.3);"></i>
                                <span style="font-size:0.75rem; color:var(--text-muted); font-weight:600; text-transform:uppercase;">ANMAT ENGINEERING WORKS</span>
                            </div>
                        @endif

                        <span class="project-badge-status {{ $project->status == 'completed' ? 'badge-completed' : 'badge-ongoing' }}">
                            {{ $project->status_label }}
                        </span>
                    </div>

                    <div class="project-content">
                        <div class="project-meta-row">
                            <span><i class="fa-regular fa-folder-open" style="margin-inline-end:4px;"></i> {{ $project->category ?: (app()->getLocale() == 'ar' ? 'استشارات هندسية' : 'Consultancy') }}</span>
                            @if($project->completion_date)
                                <span style="color:var(--text-muted);"><i class="fa-regular fa-calendar-check" style="margin-inline-end:4px;"></i> {{ $project->completion_date->format('Y/m') }}</span>
                            @endif
                        </div>

                        <h3 class="project-title">{{ $project->title }}</h3>

                        <p class="project-desc">{{ Str::limit($project->description, 130) }}</p>

                        <div class="project-details-grid">
                            @if($project->client)
                                <div class="project-detail-item">
                                    <span class="project-detail-label">{{ app()->getLocale() == 'ar' ? 'العميل' : 'Client' }}</span>
                                    <span class="project-detail-val">{{ $project->client }}</span>
                                </div>
                            @endif
                            @if($project->location)
                                <div class="project-detail-item">
                                    <span class="project-detail-label">{{ app()->getLocale() == 'ar' ? 'الموقع' : 'Location' }}</span>
                                    <span class="project-detail-val">{{ $project->location }}</span>
                                </div>
                            @endif
                            @if($project->area)
                                <div class="project-detail-item">
                                    <span class="project-detail-label">{{ app()->getLocale() == 'ar' ? 'المساحة / النطاق' : 'Scope / Area' }}</span>
                                    <span class="project-detail-val">{{ $project->area }}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div style="grid-column: 1 / -1; text-align:center; padding:3rem; color:var(--text-muted);">
                    {{ app()->getLocale() == 'ar' ? 'لا توجد مشاريع مضافة بعد.' : 'No projects listed yet.' }}
                </div>
            @endforelse
        </div>

        <div style="text-align:center; margin-top:3.5rem;">
            <a href="{{ route('projects') }}" class="btn-gold">
                <span>{{ app()->getLocale() == 'ar' ? 'استعراض سجل المشاريع بالكامل' : 'View Full Projects Portfolio' }}</span>
                <i class="fa-solid {{ app()->getLocale() == 'ar' ? 'fa-arrow-left' : 'fa-arrow-right' }}"></i>
            </a>
        </div>
    </div>
</section>

<!-- Official Document & Transaction Verification System Banner -->
<section class="section">
    <div class="container">
        <div class="verification-box">
            <div style="text-align:center; max-width:680px; margin:0 auto;">
                <span class="section-tag"><i class="fa-solid fa-stamp" style="margin-inline-end:6px;"></i>{{ app()->getLocale() == 'ar' ? 'نظام الأرشفة والتوثيق الرقمي' : 'Official Document Verification' }}</span>
                <h2 style="font-size:2rem; font-weight:800; margin-bottom:1rem; color:var(--text-primary);">
                    {{ app()->getLocale() == 'ar' ? 'التحقق من صحة المراسلات والتقارير الهندسية' : 'Verify Official ANMAT Reference Number' }}
                </h2>
                <p style="color:var(--text-secondary); font-size:0.95rem; line-height:1.7;">
                    {{ app()->getLocale() == 'ar'
                        ? 'تُمنح جميع الكتب الرسمية، التقارير الفنية، والمخططات الصادرة عن أنماط رقماً مرجعياً تسلسلياً فريداً لضمان الأصالة والموثوقية وتسهيل المتابعة.'
                        : 'All official correspondence, technical reports, and engineering booklets issued by ANMAT carry a unique serialized reference number for verifiable authenticity.' }}
                </p>

                <form action="{{ route('verify.document') }}" method="GET" class="verify-input-group">
                    <input type="text" name="ref" placeholder="{{ app()->getLocale() == 'ar' ? 'أدخل الرقم المرجعي (مثال: ANMAT-OUT-2026-0001)' : 'Enter Reference Code (e.g. ANMAT-OUT-2026-0001)' }}" class="verify-input" required>
                    <button type="submit" class="btn-gold" style="white-space:nowrap;">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <span>{{ app()->getLocale() == 'ar' ? 'تحقق الآن' : 'Verify' }}</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action Banner -->
<section class="section" style="padding-top:1rem;">
    <div class="container">
        <div style="background:linear-gradient(135deg, rgba(37,99,235,0.1) 0%, rgba(198,146,62,0.15) 100%); border:1px solid var(--border-hover); border-radius:var(--radius-lg); padding:3.5rem; text-align:center; position:relative; overflow:hidden;">
            <h2 style="font-size:2.2rem; font-weight:800; margin-bottom:1rem; color:var(--text-primary);">
                {{ app()->getLocale() == 'ar' ? 'هل تبحث عن استشارة هندسية دقيقة لمشروعك؟' : 'Ready to Elevate Your Engineering Project?' }}
            </h2>
            <p style="color:var(--text-secondary); font-size:1.1rem; max-width:680px; margin:0 auto 2rem; line-height:1.7;">
                {{ app()->getLocale() == 'ar'
                    ? 'فريقنا المتخصص في أعمال المساحة والتصميم والإشراف الميداني مستعد لتقديم أفضل الحلول المتطورة التي تضمن نجاح مشروعكم.'
                    : 'Our certified teams in geodetic surveying, structural design, and field project governance are primed to ensure your project’s enduring success.' }}
            </p>
            <div style="display:flex; justify-content:center; gap:1.25rem; flex-wrap:wrap;">
                <a href="{{ route('contact') }}" class="btn-gold">
                    <i class="fa-solid fa-paper-plane"></i>
                    <span>{{ app()->getLocale() == 'ar' ? 'تواصل معنا الآن' : 'Contact Our Engineers' }}</span>
                </a>
                @if($wa = \App\Models\Setting::get('whatsapp'))
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $wa) }}" target="_blank" class="btn-outline" style="border-color:#25D366; color:#25D366;">
                        <i class="fa-brands fa-whatsapp"></i>
                        <span>{{ app()->getLocale() == 'ar' ? 'محادثة واتساب مباشرة' : 'Chat on WhatsApp' }}</span>
                    </a>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection

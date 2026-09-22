@extends('pages.layout')

@section('title', app()->getLocale() == 'ar' ? 'خدماتنا الهندسية | أنماط للأعمال والاستشارات الهندسية' : 'Engineering Services | ANMAT')

@section('content')
<!-- Page Header -->
<section style="padding:4.5rem 0 3rem; background:var(--bg-secondary); border-bottom:1px solid var(--border-subtle); text-align:center;">
    <div class="container">
        <span class="section-tag">{{ app()->getLocale() == 'ar' ? 'الخبرات والتخصصات' : 'Core Disciplines' }}</span>
        <h1 style="font-size:2.75rem; font-weight:900; margin-bottom:1rem; color:var(--text-primary);">
            {{ app()->getLocale() == 'ar' ? 'خدماتنا الهندسية والاستشارية' : 'Engineering & Consultancy Services' }}
        </h1>
        <p style="color:var(--text-secondary); max-width:680px; margin:0 auto; font-size:1.1rem; line-height:1.7;">
            {{ app()->getLocale() == 'ar'
                ? 'نقدم منظومة متكاملة من الأعمال المساحية، التصاميم الهندسية، والإشراف الميداني بأحدث التقنيات وأدق المعايير.'
                : 'Delivering an integrated suite of geodetic surveys, engineering blueprints, and site supervision with benchmark precision.' }}
        </p>
    </div>
</section>

<!-- Services Grid Section -->
<section class="section">
    <div class="container">
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
                            {{ $service->description }}
                        </p>

                        @if(!empty($service->features_list))
                            <ul class="service-features-list">
                                @foreach($service->features_list as $feat)
                                    <li>
                                        <i class="fa-solid fa-circle-check"></i>
                                        <span>{{ $feat }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>

                    <div style="margin-top:1.5rem;">
                        <a href="{{ route('contact', ['service' => $service->title]) }}" class="btn-gold" style="width:100%; font-size:0.9rem;">
                            <span>{{ app()->getLocale() == 'ar' ? 'طلب استشارة أو عرض سعر' : 'Request Proposal' }}</span>
                            <i class="fa-solid {{ app()->getLocale() == 'ar' ? 'fa-arrow-left' : 'fa-arrow-right' }}"></i>
                        </a>
                    </div>
                </div>
            @empty
                <div style="grid-column:1 / -1; text-align:center; padding:4rem; color:var(--text-muted);">
                    {{ app()->getLocale() == 'ar' ? 'لا توجد خدمات مضافة حالياً.' : 'No services listed yet.' }}
                </div>
            @endforelse
        </div>
    </div>
</section>
@endsection

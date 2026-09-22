@extends('pages.layout')

@section('title', app()->getLocale() == 'ar' ? 'سجل مشاريعنا | أنماط للأعمال والاستشارات الهندسية' : 'Our Projects | ANMAT')

@section('content')
<!-- Page Header -->
<section style="padding:4.5rem 0 3rem; background:var(--bg-secondary); border-bottom:1px solid var(--border-subtle); text-align:center;">
    <div class="container">
        <span class="section-tag">{{ app()->getLocale() == 'ar' ? 'سجل الأعمال والإنجازات' : 'Track Record' }}</span>
        <h1 style="font-size:2.75rem; font-weight:900; margin-bottom:1rem; color:var(--text-primary);">
            {{ app()->getLocale() == 'ar' ? 'مشاريعنا الهندسية والاستشارية' : 'Our Engineering Projects' }}
        </h1>
        <p style="color:var(--text-secondary); max-width:680px; margin:0 auto; font-size:1.1rem; line-height:1.7;">
            {{ app()->getLocale() == 'ar'
                ? 'استعرض باقة من أبرز المشاريع التي شاركت فيها أنماط في مجالات الرفع المساحي، التصميم الإنشائي، والتخطيط الحضري.'
                : 'Browse our signature projects across geodetic surveying, structural design, and urban infrastructure developments.' }}
        </p>

        <!-- Status Filter Tabs -->
        <div style="display:flex; justify-content:center; gap:0.75rem; margin-top:2rem; flex-wrap:wrap;">
            <a href="{{ route('projects') }}" class="{{ !request()->filled('status') ? 'btn-gold' : 'btn-outline' }}" style="padding:0.5rem 1.25rem; font-size:0.88rem;">
                {{ app()->getLocale() == 'ar' ? 'جميع المشاريع' : 'All Projects' }}
            </a>
            <a href="{{ route('projects', ['status' => 'completed']) }}" class="{{ request('status') == 'completed' ? 'btn-gold' : 'btn-outline' }}" style="padding:0.5rem 1.25rem; font-size:0.88rem;">
                <i class="fa-solid fa-circle-check"></i>
                {{ app()->getLocale() == 'ar' ? 'المشاريع المنجزة' : 'Completed' }}
            </a>
            <a href="{{ route('projects', ['status' => 'ongoing']) }}" class="{{ request('status') == 'ongoing' ? 'btn-gold' : 'btn-outline' }}" style="padding:0.5rem 1.25rem; font-size:0.88rem;">
                <i class="fa-solid fa-clock-rotate-left"></i>
                {{ app()->getLocale() == 'ar' ? 'قيد التنفيذ والمتابعة' : 'In Progress' }}
            </a>
        </div>
    </div>
</section>

<!-- Projects Grid Section -->
<section class="section">
    <div class="container">
        <div class="grid-3">
            @forelse($projects as $project)
                <div class="project-card">
                    <div class="project-image-wrapper">
                        @if($project->image_path)
                            <img src="{{ $project->image_url }}" alt="{{ $project->title }}" class="project-img">
                        @else
                            <div style="width:100%; height:100%; background:linear-gradient(135deg, #0F172A 0%, #1E293B 100%); display:flex; align-items:center; justify-content:center; flex-direction:column; gap:0.75rem;">
                                <i class="fa-solid fa-drafting-compass" style="font-size:3.5rem; color:rgba(198,146,62,0.35);"></i>
                                <span style="font-size:0.75rem; color:var(--gold-light); font-weight:700; letter-spacing:0.05em;">ANMAT ENGINEERING</span>
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

                        <p class="project-desc">{{ $project->description }}</p>

                        <div class="project-details-grid">
                            @if($project->client)
                                <div class="project-detail-item">
                                    <span class="project-detail-label">{{ app()->getLocale() == 'ar' ? 'الجهة المالكة / العميل' : 'Client / Authority' }}</span>
                                    <span class="project-detail-val">{{ $project->client }}</span>
                                </div>
                            @endif
                            @if($project->location)
                                <div class="project-detail-item">
                                    <span class="project-detail-label">{{ app()->getLocale() == 'ar' ? 'الموقع الجغرافي' : 'Location' }}</span>
                                    <span class="project-detail-val">{{ $project->location }}</span>
                                </div>
                            @endif
                            @if($project->area)
                                <div class="project-detail-item" style="grid-column:1 / -1;">
                                    <span class="project-detail-label">{{ app()->getLocale() == 'ar' ? 'المساحة / نطاق الأعمال' : 'Scope / Footprint' }}</span>
                                    <span class="project-detail-val" style="color:var(--gold-light);">{{ $project->area }}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div style="grid-column:1 / -1; text-align:center; padding:4rem; color:var(--text-muted);">
                    {{ app()->getLocale() == 'ar' ? 'لا توجد مشاريع مسجلة في هذا القسم حالياً.' : 'No projects found in this category.' }}
                </div>
            @endforelse
        </div>
    </div>
</section>
@endsection

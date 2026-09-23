<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\CorrespondenceController;
use App\Http\Controllers\Admin\InquiryController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SettingController;
use App\Models\Correspondence;
use App\Models\Inquiry;
use App\Models\Project;
use App\Models\Service;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

Route::get('/server-init', function () {
    try {
        $output = '';
        try {
            Artisan::call('storage:link');
            $output .= "<b>Storage Link:</b> " . Artisan::output() . "<br>";
        } catch (\Throwable $e) {
            $output .= "<b>Storage Link:</b> " . $e->getMessage() . "<br>";
        }

        Artisan::call('config:clear');
        $output .= "<b>Config Clear:</b> " . Artisan::output() . "<br>";

        Artisan::call('cache:clear');
        $output .= "<b>Cache Clear:</b> " . Artisan::output() . "<br>";

        Artisan::call('view:clear');
        $output .= "<b>View Clear:</b> " . Artisan::output() . "<br>";

        return "<div style='font-family:sans-serif;padding:30px;line-height:1.8;direction:ltr;'>
            <h2 style='color:#16a34a;'>✅ Server Setup & Cache Clear Completed Successfully!</h2>
            <div style='background:#f1f5f9;padding:15px;border-radius:8px;font-family:monospace;margin:15px 0;'>{$output}</div>
            <p>
                <a href='/' style='display:inline-block;padding:10px 20px;background:#0f172a;color:#fff;text-decoration:none;border-radius:6px;font-weight:bold;margin-right:10px;'>Go to Website &rarr;</a>
                <a href='/artisan-optimize' style='display:inline-block;padding:10px 20px;background:#2563eb;color:#fff;text-decoration:none;border-radius:6px;font-weight:bold;'>Run Artisan Optimize &rarr;</a>
            </p>
        </div>";
    } catch (\Throwable $e) {
        return "<div style='font-family:sans-serif;padding:30px;color:#dc2626;direction:ltr;'>
            <h2>❌ Initialization Error</h2>
            <pre style='background:#fee2e2;padding:15px;border-radius:8px;'>" . htmlspecialchars($e->getMessage()) . "</pre>
        </div>";
    }
});

// Run Artisan Optimize
Route::get('/artisan-optimize', function () {
    try {
        $output = '';

        Artisan::call('config:cache');
        $output .= "<b>Config:</b> " . Artisan::output() . "<br>";

        Artisan::call('route:cache');
        $output .= "<b>Routes:</b> " . Artisan::output() . "<br>";

        Artisan::call('view:clear');
        $output .= "<b>Views:</b> " . Artisan::output() . "<br>";

        return "<div style='font-family:sans-serif;padding:30px;line-height:1.8;direction:ltr;'>
            <h2 style='color:#16a34a;'>⚡ Application Optimized Successfully!</h2>
            <div style='background:#f1f5f9;padding:15px;border-radius:8px;font-family:monospace;margin:15px 0;'>{$output}</div>
            <p>
                <a href='/' style='display:inline-block;padding:10px 20px;background:#0f172a;color:#fff;text-decoration:none;border-radius:6px;font-weight:bold;margin-right:10px;'>Go to Website &rarr;</a>
                <a href='/artisan-optimize-clear' style='display:inline-block;padding:10px 20px;background:#dc2626;color:#fff;text-decoration:none;border-radius:6px;font-weight:bold;'>Clear Optimization &rarr;</a>
            </p>
        </div>";
    } catch (\Throwable $e) {
        return "<div style='font-family:sans-serif;padding:30px;color:#dc2626;direction:ltr;'>
            <h2>❌ Optimization Error</h2>
            <pre style='background:#fee2e2;padding:15px;border-radius:8px;'>" . htmlspecialchars($e->getMessage()) . "</pre>
        </div>";
    }
});

// Run Artisan Optimize Clear
Route::get('/artisan-optimize-clear', function () {
    try {
        Artisan::call('optimize:clear');
        $output = nl2br(Artisan::output());

        return "<div style='font-family:sans-serif;padding:30px;line-height:1.8;direction:ltr;'>
            <h2 style='color:#16a34a;'>🧹 Optimization Cache Cleared!</h2>
            <div style='background:#f1f5f9;padding:15px;border-radius:8px;font-family:monospace;margin:15px 0;'>{$output}</div>
            <p>
                <a href='/' style='display:inline-block;padding:10px 20px;background:#0f172a;color:#fff;text-decoration:none;border-radius:6px;font-weight:bold;margin-right:10px;'>Go to Website &rarr;</a>
                <a href='/artisan-optimize' style='display:inline-block;padding:10px 20px;background:#2563eb;color:#fff;text-decoration:none;border-radius:6px;font-weight:bold;'>Re-Optimize &rarr;</a>
            </p>
        </div>";
    } catch (\Throwable $e) {
        return "<div style='font-family:sans-serif;padding:30px;color:#dc2626;direction:ltr;'>
            <h2>❌ Clear Error</h2>
            <pre style='background:#fee2e2;padding:15px;border-radius:8px;'>" . htmlspecialchars($e->getMessage()) . "</pre>
        </div>";
    }
});

Route::get('lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'ar'])) {
        Session::put('locale', $locale);
    }
    return redirect()->back();
})->name('lang.switch');

// Public Pages
Route::get('/', function () {
    $services = Service::where('is_featured', true)->orderBy('order')->take(6)->get();
    $projects = Project::where('is_featured', true)->orderBy('order')->take(6)->get();
    return view('pages.home', compact('services', 'projects'));
})->name('home');

Route::get('/services', function () {
    $services = Service::orderBy('order')->get();
    return view('pages.services', compact('services'));
})->name('services');

Route::get('/projects', function (Request $request) {
    $query = Project::query()->orderBy('order');
    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }
    $projects = $query->get();
    return view('pages.projects', compact('projects'));
})->name('projects');

Route::get('/about', function () {
    return view('pages.about');
})->name('about');

Route::get('/contact', function () {
    $services = Service::all();
    return view('pages.contact', compact('services'));
})->name('contact');

Route::post('/contact', function (Request $request) {
    $data = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'nullable|string|max:50',
        'service' => 'nullable|string|max:255',
        'subject' => 'nullable|string|max:255',
        'message' => 'required|string|max:3000',
    ]);

    Inquiry::create($data);

    $msg = app()->getLocale() == 'ar'
        ? 'شكراً لتواصلك مع أنماط للأعمال والاستشارات الهندسية. تم استلام رسالتك وسيتواصل معك فريقنا الهندسي في أقرب وقت.'
        : 'Thank you for reaching out to ANMAT Engineering Works & Consultancy. Your inquiry has been received and our engineering team will get in touch shortly.';

    return redirect()->route('contact')->with('success', $msg);
})->name('contact.submit');

// Document Public Verification
Route::get('/verify-document', function (Request $request) {
    $ref = $request->query('ref');
    $document = null;
    if ($ref) {
        $document = Correspondence::where('reference_number', trim($ref))->first();
    }
    return view('pages.verify-document', compact('document', 'ref'));
})->name('verify.document');

// Admin Dashboard
Route::get('/dashboard', function () {
    $stats = [
        'services' => Service::count(),
        'projects' => Project::count(),
        'correspondences' => Correspondence::count(),
        'inquiries' => Inquiry::count(),
        'new_inquiries' => Inquiry::where('status', 'new')->count(),
    ];
    $recentCorrespondences = Correspondence::latest('date_issued')->take(5)->get();
    $recentInquiries = Inquiry::latest()->take(5)->get();
    $recentProjects = Project::latest()->take(4)->get();

    return view('dashboard', compact('stats', 'recentCorrespondences', 'recentInquiries', 'recentProjects'));
})->middleware(['auth', 'verified'])->name('dashboard');

// Admin Panel Routes
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::resource('services', ServiceController::class);
    Route::resource('projects', ProjectController::class);
    Route::resource('correspondences', CorrespondenceController::class);
    Route::get('correspondences/{correspondence}/download', [CorrespondenceController::class, 'download'])->name('correspondences.download');

    // Live Site Settings
    Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('settings', [SettingController::class, 'update'])->name('settings.update');

    // Inquiries Manager
    Route::resource('inquiries', InquiryController::class)->only(['index', 'show', 'update', 'destroy']);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

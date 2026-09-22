<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::orderBy('order')->orderBy('id', 'desc')->get();
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title_ar' => 'required_without:title_en|nullable|string|max:255',
            'title_en' => 'required_without:title_ar|nullable|string|max:255',
            'category_ar' => 'nullable|string|max:255',
            'category_en' => 'nullable|string|max:255',
            'short_description_ar' => 'nullable|string',
            'short_description_en' => 'nullable|string',
            'description_ar' => 'nullable|string',
            'description_en' => 'nullable|string',
            'features_ar' => 'nullable|string',
            'features_en' => 'nullable|string',
            'icon' => 'nullable|string|max:100',
            'order' => 'nullable|integer',
            'is_featured' => 'nullable|boolean',
        ]);

        $service = new Service();
        $service->setTranslation('title', 'ar', $data['title_ar'] ?? $data['title_en']);
        $service->setTranslation('title', 'en', $data['title_en'] ?? $data['title_ar']);

        if (!empty($data['category_ar']) || !empty($data['category_en'])) {
            $service->setTranslation('category', 'ar', $data['category_ar'] ?? $data['category_en']);
            $service->setTranslation('category', 'en', $data['category_en'] ?? $data['category_ar']);
        }

        if (!empty($data['short_description_ar']) || !empty($data['short_description_en'])) {
            $service->setTranslation('short_description', 'ar', $data['short_description_ar'] ?? $data['short_description_en']);
            $service->setTranslation('short_description', 'en', $data['short_description_en'] ?? $data['short_description_ar']);
        }

        $service->setTranslation('description', 'ar', $data['description_ar'] ?? $data['description_en']);
        $service->setTranslation('description', 'en', $data['description_en'] ?? $data['description_ar']);

        if (!empty($data['features_ar']) || !empty($data['features_en'])) {
            $service->setTranslation('features', 'ar', $data['features_ar'] ?? $data['features_en']);
            $service->setTranslation('features', 'en', $data['features_en'] ?? $data['features_ar']);
        }

        $service->icon = $data['icon'] ?? 'compass';
        $service->order = $data['order'] ?? 0;
        $service->is_featured = $request->boolean('is_featured', true);
        $service->save();

        return redirect()->route('admin.services.index')->with('status', __('Service created successfully!'));
    }

    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $data = $request->validate([
            'title_ar' => 'required_without:title_en|nullable|string|max:255',
            'title_en' => 'required_without:title_ar|nullable|string|max:255',
            'category_ar' => 'nullable|string|max:255',
            'category_en' => 'nullable|string|max:255',
            'short_description_ar' => 'nullable|string',
            'short_description_en' => 'nullable|string',
            'description_ar' => 'nullable|string',
            'description_en' => 'nullable|string',
            'features_ar' => 'nullable|string',
            'features_en' => 'nullable|string',
            'icon' => 'nullable|string|max:100',
            'order' => 'nullable|integer',
            'is_featured' => 'nullable|boolean',
        ]);

        $service->setTranslation('title', 'ar', $data['title_ar'] ?? $data['title_en']);
        $service->setTranslation('title', 'en', $data['title_en'] ?? $data['title_ar']);

        $service->setTranslation('category', 'ar', $data['category_ar'] ?? $data['category_en'] ?? '');
        $service->setTranslation('category', 'en', $data['category_en'] ?? $data['category_ar'] ?? '');

        $service->setTranslation('short_description', 'ar', $data['short_description_ar'] ?? $data['short_description_en'] ?? '');
        $service->setTranslation('short_description', 'en', $data['short_description_en'] ?? $data['short_description_ar'] ?? '');

        $service->setTranslation('description', 'ar', $data['description_ar'] ?? $data['description_en']);
        $service->setTranslation('description', 'en', $data['description_en'] ?? $data['description_ar']);

        $service->setTranslation('features', 'ar', $data['features_ar'] ?? $data['features_en'] ?? '');
        $service->setTranslation('features', 'en', $data['features_en'] ?? $data['features_ar'] ?? '');

        $service->icon = $data['icon'] ?? $service->icon;
        $service->order = $data['order'] ?? $service->order;
        $service->is_featured = $request->boolean('is_featured', true);
        $service->save();

        return redirect()->route('admin.services.index')->with('status', __('Service updated successfully!'));
    }

    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('admin.services.index')->with('status', __('Service deleted successfully!'));
    }
}

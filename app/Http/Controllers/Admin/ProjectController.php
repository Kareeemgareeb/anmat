<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::orderBy('order')->orderBy('id', 'desc')->get();
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.projects.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title_ar' => 'required_without:title_en|nullable|string|max:255',
            'title_en' => 'required_without:title_ar|nullable|string|max:255',
            'category_ar' => 'nullable|string|max:255',
            'category_en' => 'nullable|string|max:255',
            'client_ar' => 'nullable|string|max:255',
            'client_en' => 'nullable|string|max:255',
            'location_ar' => 'nullable|string|max:255',
            'location_en' => 'nullable|string|max:255',
            'area' => 'nullable|string|max:100',
            'status' => 'required|in:completed,ongoing,planning',
            'completion_date' => 'nullable|date',
            'description_ar' => 'nullable|string',
            'description_en' => 'nullable|string',
            'image' => 'nullable|image|max:5120',
            'order' => 'nullable|integer',
            'is_featured' => 'nullable|boolean',
        ]);

        $project = new Project();
        $project->setTranslation('title', 'ar', $data['title_ar'] ?? $data['title_en']);
        $project->setTranslation('title', 'en', $data['title_en'] ?? $data['title_ar']);

        if (!empty($data['category_ar']) || !empty($data['category_en'])) {
            $project->setTranslation('category', 'ar', $data['category_ar'] ?? $data['category_en']);
            $project->setTranslation('category', 'en', $data['category_en'] ?? $data['category_ar']);
        }

        if (!empty($data['client_ar']) || !empty($data['client_en'])) {
            $project->setTranslation('client', 'ar', $data['client_ar'] ?? $data['client_en']);
            $project->setTranslation('client', 'en', $data['client_en'] ?? $data['client_ar']);
        }

        if (!empty($data['location_ar']) || !empty($data['location_en'])) {
            $project->setTranslation('location', 'ar', $data['location_ar'] ?? $data['location_en']);
            $project->setTranslation('location', 'en', $data['location_en'] ?? $data['location_ar']);
        }

        $project->setTranslation('description', 'ar', $data['description_ar'] ?? $data['description_en']);
        $project->setTranslation('description', 'en', $data['description_en'] ?? $data['description_ar']);

        $project->area = $data['area'] ?? null;
        $project->status = $data['status'] ?? 'completed';
        $project->completion_date = $data['completion_date'] ?? null;
        $project->order = $data['order'] ?? 0;
        $project->is_featured = $request->boolean('is_featured', true);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('projects', 'public');
            $project->image_path = $path;
        }

        $project->save();

        return redirect()->route('admin.projects.index')->with('status', __('Project created successfully!'));
    }

    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $data = $request->validate([
            'title_ar' => 'required_without:title_en|nullable|string|max:255',
            'title_en' => 'required_without:title_ar|nullable|string|max:255',
            'category_ar' => 'nullable|string|max:255',
            'category_en' => 'nullable|string|max:255',
            'client_ar' => 'nullable|string|max:255',
            'client_en' => 'nullable|string|max:255',
            'location_ar' => 'nullable|string|max:255',
            'location_en' => 'nullable|string|max:255',
            'area' => 'nullable|string|max:100',
            'status' => 'required|in:completed,ongoing,planning',
            'completion_date' => 'nullable|date',
            'description_ar' => 'nullable|string',
            'description_en' => 'nullable|string',
            'image' => 'nullable|image|max:5120',
            'order' => 'nullable|integer',
            'is_featured' => 'nullable|boolean',
        ]);

        $project->setTranslation('title', 'ar', $data['title_ar'] ?? $data['title_en']);
        $project->setTranslation('title', 'en', $data['title_en'] ?? $data['title_ar']);

        $project->setTranslation('category', 'ar', $data['category_ar'] ?? $data['category_en'] ?? '');
        $project->setTranslation('category', 'en', $data['category_en'] ?? $data['category_ar'] ?? '');

        $project->setTranslation('client', 'ar', $data['client_ar'] ?? $data['client_en'] ?? '');
        $project->setTranslation('client', 'en', $data['client_en'] ?? $data['client_ar'] ?? '');

        $project->setTranslation('location', 'ar', $data['location_ar'] ?? $data['location_en'] ?? '');
        $project->setTranslation('location', 'en', $data['location_en'] ?? $data['location_ar'] ?? '');

        $project->setTranslation('description', 'ar', $data['description_ar'] ?? $data['description_en']);
        $project->setTranslation('description', 'en', $data['description_en'] ?? $data['description_ar']);

        $project->area = $data['area'] ?? $project->area;
        $project->status = $data['status'] ?? $project->status;
        $project->completion_date = $data['completion_date'] ?? $project->completion_date;
        $project->order = $data['order'] ?? $project->order;
        $project->is_featured = $request->boolean('is_featured', true);

        if ($request->hasFile('image')) {
            if ($project->image_path && Storage::disk('public')->exists($project->image_path)) {
                Storage::disk('public')->delete($project->image_path);
            }
            $path = $request->file('image')->store('projects', 'public');
            $project->image_path = $path;
        }

        $project->save();

        return redirect()->route('admin.projects.index')->with('status', __('Project updated successfully!'));
    }

    public function destroy(Project $project)
    {
        if ($project->image_path && Storage::disk('public')->exists($project->image_path)) {
            Storage::disk('public')->delete($project->image_path);
        }
        $project->delete();
        return redirect()->route('admin.projects.index')->with('status', __('Project deleted successfully!'));
    }
}

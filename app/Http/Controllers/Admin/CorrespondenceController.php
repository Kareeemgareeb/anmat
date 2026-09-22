<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Correspondence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CorrespondenceController extends Controller
{
    public function index(Request $request)
    {
        $query = Correspondence::query()->latest('date_issued');

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('priority')) {
            $query->where('priority', $request->priority);
        }

        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('reference_number', 'LIKE', "%{$s}%")
                  ->orWhere('subject', 'LIKE', "%{$s}%")
                  ->orWhere('sender', 'LIKE', "%{$s}%")
                  ->orWhere('receiver', 'LIKE', "%{$s}%")
                  ->orWhere('physical_location', 'LIKE', "%{$s}%")
                  ->orWhere('tags', 'LIKE', "%{$s}%");
            });
        }

        $correspondences = $query->paginate(15);

        $counts = [
            'total' => Correspondence::count(),
            'outgoing' => Correspondence::where('type', 'outgoing')->count(),
            'incoming' => Correspondence::where('type', 'incoming')->count(),
            'internal' => Correspondence::where('type', 'internal')->count(),
            'technical' => Correspondence::whereIn('type', ['technical_report', 'contract_drawing'])->count(),
        ];

        return view('admin.correspondences.index', compact('correspondences', 'counts'));
    }

    public function create(Request $request)
    {
        $type = $request->get('type', 'outgoing');
        $suggestedReference = Correspondence::generateNextReference($type);
        return view('admin.correspondences.create', compact('suggestedReference', 'type'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'reference_number' => 'required|string|unique:correspondences,reference_number',
            'type' => 'required|string',
            'subject' => 'required|string|max:255',
            'sender' => 'required|string|max:255',
            'receiver' => 'required|string|max:255',
            'date_issued' => 'required|date',
            'status' => 'required|string',
            'priority' => 'nullable|string',
            'physical_location' => 'nullable|string|max:255',
            'tags' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
            'document' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png,zip,rar|max:20480',
        ]);

        $filePath = null;
        $fileName = null;
        $fileSize = null;

        if ($request->hasFile('document')) {
            $file = $request->file('document');
            $fileName = $file->getClientOriginalName();
            $fileSize = $file->getSize();
            $filePath = $file->store('correspondences');
        }

        Correspondence::create([
            'reference_number' => $data['reference_number'],
            'type' => $data['type'],
            'subject' => $data['subject'],
            'sender' => $data['sender'],
            'receiver' => $data['receiver'],
            'date_issued' => $data['date_issued'],
            'status' => $data['status'],
            'priority' => $data['priority'] ?? 'normal',
            'physical_location' => $data['physical_location'] ?? null,
            'tags' => $data['tags'] ?? null,
            'notes' => $data['notes'] ?? null,
            'file_path' => $filePath,
            'file_name' => $fileName,
            'file_size' => $fileSize,
        ]);

        return redirect()->route('admin.correspondences.index')->with('status', __('Correspondence & document archived successfully!'));
    }

    public function show(Correspondence $correspondence)
    {
        return view('admin.correspondences.show', compact('correspondence'));
    }

    public function edit(Correspondence $correspondence)
    {
        return view('admin.correspondences.edit', compact('correspondence'));
    }

    public function update(Request $request, Correspondence $correspondence)
    {
        $data = $request->validate([
            'reference_number' => 'required|string|unique:correspondences,reference_number,' . $correspondence->id,
            'type' => 'required|string',
            'subject' => 'required|string|max:255',
            'sender' => 'required|string|max:255',
            'receiver' => 'required|string|max:255',
            'date_issued' => 'required|date',
            'status' => 'required|string',
            'priority' => 'nullable|string',
            'physical_location' => 'nullable|string|max:255',
            'tags' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
            'document' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png,zip,rar|max:20480',
        ]);

        if ($request->hasFile('document')) {
            if ($correspondence->file_path && Storage::exists($correspondence->file_path)) {
                Storage::delete($correspondence->file_path);
            }
            $file = $request->file('document');
            $data['file_name'] = $file->getClientOriginalName();
            $data['file_size'] = $file->getSize();
            $data['file_path'] = $file->store('correspondences');
        }

        $correspondence->update($data);

        return redirect()->route('admin.correspondences.index')->with('status', __('Archived correspondence updated successfully!'));
    }

    public function download(Correspondence $correspondence)
    {
        if (!$correspondence->file_path || !Storage::exists($correspondence->file_path)) {
            abort(404, __('Document attachment not found.'));
        }

        $downloadName = $correspondence->file_name ?: ($correspondence->reference_number . '.' . pathinfo($correspondence->file_path, PATHINFO_EXTENSION));
        return Storage::download($correspondence->file_path, $downloadName);
    }

    public function destroy(Correspondence $correspondence)
    {
        if ($correspondence->file_path && Storage::exists($correspondence->file_path)) {
            Storage::delete($correspondence->file_path);
        }
        $correspondence->delete();
        return redirect()->route('admin.correspondences.index')->with('status', __('Correspondence deleted securely!'));
    }
}

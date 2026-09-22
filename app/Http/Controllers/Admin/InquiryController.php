<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use Illuminate\Http\Request;

class InquiryController extends Controller
{
    public function index(Request $request)
    {
        $query = Inquiry::query()->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('name', 'LIKE', "%{$s}%")
                  ->orWhere('email', 'LIKE', "%{$s}%")
                  ->orWhere('phone', 'LIKE', "%{$s}%")
                  ->orWhere('subject', 'LIKE', "%{$s}%")
                  ->orWhere('message', 'LIKE', "%{$s}%");
            });
        }

        $inquiries = $query->paginate(15);
        $counts = [
            'total' => Inquiry::count(),
            'new' => Inquiry::where('status', 'new')->count(),
            'contacted' => Inquiry::where('status', 'contacted')->count(),
            'closed' => Inquiry::where('status', 'closed')->count(),
        ];

        return view('admin.inquiries.index', compact('inquiries', 'counts'));
    }

    public function show(Inquiry $inquiry)
    {
        return view('admin.inquiries.show', compact('inquiry'));
    }

    public function update(Request $request, Inquiry $inquiry)
    {
        $data = $request->validate([
            'status' => 'required|in:new,contacted,in_progress,closed',
            'admin_notes' => 'nullable|string',
        ]);

        $inquiry->update($data);

        return redirect()->route('admin.inquiries.index')->with('status', __('Inquiry updated successfully!'));
    }

    public function destroy(Inquiry $inquiry)
    {
        $inquiry->delete();
        return redirect()->route('admin.inquiries.index')->with('status', __('Inquiry deleted successfully!'));
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->pluck('value', 'key');
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $data = $request->except(['_token', '_method']);

        foreach ($data as $key => $value) {
            // Group detection
            $group = 'general';
            if (str_starts_with($key, 'hero_')) $group = 'hero';
            elseif (str_starts_with($key, 'about_')) $group = 'about';
            elseif (str_starts_with($key, 'stat_')) $group = 'stats';

            Setting::set($key, $value, $group);
        }

        return redirect()->route('admin.settings.index')->with('status', __('Settings updated successfully!'));
    }
}

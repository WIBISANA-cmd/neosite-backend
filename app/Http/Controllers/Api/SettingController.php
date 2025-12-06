<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function show()
    {
        return Setting::first();
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'site_name' => ['nullable', 'string', 'max:255'],
            'logo_url' => ['nullable', 'url'],
            'favicon_url' => ['nullable', 'url'],
            'email' => ['nullable', 'email'],
            'whatsapp' => ['nullable', 'string', 'max:50'],
            'address' => ['nullable', 'string'],
            'operational_hours' => ['nullable', 'string', 'max:255'],
            'social_links' => ['nullable', 'array'],
            'default_seo' => ['nullable', 'array'],
        ]);

        $setting = Setting::first() ?? Setting::create([]);
        $setting->update($data);

        return $setting;
    }
}

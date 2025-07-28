<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    // Menampilkan halaman form pengaturan
    public function index()
    {
        // Ambil semua pengaturan dari database dan ubah menjadi format yang mudah diakses
        $settings = Setting::all()->pluck('value', 'key');
        return view('admin.settings.index', compact('settings'));
    }

    // Menyimpan atau memperbarui pengaturan
    public function update(Request $request)
    {
        $rules = [
            'hero_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'map_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
        ];

        $validated = $request->validate($rules);

        // Proses upload gambar hero
        if ($request->hasFile('hero_image')) {
            $this->updateImageSetting('hero_image', $request->file('hero_image'));
        }

        // Proses upload gambar peta
        if ($request->hasFile('map_image')) {
            $this->updateImageSetting('map_image', $request->file('map_image'));
        }

        return redirect()->route('admin.settings.index')->with('success', 'Pengaturan berhasil diperbarui.');
    }

    // Fungsi bantuan untuk update gambar
    private function updateImageSetting($key, $file)
    {
        // Cari setting yang ada
        $setting = Setting::find($key);

        // Hapus file lama jika ada
        if ($setting && $setting->value) {
            Storage::disk('public')->delete($setting->value);
        }

        // Simpan file baru
        $path = $file->store('settings', 'public');

        // Simpan path baru ke database
        Setting::updateOrCreate(
            ['key' => $key],
            ['value' => $path]
        );
    }
}

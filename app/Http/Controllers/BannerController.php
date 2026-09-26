<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\BannerPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $banners = Banner::with('photos')
            ->when($search, function ($query, $search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('subtitle', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.banner.index', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.banner.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'subtitle' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'photos.*' => ['required', 'image', 'mimes:jpeg,jpg,png', 'max:2048'],
        ]);

        $banner = Banner::create([
            'title' => $validated['title'],
            'subtitle' => $validated['subtitle'],
            'description' => $validated['description'],
        ]);

        // simpan galeri foto jika ada yang diunggah
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $index => $file) {
                $slugName = Str::slug($banner->title, '_');
                $extension = $file->getClientOriginalExtension();
                $fileName = 'banner_'.$slugName.'_'.time().'_'.($index + 1).'.'.$extension;

                $path = $file->storeAs('banner-photos', $fileName, 'public');

                BannerPhoto::create([
                    'banner_id' => $banner->id,
                    'photos' => $path,
                ]);
            }
        }

        return redirect()->route('banners.index')
            ->with('success', 'Banner added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Banner $banner)
    {
        $banner->load('photos');

        return view('admin.banner.edit', compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Banner $banner)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'subtitle' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'photos.*' => ['required', 'image', 'mimes:jpeg,jpg,png', 'max:2048'],
        ]);

        $banner->update([
            'title' => $validated['title'],
            'subtitle' => $validated['subtitle'],
            'description' => $validated['description'],
        ]);

        // tambah foto jika diunggah pada saat edit
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $index => $file) {
                $slugName = Str::slug($banner->title, '_');
                $extension = $file->getClientOriginalExtension();
                $fileName = 'banner_'.$slugName.'_'.time().'_'.($index + 1).'.'.$extension;

                $path = $file->storeAs('banner-photos', $fileName, 'public');

                BannerPhoto::create([
                    'banner_id' => $banner->id,
                    'photos' => $path,
                ]);
            }
        }

        return redirect()->route('banners.index')
            ->with('success', 'Banner updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Banner $banner)
    {
        // Hapus semua file foto fisik di folder public/storage
        foreach ($banner->photos as $photo) {
            if (Storage::disk('public')->exists($photo->photos)) {
                Storage::disk('public')->delete($photo->photos);
            }
        }

        $banner->delete();

        return redirect()->route('banners.index')
            ->with('success', 'Banner deleted successfully!');
    }

    // Method tambahan untuk menghapus satu foto galeri spesifik
    public function destroyPhoto($id)
    {
        $photo = BannerPhoto::findOrFail($id);

        if (Storage::disk('public')->exists($photo->photos)) {
            Storage::disk('public')->delete($photo->photos);
        }

        $photo->delete();

        return back()->with('success', 'Photo deleted from gallery.');
    }
}

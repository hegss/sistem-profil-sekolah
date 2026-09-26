<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\FacilityPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FacilityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $facilities = Facility::with('photos')
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('location', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.facilities.index', compact('facilities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.facilities.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'location' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'photos.*' => ['nullable', 'image', 'mimes:png,jpg,jpeg', 'max:2048'],
        ]);

        $facility = Facility::create([
            'name' => $validated['name'],
            'location' => $validated['location'],
            'description' => $validated['description'],
        ]);

        // Simpan Galeri Foto jika ada yang diunggah
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $index => $file) {
                $slugName = Str::slug($facility->name, '_');
                $extension = $file->getClientOriginalExtension();
                $fileName = 'img_facility_'.$slugName.'_'.time().'_'.($index + 1).'.'.$extension;

                $path = $file->storeAs('facility-photos', $fileName, 'public');

                FacilityPhoto::create([
                    'facility_id' => $facility->id,
                    'photos' => $path,
                ]);
            }
        }

        return redirect()->route('facilities.index')
            ->with('success', 'Data added successfully!');
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
    public function edit(Facility $facility)
    {
        $facility->load('photos');

        return view('admin.facilities.edit', compact('facility'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Facility $facility)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'description' => 'required|string',
            'photos.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $facility->update([
            'name' => $validated['name'],
            'location' => $validated['location'],
            'description' => $validated['description'],
        ]);

        // Tambah foto baru jika diunggah saat edit
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $index => $file) {
                $slugName = Str::slug($facility->name, '_');
                $extension = $file->getClientOriginalExtension();
                $fileName = 'img_facility_'.$slugName.'_'.time().'_'.($index + 1).'.'.$extension;

                $path = $file->storeAs('facility-photos', $fileName, 'public');

                FacilityPhoto::create([
                    'facility_id' => $facility->id,
                    'photos' => $path,
                ]);
            }
        }

        return redirect()->route('facilities.index')
            ->with('success', 'Data updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Facility $facility)
    {
        // Hapus semua file foto fisik di folder public/storage
        foreach ($facility->photos as $photo) {
            if (Storage::disk('public')->exists($photo->photos)) {
                Storage::disk('public')->delete($photo->photos);
            }
        }

        $facility->delete();

        return redirect()->route('facilities.index')
            ->with('success', 'Data deleted successfully!');
    }

    // Method tambahan untuk menghapus satu foto galeri spesifik
    public function destroyPhoto($id)
    {
        $photo = FacilityPhoto::findOrFail($id);

        if (Storage::disk('public')->exists($photo->photos)) {
            Storage::disk('public')->delete($photo->photos);
        }

        $photo->delete();

        return back()->with('success', 'Foto berhasil dihapus dari galeri!');
    }
}

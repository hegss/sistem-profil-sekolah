<?php

namespace App\Http\Controllers;

use App\Models\Extracurricular;
use App\Models\ExtracurricularPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ExtracurricularController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $extracurriculars = Extracurricular::with('photos')
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('schedule', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.extracurriculars.index', compact('extracurriculars'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.extracurriculars.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'logo' => ['nullable', 'image', 'mimes:png,jpg,jpeg', 'max:2048'],
            'schedule' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'photos.*' => ['required', 'image', 'mimes:jpeg,jpg,png', 'max:2048'],
        ]);

        // simpan logo ekskul jika ada yang diunggah
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');

            // format nama file
            $slugNames = Str::slug($request->name, '_');
            $extension = $file->getClientOriginalExtension();
            $fileName = 'logo_'.$slugNames.'_'.time().'.'.$extension;

            // simpan file dengan custom name file
            $validated['logo'] = $file->storeAs('extracurriculars/logo', $fileName, 'public');
        }

        $extracurricular = Extracurricular::create([
            'name' => $validated['name'],
            'logo' => $validated['logo'] ?? null,
            'schedule' => $validated['schedule'],
            'description' => $validated['description'],
        ]);

        // simpan galeri foto jika ada yang diunggah
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $index => $file) {
                $slugName = Str::slug($extracurricular->name, '_');
                $extension = $file->getClientOriginalExtension();
                $fileName = 'docs_of_'.$slugName.'_'.time().'_'.($index + 1).'.'.$extension;

                $path = $file->storeAs('extracurriculars/photos', $fileName, 'public');

                ExtracurricularPhoto::create([
                    'extracurricular_id' => $extracurricular->id,
                    'photos' => $path,
                ]);
            }
        }

        return redirect()->route('extracurriculars.index')
            ->with('success', 'Ekstrakurikuler berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Extracurricular $extracurricular)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Extracurricular $extracurricular)
    {
        $extracurricular->load('photos');

        return view('admin.extracurriculars.edit', compact('extracurricular'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Extracurricular $extracurricular)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'logo' => ['nullable', 'image', 'mimes:png,jpg,jpeg', 'max:2048'],
            'schedule' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'photos.*' => ['required', 'image', 'mimes:jpeg,jpg,png', 'max:2048'],
        ]);

        // simpan logo ekskul jika ada yang diunggah
        if ($request->hasFile('logo')) {
            // hapus foto lama jika ada
            if ($extracurricular->logo && Storage::disk('public')->exists($extracurricular->logo)) {
                Storage::disk('public')->delete($extracurricular->logo);
            }

            // nama file baru sesuai nama ekskul yang diupdate
            $file = $request->file('logo');
            $slugNames = Str::slug($request->name, '_');
            $extension = $file->getClientOriginalExtension();
            $fileName = 'logo_'.$slugNames.'_'.time().'.'.$extension;

            // simpan file dengan custom name file
            $validated['logo'] = $file->storeAs('extracurriculars/logo', $fileName, 'public');
        }

        $extracurricular->update([
            'name' => $validated['name'],
            'logo' => $validated['logo'] ?? null,
            'schedule' => $validated['schedule'],
            'description' => $validated['description'],
        ]);

        // simpan galeri foto jika ada yang diunggah
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $index => $file) {
                $slugName = Str::slug($extracurricular->name, '_');
                $extension = $file->getClientOriginalExtension();
                $fileName = 'docs_of_'.$slugName.'_'.time().'_'.($index + 1).'.'.$extension;

                $path = $file->storeAs('extracurriculars/photos', $fileName, 'public');

                ExtracurricularPhoto::create([
                    'extracurricular_id' => $extracurricular->id,
                    'photos' => $path,
                ]);
            }
        }

        return redirect()->route('extracurriculars.index')
            ->with('success', 'Ekstrakurikuler berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Extracurricular $extracurricular)
    {
        // hapus logo ekskul jika ada
        if ($extracurricular->logo && Storage::disk('public')->exists($extracurricular->logo)) {
            Storage::disk('public')->delete($extracurricular->logo);
        }

        $extracurricular->delete();

        return redirect()->route('extracurriculars.index')
            ->with('success', 'Ekstrakurikuler berhasil dihapus!');
    }

    public function destroyPhoto($id)
    {
        $photo = ExtracurricularPhoto::findOrFail($id);

        if (Storage::disk('public')->exists($photo->photos)) {
            Storage::disk('public')->delete($photo->photos);
        }

        $photo->delete();

        return back()->with('success', 'Foto berhasil dihapus dari galeri.');
    }
}

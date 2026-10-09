<?php

namespace App\Http\Controllers;

use App\Models\AcademicInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AcademicInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $academic_infos = AcademicInfo::when($search, function ($query, $search) {
            $query->where('title', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%");
        })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.academic_infos.index', compact('academic_infos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.academic_infos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'photo' => ['nullable', 'image', 'mimes:png,jpg,jpeg', 'max:2048'],
            'description' => ['required', 'string'],
            'info_link' => ['nullable', 'url'],
            'is_active' => ['required', 'boolean'],
        ]);

        $validated['is_active'] = $request->has('is_active');

        // simpan foto informasi jika ada yang diunggah
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');

            // format nama file
            $slugNames = Str::slug($request->title, '_');
            $extension = $file->getClientOriginalExtension();
            $fileName = 'img_'.$slugNames.'_'.time().'.'.$extension;

            // simpan file dengan custom name file
            $validated['photo'] = $file->storeAs('academic_info_photos', $fileName, 'public');
        }

        AcademicInfo::create($validated);

        return redirect()->route('academic_infos.index')
            ->with('success', 'Informasi Akademik berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(AcademicInfo $academicInfo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AcademicInfo $academicInfo)
    {
        return view('admin.academic_infos.edit', compact('academicInfo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AcademicInfo $academicInfo)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'photo' => ['nullable', 'image', 'mimes:png,jpg,jpeg', 'max:2048'],
            'description' => ['required', 'string'],
            'info_link' => ['nullable', 'url'],
            'is_active' => ['required', 'boolean'],
        ]);

        $validated['is_active'] = $request->has('is_active');

        // simpan foto informasi jika ada yang diunggah
        if ($request->hasFile('photo')) {
            // hapus foto lama jika ada
            if ($academicInfo->photo && Storage::disk('public')->exists($academicInfo->photo)) {
                Storage::disk('public')->delete($academicInfo->photo);
            }

            $file = $request->file('photo');

            // format nama file
            $slugNames = Str::slug($request->title, '_');
            $extension = $file->getClientOriginalExtension();
            $fileName = 'img_'.$slugNames.'_'.time().'.'.$extension;

            // simpan file dengan custom name file
            $validated['photo'] = $file->storeAs('academic_info_photos', $fileName, 'public');
        }

        $academicInfo->update($validated);

        return redirect()->route('academic_infos.index')
            ->with('success', 'Informasi akademik berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AcademicInfo $academicInfo)
    {
        // hapus foto informasi akademik
        if ($academicInfo->photo && Storage::disk('public')->exists($academicInfo->photo)) {
            Storage::disk('public')->delete($academicInfo->photo);
        }

        $academicInfo->delete();

        return redirect()->route('academic_infos.index')
            ->with('success', 'Informasi akademik berhasil dihapus!');
    }
}

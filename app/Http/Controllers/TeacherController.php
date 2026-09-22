<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Ambil keyword pencarian dari URL
        $search = $request->input('search');

        // Query data user dengan filter jika keyword search diisi
        $teachers = Teacher::when($search, function ($query, $search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('position', 'like', "%{$search}%");
            });
        })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.teachers.index', compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.teachers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'position' => ['required', 'string', 'max:255'],
            'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['is_active'] = $request->has('is_active');

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');

            // format nama file
            $slugNames = Str::slug($request->name, '_');
            $extension = $file->getClientOriginalExtension();
            $fileName = 'teacher_'.$slugNames.'_'.time().'.'.$extension;

            // simpan file dengan custom name file
            $validated['photo'] = $file->storeAs('teachers-photo', $fileName, 'public');
        }

        Teacher::create($validated);

        return redirect()->route('teachers.index')
            ->with('success', 'Teacher added successfully!');
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
    public function edit(Teacher $teacher)
    {
        return view('admin.teachers.edit', compact('teacher'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Teacher $teacher)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'position' => ['required', 'string', 'max:255'],
            'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['is_active'] = $request->has('is_active');

        // jika foto baru diunggah
        if ($request->hasFile('photo')) {
            // hapus foto lama
            if ($teacher->photo && Storage::disk('public')->exists($teacher->photo)) {
                Storage::disk('public')->delete($teacher->photo);
            }

            $file = $request->file('photo');
            // format nama file
            $slugNames = Str::slug($request->name, '_');
            $extension = $file->getClientOriginalExtension();
            $fileName = 'teacher_'.$slugNames.'_'.time().'.'.$extension;

            // simpan file dengan custom name file
            $validated['photo'] = $file->storeAs('teachers-photo', $fileName, 'public');
        }

        $teacher->update($validated);

        return redirect()->route('teachers.index')
            ->with('success', 'Data Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Teacher $teacher)
    {
        // hapus foto dari storage (jika ada)
        if ($teacher->photo && Storage::disk('public')->exists($teacher->photo)) {
            Storage::disk('public')->delete($teacher->photo);
        }

        $teacher->delete();

        return redirect()->route('teachers.index')
            ->with('success', 'Data deleted successfully!');
    }
}

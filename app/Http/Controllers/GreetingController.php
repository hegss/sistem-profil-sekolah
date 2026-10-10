<?php

namespace App\Http\Controllers;

use App\Models\Greeting;
use App\Models\Teacher;
use Illuminate\Http\Request;

class GreetingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $greetings = Greeting::with('teacher')
            ->when($search, function ($query, $search) {
                $query->whereHas('teacher', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                })->orWhere('greeting_text', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.greeting.index', compact('greetings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $teachers = Teacher::all();

        return view('admin.greeting.create', compact('teachers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'teacher_id' => ['required', 'exists:teachers,id'],
            'greeting_text' => ['required', 'string'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['is_active'] = $request->has('is_active');

        // Jika status diaktifkan, nonaktifkan sambutan lainnya agar hanya ada 1 sambutan aktif
        if ($validated['is_active']) {
            Greeting::where('is_active', true)->update(['is_active' => false]);
        }

        Greeting::create($validated);

        return redirect()->route('greetings.index')
            ->with('success', 'Kata sambutan berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Greeting $greeting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Greeting $greeting)
    {
        $teachers = Teacher::all();

        return view('admin.greeting.edit', compact('greeting', 'teachers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Greeting $greeting)
    {
        $validated = $request->validate([
            'teacher_id' => ['required', 'exists:teachers,id'],
            'greeting_text' => ['required', 'string'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['is_active'] = $request->has('is_active');

        // Jika status diaktifkan, nonaktifkan sambutan lainnya selain yang diedit
        if ($validated['is_active']) {
            Greeting::where('id', '!=', $greeting->id)->where('is_active', true)->update(['is_active' => false]);
        }

        $greeting->update($validated);

        return redirect()->route('greetings.index')
            ->with('success', 'Kata sambutan berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Greeting $greeting)
    {
        $greeting->delete();

        return redirect()->route('greetings.index')
            ->with('success', 'Kata sambutan berhasil dihapus!');
    }
}

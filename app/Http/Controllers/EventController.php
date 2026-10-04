<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');

        $events = Event::with('photos')
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('schedule', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.events.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'schedule' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'photos.*' => ['required', 'image', 'mimes:png,jpg,jpeg', 'max:2048'],
        ]);

        $event = Event::create([
            'name' => $validated['name'],
            'schedule' => $validated['schedule'],
            'description' => $validated['description'],
        ]);

        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $index => $file) {
                $slugName = Str::slug($event->name, '_');
                $extension = $file->getClientOriginalExtension();
                $fileName = 'docs_of_'.$slugName.'_'.time().'_'.($index + 1).'.'.$extension;

                $path = $file->storeAs('event-photos', $fileName, 'public');

                EventPhoto::create([
                    'event_id' => $event->id,
                    'photos' => $path,
                ]);
            }
        }

        return redirect()->route('events.index')
            ->with('success', 'Data acara berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        $event->load('photos');

        return view('admin.events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'schedule' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'photos.*' => ['required', 'image', 'mimes:png,jpg,jpeg', 'max:2048'],
        ]);

        $event->update([
            'name' => $validated['name'],
            'schedule' => $validated['schedule'],
            'description' => $validated['description'],
        ]);

        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $index => $file) {
                $slugName = Str::slug($event->name, '_');
                $extension = $file->getClientOriginalExtension();
                $fileName = 'docs_of_'.$slugName.'_'.time().'_'.($index + 1).'.'.$extension;

                $path = $file->storeAs('event-photos', $fileName, 'public');

                EventPhoto::create([
                    'event_id' => $event->id,
                    'photos' => $path,
                ]);
            }
        }

        return redirect()->route('events.index')
            ->with('success', 'Data acara berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        // Hapus semua file foto fisik di folder public/storage
        foreach ($event->photos as $photo) {
            if (Storage::disk('public')->exists($photo->photos)) {
                Storage::disk('public')->delete($photo->photos);
            }

            $event->delete();

            return redirect()->route('events.index')
                ->with('success', 'Data acara berhasil dihapus!');
        }
    }

    // Method tambahan untuk menghapus satu foto galeri spesifik
    public function destroyPhoto($id)
    {
        $photo = EventPhoto::findOrFail($id);

        // hapus file foto dari folder public storage
        if (Storage::disk('public')->exists($photo->photos)) {
            Storage::disk('public')->delete($photo->photos);
        }

        $photo->delete();

        return back()->with('success', 'Foto berhasil dihapus dari galeri!');
    }
}

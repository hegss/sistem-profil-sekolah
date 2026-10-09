<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Query data berita dengan filter jika keyword search diisi
        $news = News::when($search, function ($query, $search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.news.index', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.news.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'photo' => ['nullable', 'image', 'mimes:png,jpg,jpeg', 'max:2048'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        // simpan foto berita jika ada yang diunggah
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');

            // format nama file
            $slugNames = Str::slug($request->title, '_');
            $extension = $file->getClientOriginalExtension();
            $fileName = 'news_'.$slugNames.'_'.time().'.'.$extension;

            // simpan file dengan custom name file
            $validated['photo'] = $file->storeAs('news-photos', $fileName, 'public');
        }

        // Otomatis set tanggal posting ke tanggal hari ini (YYYY-MM-DD)
        $validated['publish_date'] = now()->toDateString();

        $validated['is_active'] = $request->has('is_active');

        News::create($validated);

        return redirect()->route('news.index')
            ->with('success', 'Berita berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(News $news)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(News $news)
    {
        return view('admin.news.edit', compact('news'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, News $news)
    {
        $validated = $request->validate([
            'photo' => ['required', 'image', 'mimes:png,jpg,jpeg', 'max:2048'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        // simpan foto berita jika ada yang diunggah
        if ($request->hasFile('photo')) {
            // hapus foto lama jika ada
            if ($news->photo && Storage::disk('public')->exists($news->photo)) {
                Storage::disk('public')->delete($news->photo);
            }

            $file = $request->file('photo');

            // format nama file
            $slugNames = Str::slug($request->title, '_');
            $extension = $file->getClientOriginalExtension();
            $fileName = 'news_'.$slugNames.'_'.time().'.'.$extension;

            // simpan file dengan custom name file
            $validated['photo'] = $file->storeAs('news-photos', $fileName, 'public');
        }

        // Otomatis set tanggal posting ke tanggal hari ini (YYYY-MM-DD)
        $validated['publish_date'] = now()->toDateString();

        $validated['is_active'] = $request->has('is_active');

        $news->update($validated);

        return redirect()->route('news.index')
            ->with('success', 'Berita berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $news)
    {
        // hapus foto jika ada
        if ($news->photo && Storage::disk('public')->exists($news->photo)) {
            Storage::disk('public')->delete($news->photo);
        }

        $news->delete();

        return redirect()->route('news.index')
            ->with('success', 'Berita berhasil dihapus!');
    }
}

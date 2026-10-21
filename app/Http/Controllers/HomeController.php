<?php

namespace App\Http\Controllers;

use App\Models\AcademicInfo;
use App\Models\Banner;
use App\Models\Event;
use App\Models\Extracurricular;
use App\Models\Greeting;
use App\Models\News;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    // Halaman Beranda
    public function index()
    {
        // banner aktif
        $activeBanner = Banner::with(['photos'])
            ->latest()
            ->first();

        $heroImages = [];

        if ($activeBanner && $activeBanner->photos && $activeBanner->photos->isNotEmpty()) {
            foreach ($activeBanner->photos as $photo) {
                // Ganti 'foto_path' dengan nama kolom foto di tabel banner_photos kamu (misal: 'foto', 'path', atau 'file_path')
                $path = $photo->photos ?? $photo->photos ?? $photo->photos;

                if ($path) {
                    $heroImages[] = asset('storage/'.$path);
                }
            }
        }

        // Jika data dari DB kosong, gunakan fallback gambar online
        if (empty($heroImages)) {
            $heroImages = [
                'https://images.unsplash.com/photo-1580582932707-520aed937b7b?q=80&w=1200',
                'https://images.unsplash.com/photo-1509062522246-3755977927d7?q=80&w=1200',
            ];
        }

        // sambutan kepala sekolah
        $activeGreeting = Greeting::with('teacher')
            ->where('is_active', true)
            ->first();

        // berita aktif
        $latestInfos = AcademicInfo::where('is_active', true)
            ->latest('created_at')
            ->take(6)
            ->get();

        // ekstrakurikuler aktif
        $activeExtracurricular = Extracurricular::latest()->get();

        // ringkasan jumlah data statistik
        $totalStudents = class_exists(Student::class) ? Student::count() : 1250;
        $totalTeachers = class_exists(Teacher::class) ? Teacher::count() : 45;
        $totalEkskul = Extracurricular::count();

        return view('home', compact(
            'heroImages',
            'activeBanner',
            'activeGreeting',
            'latestInfos',
            'activeExtracurricular',
            'totalStudents',
            'totalTeachers',
            'totalEkskul',
        ));
    }

    // Halaman Profil Sekolah
    public function profile()
    {
        // ambil data kepala sekolah
        $headmaster = Teacher::where(function ($query) {
            $query->where('position', 'like', '%Kepala Sekolah%')
                ->where('position', 'not like', '%Wakil %');
        })->first();

        // ambil data wakil kepala sekolah
        $viceheadmaster = Teacher::where('position', 'like', '%Wakil %')->first();

        // ambil daftar guru selain kepsek dan wakepsek
        $teachers = Teacher::when($headmaster || $viceheadmaster, function ($query) use ($headmaster, $viceheadmaster) {
            $ids = array_filter([$headmaster?->id, $viceheadmaster?->id]);

            return $query->whereNotIn('id', $ids);
        })
            ->get();

        return view('school-profile', compact('headmaster', 'viceheadmaster', 'teachers'));
    }

    // Halaman Ekstrakurikuler
    public function extracurriculars()
    {
        $extracurriculars = Extracurricular::with(['photos' => function ($query) {
            $query->latest();
        }])->latest()->get();

        return view('extracurriculars', compact('extracurriculars'));
    }

    // Halaman Event Sekolah
    public function events()
    {
        $events = Event::with(['photos' => function ($query) {
            $query->latest();
        }])->latest()->get();

        return view('events', compact('events'));
    }

    // Halaman Informasi Akademik
    public function academic_infos()
    {
        $academicInfos = AcademicInfo::where('is_active', true)
            ->latest()
            ->get();

        return view('academic-info', compact('academicInfos'));
    }

    // Halaman Berita
    public function newsIndex(Request $request)
    {
        $search = $request->input('search');

        // Query data berita dengan filter jika keyword search diisi
        $allNews = News::when($search, function ($query, $search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('news-index', compact('allNews'));
    }

    // Halaman Detail Berita
    public function newsDetail($id)
    {
        $news = News::where('is_active', true)->findOrFail($id);

        // ambil 3 berita lainnya untuk rekomendasi
        $recentNews = News::where('is_active', true)
            ->where('id', '!=', $id)
            ->latest('publish_date')
            ->take(3)
            ->get();

        return view('news-detail', compact('news', 'recentNews'));
    }
}

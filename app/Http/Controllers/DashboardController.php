<?php

namespace App\Http\Controllers;

use App\Models\Extracurricular;
use App\Models\Facility;
use App\Models\Student;
use App\Models\Teacher;
use Spatie\Activitylog\Models\Activity;

class DashboardController extends Controller
{
    public function index()
    {
        // jumlah siswa aktif
        $activeStudents = Student::where('is_active', true)->count();

        // jumlah guru yang aktif
        $activeTeacher = Teacher::where('is_active', true)->count();

        // jumlah fasilitas yang tersedia
        $totalFacilities = Facility::count();

        // jumlah ekstrakurikuler yang tersedia
        $totalExtracurricular = Extracurricular::count();

        // ambil 5 riwayat aktivitas terbaru beserta data admin (causer) & data yang diubah (subject)
        $recentActivities = Activity::with(['causer', 'subject'])
            ->latest()
            ->get();

        return view('admin.dashboard', compact(
            'recentActivities',
            'activeStudents',
            'activeTeacher',
            'totalFacilities',
            'totalExtracurricular'));
    }
}

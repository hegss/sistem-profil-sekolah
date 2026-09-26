<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\Teacher;
use Spatie\Activitylog\Models\Activity;

class DashboardController extends Controller
{
    public function index()
    {
        // jumlah guru yang aktif
        $activeTeacher = Teacher::where('is_active', true)->count();

        // jumlah fasilitas yang tersedia
        $totalFacilities = Facility::count();

        // ambil 5 riwayat aktivitas terbaru beserta data admin (causer) & data yang diubah (subject)
        $recentActivities = Activity::with(['causer', 'subject'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('recentActivities', 'activeTeacher', 'totalFacilities'));
    }
}

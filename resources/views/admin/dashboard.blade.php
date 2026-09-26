<x-admin-layout>
    <!-- Dashboard Page -->
    <div class="p-4 space-y-4 bg-gray-50 dark:bg-gray-900 min-h-screen">

        <!-- 1. STAT CARDS GRID -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

            <!-- Total Siswa -->
            <div
                class="bg-white dark:bg-gray-800 p-5 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 flex items-center justify-between">
                <div>
                    <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Students</p>
                    <h3 class="text-2xl font-bold text-blue-950 dark:text-gray-100 mt-1">1.250</h3>
                </div>
                <div class="p-3 bg-blue-100 dark:bg-blue-800 rounded-xl text-blue-600 dark:text-blue-200">
                    <x-students-icon class="size-6" />
                </div>
            </div>

            <!-- Total Guru -->
            <div
                class="bg-white dark:bg-gray-800 p-5 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 flex items-center justify-between">
                <div>
                    <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Teachers</p>
                    <h3 class="text-2xl font-bold text-blue-950 dark:text-gray-100 mt-1">{{ number_format($activeTeacher) }}</h3>
                </div>
                <div class="p-3 bg-emerald-100 dark:bg-emerald-800 rounded-xl text-emerald-600 dark:text-emerald-200">
                    <x-teachers-icon class="size-6" />
                </div>
            </div>

            <!-- Total Fasilitas -->
            <div
                class="bg-white dark:bg-gray-800 p-5 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 flex items-center justify-between">
                <div>
                    <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Facilities</p>
                    <h3 class="text-2xl font-bold text-blue-950 dark:text-gray-100 mt-1">{{ number_format($totalFacilities) }}</h3>
                </div>
                <div class="p-3 bg-amber-100 dark:bg-amber-800 rounded-xl text-amber-600 dark:text-amber-200">
                    <x-facilities-icon class="size-6" />
                </div>
            </div>

            <!-- Kegiatan Aktif -->
            <div
                class="bg-white dark:bg-gray-800 p-5 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 flex items-center justify-between">
                <div>
                    <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Extracurriculars</p>
                    <h3 class="text-2xl font-bold text-blue-950 dark:text-gray-100 mt-1">12</h3>
                </div>
                <div class="p-3 bg-purple-100 dark:bg-purple-800 rounded-xl text-purple-600 dark:text-purple-200">
                    <x-activities-icon class="size-6" />
                </div>
            </div>

        </div>

        <!-- 2. GRAFIK PENGUNJUNG & RINGKASAN AKTIVITAS -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <!-- Area Grafik (2 Kolom) -->
            <div
                class="lg:col-span-2 bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h3 class="text-base font-semibold text-blue-950 dark:text-gray-100">Visitor Statistics</h3>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Number of website visitors per month</p>
                    </div>
                </div>
                <div class="relative w-full h-72">
                    <canvas id="visitorChart"></canvas>
                </div>
            </div>

            <!-- Log Aktivitas Admin (1 Kolom) -->
            <div
                class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700">
                <h3 class="text-base font-semibold text-blue-950 dark:text-gray-100 mb-1">Recent Activities</h3>
                <p class="text-xs text-gray-500 dark:text-gray-400 mb-4">History of data changes by admin</p>

                <div class="space-y-4">
                    @forelse ($recentActivities as $activity)
                        <div class="flex items-start gap-3 p-2.5 rounded-xl bg-gray-50 dark:bg-gray-700/30 transition">

                            <!-- Icon Sesuai Aksi (Created / Updated / Deleted) -->
                            @if ($activity->event === 'created')
                                <div
                                    class="p-2 rounded-lg bg-emerald-100 dark:bg-emerald-950/60 text-emerald-600 dark:text-emerald-400 shrink-0">
                                    <svg class="size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4v16m8-8H4" />
                                    </svg>
                                </div>
                            @elseif ($activity->event === 'updated')
                                <div
                                    class="p-2 rounded-lg bg-amber-100 dark:bg-amber-950/60 text-amber-600 dark:text-amber-400 shrink-0">
                                    <svg class="size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </div>
                            @elseif ($activity->event === 'deleted')
                                <div
                                    class="p-2 rounded-lg bg-rose-100 dark:bg-rose-950/60 text-rose-600 dark:text-rose-400 shrink-0">
                                    <svg class="size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </div>
                            @endif

                            <!-- Detail Deskripsi Log -->
                            <div class="flex flex-col flex-1 min-w-0">
                                <span class="text-xs font-bold text-gray-800 dark:text-gray-200 truncate">
                                    {{ $activity->description }}
                                </span>
                                <span class="text-[11px] text-gray-400 truncate">
                                    Oleh: <span
                                        class="font-semibold text-gray-600 dark:text-gray-300">{{ $activity->causer->name ?? 'Sistem' }}</span>
                                    @if ($activity->subject)
                                        — "{{ $activity->subject->name ?? ($activity->subject->nama_lengkap ?? '') }}"
                                    @endif
                                </span>
                                <span class="text-[10px] text-gray-400 mt-0.5">
                                    {{ $activity->created_at->diffForHumans() }}
                                </span>
                            </div>

                        </div>
                    @empty
                        <p class="text-center text-xs text-gray-400 py-4">Belum ada riwayat aktivitas.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const ctx = document.getElementById('visitorChart').getContext('2d');

                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov',
                            'Des'
                        ],
                        datasets: [{
                            label: 'Jumlah Pengunjung',
                            data: [20, 60, 80, 100, 120, 140, 160, 180, 200, 220, 240, 260],
                            borderColor: '#2563eb', // Warna biru tailwind
                            backgroundColor: 'rgba(37, 99, 235, 0.1)',
                            fill: true,
                            tension: 0.4, // Membuat garis grafik melengkung halus
                            pointRadius: 4,
                            pointHoverRadius: 6
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false // Sembunyikan label legend di atas
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                grid: {
                                    color: '#f3f4f6'
                                }
                            },
                            x: {
                                grid: {
                                    display: false
                                }
                            }
                        }
                    }
                });
            });
        </script>
    @endpush
</x-admin-layout>

<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Http\Request;

class ComplaintController extends Controller
{
    public function index(Request $request)
    {
        // filter status
        $filter = Complaint::latest();

        if ($request->has('status') && $request->status != '') {
            $filter->where('status', $request->status);
        }

        // input search
        $search = $request->input('search');

        // Query data berita dengan filter jika keyword search diisi
        $complaints = $filter->when($search, function ($query, $search) {
            $query->where(function ($q) use ($search) {
                $q->where('referral_code', 'like', "%{$search}%")
                    ->orWhere('sender_name', 'like', "%{$search}%")
                    ->orWhere('message', 'like', "%{$search}%");
            });
        })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.complaints.index', compact('complaints'));
    }

    // keluhan dari user
    public function store(Request $request)
    {
        $validated = $request->validate([
            'referral_code' => ['required', 'string', 'exists:referral_codes,reff_code'],
            'sender_name' => ['required', 'string', 'max:255'],
            'sender_phone' => ['required', 'string', 'max:20'],
            'category' => ['required', 'in:infrastructure,learning,others'],
            'message' => ['required', 'string'],
        ]);

        Complaint::create([
            'referral_code' => $validated['referral_code'],
            'sender_name' => $validated['sender_name'],
            'sender_phone' => $validated['sender_phone'],
            'category' => $validated['category'],
            'message' => $validated['message'],
            'status' => 'accepted',
        ]);

        return redirect()->back()->with('success', 'Keluhan berhasil dikirim!');
    }

    // FAQ's
    public function faqs()
    {
        // Template Pertanyaan Umum beserta Jawabannya
        $faqs = [
            [
                'question' => 'Bagaimana prosedur pendaftaran siswa baru (PPDB) di SDN Gedong 12?',
                'answer' => 'Pendaftaran PPDB dilakukan secara online melalui portal resmi PPDB DKI Jakarta atau datang langsung ke sekretariat PPDB sekolah pada jam kerja dengan membawa dokumen persyaratan.',
            ],
            [
                'question' => 'Apa saja persyaratan berkas untuk siswa pindahan?',
                'answer' => 'Berkas yang dibutuhkan meliputi Surat Permohonan Pindah, Surat Keterangan Pindah dari sekolah asal, FC Rapor terakhir, FC Akta Kelahiran, FC Kartu Keluarga, dan NISN.',
            ],
            [
                'question' => 'Berapa jam operasional kegiatan belajar mengajar (KBM)?',
                'answer' => 'KBM berlangsung dari hari Senin hingga Jumat. Untuk kelas rendah (1-3) Pukul 06.30 - 11.30 WIB, dan kelas tinggi (4-6) Pukul 06.30 - 12.30 WIB.',
            ],
            [
                'question' => 'Bagaimana alur pengajuan beasiswa / KJP di SDN Gedong 12?',
                'answer' => 'Pengajuan KJP dilakukan saat pembukaan kuota resmi dari Pemprov DKI Jakarta melalui wali kelas dengan melampirkan berkas kelengkapan administrasi dan surat keterangan tidak mampu.',
            ],
            [
                'question' => 'Apakah ada iuran bulanan untuk kegiatan ekstrakurikuler?',
                'answer' => 'Sebagian besar kegiatan ekstrakurikuler wajib di SDN Gedong 12 tidak dipungut biaya bulanan karena didukung oleh fasilitas sekolah.',
            ],
        ];

        return view('faqs-index', compact('faqs'));
    }

    // update status keluhan
    public function updateStatus(Request $request, Complaint $complaint)
    {
        $request->validate([
            'status' => ['required', 'in:accepted,processing,done'],
        ]);

        $complaint->update([
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success', 'Status keluhan diperbarui!');
    }

    // hapus keluhan (jika hanya status done)
    public function destroy(Complaint $complaint)
    {
        if ($complaint->status !== 'done') {
            return redirect()->back()->with('error', 'Hanya keluhan dengan status "Selesai" yang dapat dihapus.');
        }

        $complaint->delete();

        return redirect()->back()->with('success', 'Data keluhan berhasil dihapus!');
    }
}

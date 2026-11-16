<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use App\Models\Question;
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

        return redirect()->route('faqs')->with('success', 'Keluhan berhasil dikirim!');
    }

    // FAQ's
    public function faqs()
    {
        // Template Pertanyaan Umum beserta Jawabannya
        $faqs = Question::where('is_active', true)->latest()->get();

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

        return redirect()->route('complaints.index')->with('success', 'Status keluhan diperbarui!');
    }

    // hapus keluhan (jika hanya status done)
    public function destroy(Complaint $complaint)
    {
        if ($complaint->status !== 'done') {
            return redirect()->route('complaints.index')->with('error', 'Hanya keluhan dengan status "Selesai" yang dapat dihapus.');
        }

        $complaint->delete();

        return redirect()->route('complaints.index')->with('success', 'Data keluhan berhasil dihapus!');
    }
}

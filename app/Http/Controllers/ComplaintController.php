<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Http\Request;

class ComplaintController extends Controller
{
    public function index(Request $request)
    {
        // filter status
        $query = Complaint::latest();

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // input search
        $search = $request->input('search');

        // Query data berita dengan filter jika keyword search diisi
        $complaints = Complaint::when($search, function ($query, $search) {
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

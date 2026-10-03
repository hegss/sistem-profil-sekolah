<?php

namespace App\Http\Controllers;

use App\Models\ReferralCode;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ReferralCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $referrals = ReferralCode::when($search, function ($query, $search) {
            $query->where('class', 'like', "%{$search}%")
                ->orWhere('reff_code', 'like', "%{$search}%");
        })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.referrals.index', compact('referrals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.referrals.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $cleanClass = strtoupper(preg_replace('/[^a-zA-Z0-9]/', '', $request->input('class')));
        $shift = strtoupper($request->input('shift'));

        // Format kode referral di backend secara otomatis (contoh: REF-1A-P)
        $autoReffCode = "REF-{$cleanClass}-{$shift}";

        // Masukkan kode tersebut ke dalam request agar ikut tervalidasi keunikannya
        $request->merge([
            'reff_code' => $autoReffCode,
        ]);

        $validated = $request->validate([
            'class' => ['required', 'string', 'max:255'],
            'shift' => ['required', 'in:P,S'],
            'reff_code' => ['required', 'string', 'max:50', 'unique:referral_codes,reff_code'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['reff_code'] = strtoupper(trim($validated['reff_code']));

        ReferralCode::create($validated);

        return redirect()->route('referrals.index')
            ->with('success', 'Referral code added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ReferralCode $referral)
    {
        return view('admin.referrals.edit', compact('referral'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ReferralCode $referral)
    {
        // Bersihkan nilai class & shift
        $cleanClass = strtoupper(preg_replace('/[^a-zA-Z0-9]/', '', $request->input('class')));
        $shift = strtoupper($request->input('shift'));

        // Buat kode referral otomatis
        $autoReffCode = "REF-{$cleanClass}-{$shift}";

        $request->merge([
            'reff_code' => $autoReffCode,
        ]);

        $validated = $request->validate([
            'class' => ['required', 'string', 'max:255'],
            'shift' => ['required', 'in:P,S'],
            'reff_code' => ['required', 'string', 'max:50', Rule::unique('referral_codes', 'reff_code')->ignore($referral->id)],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['is_active'] = $request->has('is_active');

        $referral->update($validated);

        return redirect()->route('referrals.index')
            ->with('success', 'Referral code updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $referral = ReferralCode::findOrFail($id);

        $referral->forceDelete();

        return redirect()->route('referrals.index')
            ->with('success', 'Referral code deleted successfully!');
    }
}

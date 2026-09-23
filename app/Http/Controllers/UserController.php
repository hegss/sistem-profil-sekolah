<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Ambil keyword pencarian dari URL
        $search = $request->input('search');

        // Query data user dengan filter jika keyword search diisi
        $users = User::where('id', '!=', auth()->id())
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('username', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('phone', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString(); // Memastikan keyword search tetap terbawa saat berpindah halaman (pagination)

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'max:255', 'email', 'unique:users'],
            'phone' => ['required', 'string', 'max:20'],
            'role' => ['required', 'string', 'in:admin,user'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ]);

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');

            // format nama file
            $slugNames = Str::slug($request->name, '_');
            $extension = $file->getClientOriginalExtension();
            $fileName = 'img_profile_'.$slugNames.'_'.time().'.'.$extension;

            // simpan file dengan custom name file
            $validated['photo'] = $file->storeAs('photo-profile', $fileName, 'public');
        }

        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return redirect()->route('users.index')
            ->with('success', 'Data added successfully!');
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
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($user->id)],
            'email' => ['required', 'string', 'max:255', 'email', Rule::unique('users')->ignore($user->id)],
            'phone' => ['required', 'string', 'max:20'],
            'role' => ['nullable', 'string', 'in:admin,user'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ]);

        // jika foto baru diunggah
        if ($request->hasFile('photo')) {
            // hapus foto lama jika ada
            if ($user->photo && Storage::disk('public')->exists($user->photo)) {
                Storage::disk('public')->delete($user->photo);
            }

            // nama file baru sesuai nama user yang diupdate
            $file = $request->file('photo');
            $slugName = Str::slug($request->name, '_');
            $extension = $file->getClientOriginalExtension();
            $fileName = 'img_profile_'.$slugName.'_'.time().'.'.$extension;

            // simpan file baru
            $validated['photo'] = $file->storeAs('photo-profile', $fileName, 'public');
        }

        // update password hanya jika di isi
        if ($request->filled('password')) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('users.index')
            ->with('success', 'Data updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // cegah admin menghapus diri sendiri
        if ($user->id === auth()->id()) {
            return back()->with('error', 'You cannot delete the account yourself.');
        }

        // hapus foto dari storage jika ada
        if ($user->photo && Storage::disk('public')->exists($user->photo)) {
            Storage::disk('public')->delete($user->photo);
        }

        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'Data deleted successfully!');
    }
}

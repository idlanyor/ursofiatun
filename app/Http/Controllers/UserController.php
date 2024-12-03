<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
    /**
     * Register a new user.
     */
    public function register(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'email' => 'nullable|email',
            'username' => 'required|string|unique:users,username',
            'password' => 'required|string|confirmed',
        ]);
        User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'role' => 'pengurus',
            'status' => 'pending',
        ]);
        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }
    /**
     * Log in the current user.
     */
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);
        $credentials = $request->only('username', 'password');
        if (Auth::attempt($credentials)) {
            return $request->session()->regenerate();
            // return redirect()->intended(route('home', absolute: false));
        }
        if ($request->username && $request->password) {
            return response()->json(['message' => 'Username atau password salah.'], 401);
        }
        return response()->json(['message' => 'Username dan password harus diisi.'], 400);
    }
    /**
     * Log out the current user.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string',
            'email' => 'nullable|email',
            'soc_website' => 'nullable|string',
            'soc_github' => 'nullable|string',
            'soc_x' => 'nullable|string',
            'soc_ig' => 'nullable|string',
            'soc_fb' => 'nullable|string',
            'alamat' => 'nullable|string',
            'notelp' => 'nullable|string',
            'username' => 'required|string|unique:users,username',
            'password' => 'required|string|confirmed',
            'role' => 'required|string|in:admin,pengurus',
            'status' => 'required|string|in:aktif,nonaktif,pending',
        ]);

        $validatedData['password'] = bcrypt($validatedData['password']);
        User::create($validatedData);

        return response()->json(['message' => 'Data berhasil disimpan.']);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = User::find($id);
        return response()->json($user);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user) {}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $user = User::find($id);

            // Validasi hanya field yang ada dalam request
            $rules = [];
            if ($request->has('nama')) {
                $rules['nama'] = 'required|string';
            }
            if ($request->has('email')) {
                $rules['email'] = 'nullable|email';
            }
            if ($request->has('soc_website')) {
                $rules['soc_website'] = 'nullable|string';
            }
            if ($request->has('soc_github')) {
                $rules['soc_github'] = 'nullable|string';
            }
            if ($request->has('soc_x')) {
                $rules['soc_x'] = 'nullable|string';
            }
            if ($request->has('soc_ig')) {
                $rules['soc_ig'] = 'nullable|string';
            }
            if ($request->has('soc_fb')) {
                $rules['soc_fb'] = 'nullable|string';
            }
            if ($request->has('alamat')) {
                $rules['alamat'] = 'nullable|string';
            }
            if ($request->has('notelp')) {
                $rules['notelp'] = 'nullable|string';
            }
            if ($request->has('username')) {
                $rules['username'] = 'required|string|unique:users,username,' . $id . ',id_user';
            }
            if ($request->has('role')) {
                $rules['role'] = 'required|string|in:admin,pengurus';
            }
            if ($request->has('status')) {
                $rules['status'] = 'required|string|in:aktif,nonaktif,pending';
            }

            $validatedData = $request->validate($rules);
            $user->update($validatedData);

            return response()->json(['message' => 'Data berhasil diperbarui.']);
        } catch (\Exception $e) {
            Log::error('Error updating user: ' . $e->getMessage());
            return response()->json(['error' => 'Terjadi kesalahan pada server'], 500);
        }
    }
    /**
     * Update the specified resource in storage.
     */
    public function updateRole($id, $role)
    {
        $user = User::find($id);
        $user->update(['role' => $role]);
        return response()->json(['message' => 'Role berhasil diperbarui.']);
    }
    public function updateStatus(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Validasi input
        $request->validate([
            'status' => 'required|string|in:aktif,pending',
        ]);

        // Update status
        $user->status = $request->input('status');
        $user->save();

        return response()->json(['message' => 'Status berhasil diperbarui.']);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();
            return response()->json(['success' => 'Data santri berhasil dihapus.']);
        } catch (\Exception $e) {
            Log::error('Error deleting santri: ' . $e->getMessage());
            return response()->json(['error' => 'Terjadi kesalahan saat menghapus data santri.'], 500);
        }
    }
    public function updatePassword(Request $request)
    {
        try {
            # Validasi
            $request->validate([
                'old_password' => 'required',
                'new_password' => 'required|confirmed',
            ]);

            # Cocokkan Password Lama
            if (!Hash::check($request->old_password, Auth::user()->password)) {
                return response()->json(['error' => 'Password lama tidak sesuai!', 'detail' => 'Password lama tidak sesuai!']);
            }

            # Perbarui Password Baru
            $user = User::find(Auth::user()->id_user);
            $user->update([
                'password' => Hash::make($request->new_password)
            ]);

            return response()->json(['message' => 'Password Berhasil diubah']);
        } catch (\Exception $e) {
            Log::error('Error updating password: ' . $e->getMessage());
            return response()->json(['error' => 'Terjadi kesalahan saat mengubah password.', 'detail' => $e->getMessage()]);
        }
    }
    public function updateFoto(Request $request)
    {
        try {

            $validatedData = $request->validate([
                'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $user = User::find(Auth::user()->id_user);
            $file = $validatedData['foto'];
            $filename = $file->store('public/images');
            $user->update([
                'foto_profil' => Str::replaceFirst('public', 'storage', $filename)
            ]);
            return response()->json(['message' => 'Foto profil berhasil diperbarui.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan saat mengganti foto profil', 'detail' => $e->getMessage()]);
        }
    }
}

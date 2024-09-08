<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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
            'username' => 'required|string|unique:users,username',
            'password' => 'required|string|confirmed',
            'role' => 'required|string|in:admin,pengurus',
        ]);
        $user = User::create([
            'nama' => $request->nama,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]);
        return redirect()->route('login');
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
            $request->session()->regenerate();
            return redirect()->intended(route('home', absolute: false));
        }
        return back()->withErrors([
            'username' => 'Username atau kata sandi tidak sesuai.',
        ]);
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
        $validator = Validator::make($request->alll([
            'nama' => 'required|string',
            'username' => 'required|string|unique:users,username',
            'password' => 'required|string|confirmed',
            'role' => 'required|string|in:admin,pengurus',
        ]));

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        User::create($validator->validated());;
        return response()->json(['message' => 'Data berhasil disimpan.']);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = User::find($id);
        return response()->json(['user' => $user->serialize()]);
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
        $user = User::find($id);
        $validator = Validator::make($request->alll([
            'nama' => 'required|string',
            'username' => 'required|string|unique:users,username',
            'password' => 'required|string|confirmed',
            'role' => 'required|string|in:admin,pengurus',
        ]));
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $user->update($validator->validated());
        return response()->json(['message' => 'Data berhasil diperbarui.']);
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return response()->json(['message' => 'Data berhasil dihapus.']);
    }
}

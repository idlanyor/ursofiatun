<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    public function register(Request $request){
        $request->validate([
            'nama'=>'required|string',
            'username'=>'required|string|unique:users,username',
            'password'=>'required|string|confirmed',
            'role'=>'required|string|in:admin,pengurus',
        ]);
        $user = User::create([
            'nama'=>$request->nama,
            'username'=>$request->username,
            'password'=>bcrypt($request->password),
            'role'=>$request->role,
        ]);
        return redirect()->route('login');
    }

    public function login(Request $request){
        $request->validate([
            'username'=>'required|string',
            'password'=>'required|string',
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
    public function logout(Request $request){
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

    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}

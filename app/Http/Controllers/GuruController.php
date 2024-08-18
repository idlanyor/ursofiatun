<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $guru = Guru::all();
        return view('module.guru.index', compact('guru'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('module.guru.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'nullable|string',
            'telepon' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Buat user baru untuk guru
        $user = User::create([
            'nama' => $request->nama,
            'username' => strtolower(str_replace(' ', '.', $request->nama)), // Buat username dari nama
            'password' => Hash::make('gurugurucertain'), // Set password default
            'role' => 'Guru', // Set role default
        ]);

        // Buat guru baru dengan id_user dari user yang baru dibuat
        $guru = Guru::create(array_merge(
            $validator->validated(),
            ['id_user' => $user->id]
        ));

        // Kirim pesan WebSocket setelah data berhasil disimpan
        // $this->sendWebSocketMessage('Data guru baru telah ditambahkan: ' . $guru->nama);

        return response()->json(['message' => 'Data berhasil disimpan'], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Guru $guru)
    {
        return response()->json($guru);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Guru $guru)
    {
        return response()->json($guru);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Guru $guru)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'nullable|string|max:500',
            'telepon' => 'nullable|string|max:15',
        ]);

        try {
            $guru->update([
                'nama' => $request->nama,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'jenis_kelamin' => $request->jenis_kelamin,
                'alamat' => $request->alamat,
                'telepon' => $request->telepon,
            ]);

            return response()->json(['success' => 'Data guru berhasil diupdate.']);
        } catch (\Exception $e) {
            Log::error('Error updating guru: ' . $e->getMessage());
            return response()->json(['error' => 'Terjadi kesalahan pada server'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Guru $guru)
    {
        try {
            $guru->delete();
            return response()->json(['success' => 'Data guru berhasil dihapus.']);
        } catch (\Exception $e) {
            Log::error('Error deleting guru: ' . $e->getMessage());
            return response()->json(['error' => 'Terjadi kesalahan saat menghapus data guru.'], 500);
        }
    }

    /**
     * Send a message via WebSocket.
     */
    protected function sendWebSocketMessage($message)
    {
        $socket = fsockopen('localhost', 8080, $errno, $errstr, 30);
        if (!$socket) {
            Log::error("WebSocket connection failed: $errstr ($errno)");
            return;
        }

        fwrite($socket, $message);
        fclose($socket);
    }

    /**
     * Notify method to handle notifications.
     */
    public function notify(Request $request)
    {
        // Validasi pesan
        $request->validate([
            'message' => 'required|string',
        ]);

        // Logika untuk mengirim notifikasi (misalnya, menggunakan notifikasi atau event)
        // Contoh: Notifikasi berhasil
        return response()->json(['success' => true, 'message' => 'Notifikasi berhasil dikirim']);
    }
}
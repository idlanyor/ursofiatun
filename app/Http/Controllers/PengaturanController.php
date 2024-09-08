<?php

namespace App\Http\Controllers;

use App\Models\TahunAjaran;
use App\Models\User;
use Illuminate\Http\Request;

class PengaturanController extends Controller
{
    public function index()
    {
        // return view('module.pengaturan.index');
        $dataTahunAjaran = TahunAjaran::paginate(10);
        $dataUser = User::paginate(10);
        return view('module.pengaturan.index', compact('dataTahunAjaran'));
    }
    public function searchUser($query)
    {
        $dataUser = User::search($query);
        return view('module.pengaturan.index', compact('dataUser'));
    }
    public function searchTahunAjaran($query)
    {
        $dataTahunAjaran = TahunAjaran::search($query);
        return view('module.pengaturan.index', compact('dataTahunAjaran'));
    }
}

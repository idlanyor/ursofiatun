<?php

namespace App\Http\Controllers;

use App\Models\TahunAjaran;
use Illuminate\Http\Request;

class PengaturanController extends Controller
{
    public function index()
    {
        // return view('module.pengaturan.index');
        $dataTahunAjaran = TahunAjaran::paginate(10);
        return view('module.pengaturan.index', compact('dataTahunAjaran'));
    }
}

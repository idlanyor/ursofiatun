<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sarpras;

class SarprasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sarpras = Sarpras::paginate(10);
        return view('module.sarpras.index', compact('sarpras'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('module.sarpras.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $sarpras = Sarpras::find($id);
        return response()->json(['sarpras' => $sarpras]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

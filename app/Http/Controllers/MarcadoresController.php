<?php

namespace App\Http\Controllers;

use App\Models\Marcador;
use Illuminate\Http\Request;

class MarcadoresController extends Controller
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
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:100',
            'latitude' => 'required|numeric:|decimal:10,8',
            'longitude' => 'required|numeric:|decimal:11,8',
            'tipo' => 'required|in:doacao,hospital,evento',
        ]);

        $marcador = Marcador::create($validated);
    }

    /**
     * Display the specified resource.
     */
    public function show(Marcador $marcadores)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Marcador $marcadores)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Marcador $marcadores)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:100',
            'latitude' => 'required|numeric:|decimal:10,8',
            'longitude' => 'required|numeric:|decimal:11,8',
            'tipo' => 'required|in:doacao,hospital,evento',
        ]);

        $marcadores->update($validated);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Marcador $marcadores)
    {
        $marcadores->delete();
    }
}

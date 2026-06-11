<?php

namespace App\Http\Controllers;

use App\Models\Dica;
use Illuminate\Http\Request;

class DicasController extends Controller
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
            'titulo' => 'required|max:100',
            'descricao' => 'required|max:255',
            'tipo' => 'required',
        ]);

        Dica::create([
            'titulo' => $validated['titulo'],
            'descricao' => $validated['descricao'],
            'tipo' => $validated['tipo'],
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Dica $dicas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dica $dicas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dica $dicas)
    {
        $validated = $request->validate([
            'titulo' => 'required|max:100',
            'descricao' => 'required|max:255',
            'tipo' => 'required',
        ]);

        $dicas->update($validated);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dica $dicas)
    {
        $dicas->delete();
    }
}

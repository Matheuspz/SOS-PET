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
        $dicas = Dica::all();

        return response()->json([$dicas]);
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
            'tipo' => 'required|in:cao,gato',
        ]);

        $dicas = Dica::create($validated);

        return response()->redirectToRoute('admin.dashboard')->with('status', 'Dica cadastrada com sucesso!');
        /**
         * Para teste com resposta em formato Json
         */
//        return response()->json([
//            'message' => 'Dica criada com sucesso!',
//            'data'    => $dicas
//        ], 201);
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
    public function edit(Dica $dica)
    {
        return view('admin.dicas.edit', compact('dica'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dica $dica)
    {
        $validated = $request->validate([
            'titulo' => 'required|max:100',
            'descricao' => 'required|max:255',
            'tipo' => 'required',
        ]);

        $dica->update($validated);

        return response()->redirectToRoute('admin.dashboard')->with('status', 'Dica atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dica $dica)
    {
        $dica->delete();

        return response()->redirectToRoute('admin.dashboard')->with('status', 'Dica removida com sucesso!');
    }
}

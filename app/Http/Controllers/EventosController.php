<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use Illuminate\Http\Request;

class EventosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $eventos = Evento::all();

        return response()->json([$eventos]);
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
            'data' => 'required',
            'hora' => 'required',
            'descricao' => 'required',
        ]);

        $eventos = Evento::create($validated);

        return response()->redirectToRoute('admin.dashboard')->with('status', 'Evento cadastrado com sucesso!');
        /**
         * Para teste com resposta em formato Json
         */
//        return response()->json([
//            'message' => 'Evento criado com sucesso!',
//            'data'    => $eventos
//        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Evento $eventos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Evento $eventos)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Evento $eventos)
    {
        $validated = $request->validate([
            'titulo' => 'required|max:100',
            'data' => 'required',
            'hora' => 'required',
            'descricao' => 'required',
        ]);

        $eventos->update($validated);

        return response()->redirectToRoute('admin.dashboard')->with('status', 'Evento atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Evento $eventos)
    {
        $eventos->delete();

        return response()->redirectToRoute('admin.dashboard')->with('status', 'Evento removido com sucesso!');
    }
}

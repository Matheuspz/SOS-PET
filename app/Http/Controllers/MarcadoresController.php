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
        $marcadores = Marcador::all();

        $geojson = [
            'type' => 'FeatureCollection',
            'features' => $marcadores->map(function ($marcador) {
                return [
                    'type' => 'Feature',
                    'geometry' => [
                        'type' => 'Point',
                        'coordinates' => [$marcador->longitude, $marcador->latitude] // lng primeiro!
                    ],
                    'properties' => [
                        'id'          => $marcador->id,
                        'title'       => $marcador->titulo,
                        'description' => $marcador->descricao,
                        ...($marcador->properties ?? []),
                    ]
                ];
            })
        ];

        return response()->json($geojson);
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
        $validated = $this->Validate($request);

        $marcador = Marcador::create($validated);

        return redirect()->route('admin.dashboard')->with('success', 'Marcador cadastrado com sucesso!');
        /**
         * Para teste com resposta em formato Json
         */
//        return redirect()->json([
//            'message' => 'Marcador cadastrado com sucesso!',
//            'data' => $marcador
//        ]);
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
    public function edit(Marcador $marcador)
    {
        return view('admin.marcadores.edit', compact('marcador'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Marcador $marcador)
    {
        $validated = $this->Validate($request);

        $marcador->update($validated);

        return response()->redirectToRoute('admin.dashboard')->with('status', 'Marcador atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Marcador $marcador)
    {
        $marcador->delete();

        return response()->redirectToRoute('admin.dashboard')->with('status', 'Marcador removido com sucesso!');
    }

    /**
     * @param Request $request
     * @return array
     */
    public function Validate(Request $request): array
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'tipo' => 'required|in:doacao,hospital,evento',
        ]);

        $properties = match ($validated['tipo']) {
            'doacao' => ['cor' => '#FF8C00', 'label' => 'Doação'],      // Laranja
            'hospital' => ['cor' => '#1E90FF', 'label' => 'Hospital'],    // Azul
            'evento' => ['cor' => '#DC143C', 'label' => 'Evento'],      // Vermelho
            default => ['cor' => '#6B7280', 'label' => 'Outro'],
        };

        $validated['properties'] = $properties;
        return $validated;
    }
}

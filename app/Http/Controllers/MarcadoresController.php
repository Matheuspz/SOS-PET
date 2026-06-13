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
        $validated = $request->validate([
            'titulo'       => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'latitude'    => 'required|numeric|between:-90,90',
            'longitude'   => 'required|numeric|between:-180,180',
            'properties'  => 'nullable|array',
        ]);

        $marcador = Marcador::create($validated);

        return redirect()->route('admin.login')
            ->with('success', 'Marcador criado com sucesso!');
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
            'titulo'       => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'latitude'    => 'required|numeric|between:-90,90',
            'longitude'   => 'required|numeric|between:-180,180',
            'properties'  => 'nullable|array',
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

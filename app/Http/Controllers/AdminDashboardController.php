<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    /**
     * Display the admin dashboard
     * TODO: Fetch data from database when backend is ready
     */
    public function index()
    {
        // Placeholder data - replace with database queries
        $events = [
            [
                'id' => 1,
                'title' => 'Evento de adoção',
                'date' => '21/05/2026',
                'description' => 'Evento de adoção de animais.',
            ],
            [
                'id' => 2,
                'title' => 'Feira pet beneficente',
                'date' => '21/06/2026',
                'description' => 'Feira pet beneficente com diversos expositores.',
            ],
        ];

        $tips = [
            [
                'id' => 1,
                'title' => 'Vacinação Regular',
                'description' => 'Manter seu cachorro vacinado é fundamental para sua saúde.',
                'type' => 'dog',
            ],
            [
                'id' => 2,
                'title' => 'Higiene Bucal',
                'description' => 'Escove os dentes do seu cachorro regularmente.',
                'type' => 'dog',
            ],
        ];

        $markers = [
            [
                'id' => 1,
                'title' => 'Doação - Centro de Adoção',
                'latitude' => -23.5505,
                'longitude' => -46.6333,
                'type' => 'donation',
                'description' => 'Centro de adoção de animais',
            ],
            [
                'id' => 2,
                'title' => 'Hospital - Clínica Veterinária ABC',
                'latitude' => -23.5605,
                'longitude' => -46.6233,
                'type' => 'hospital',
                'description' => 'Clínica veterinária com atendimento 24h',
            ],
        ];

        return view('admin.dashboard', [
            'events' => $events,
            'tips' => $tips,
            'markers' => $markers,
        ]);
    }

    /**
     * Store a new event
     * TODO: Implement database storage when backend is ready
     */
    public function storeEvent(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'description' => 'required|string',
        ]);

        // TODO: Save to database
        // Event::create($request->all());

        return response()->json(['message' => 'Evento criado com sucesso!']);
    }

    /**
     * Update an event
     * TODO: Implement database update when backend is ready
     */
    public function updateEvent(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'description' => 'required|string',
        ]);

        // TODO: Update in database
        // Event::find($id)->update($request->all());

        return response()->json(['message' => 'Evento atualizado com sucesso!']);
    }

    /**
     * Delete an event
     * TODO: Implement database deletion when backend is ready
     */
    public function destroyEvent($id)
    {
        // TODO: Delete from database
        // Event::find($id)->delete();

        return response()->json(['message' => 'Evento deletado com sucesso!']);
    }

    /**
     * Store a new tip
     * TODO: Implement database storage when backend is ready
     */
    public function storeTip(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'required|in:dog,cat',
        ]);

        // TODO: Save to database
        // Tip::create($request->all());

        return response()->json(['message' => 'Dica criada com sucesso!']);
    }

    /**
     * Update a tip
     * TODO: Implement database update when backend is ready
     */
    public function updateTip(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'required|in:dog,cat',
        ]);

        // TODO: Update in database
        // Tip::find($id)->update($request->all());

        return response()->json(['message' => 'Dica atualizada com sucesso!']);
    }

    /**
     * Delete a tip
     * TODO: Implement database deletion when backend is ready
     */
    public function destroyTip($id)
    {
        // TODO: Delete from database
        // Tip::find($id)->delete();

        return response()->json(['message' => 'Dica deletada com sucesso!']);
    }

    /**
     * Store a new map marker
     * TODO: Implement database storage when backend is ready
     */
    public function storeMarker(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'type' => 'required|in:donation,hospital,event',
            'description' => 'required|string',
        ]);

        // TODO: Save to database
        // Marker::create($request->all());

        return response()->json(['message' => 'Marcador criado com sucesso!']);
    }

    /**
     * Update a marker
     * TODO: Implement database update when backend is ready
     */
    public function updateMarker(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'type' => 'required|in:donation,hospital,event',
            'description' => 'required|string',
        ]);

        // TODO: Update in database
        // Marker::find($id)->update($request->all());

        return response()->json(['message' => 'Marcador atualizado com sucesso!']);
    }

    /**
     * Delete a marker
     * TODO: Implement database deletion when backend is ready
     */
    public function destroyMarker($id)
    {
        // TODO: Delete from database
        // Marker::find($id)->delete();

        return response()->json(['message' => 'Marcador deletado com sucesso!']);
    }
}

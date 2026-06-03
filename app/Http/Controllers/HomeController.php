<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the home page
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Get all events via API
     * TODO: Connect to database when backend is ready
     */
    public function getEvents()
    {
        // Placeholder for backend integration
        $events = [
            [
                'id' => 1,
                'title' => 'Evento de adoção',
                'date' => '21/05/2026',
                'description' => 'Evento de adoção de animais.',
                'image' => '/img/placeholder.png',
                'latitude' => -23.5505,
                'longitude' => -46.6333,
            ],
            [
                'id' => 2,
                'title' => 'Feira pet beneficente',
                'date' => '21/06/2026',
                'description' => 'Feira pet beneficente com diversos expositores.',
                'image' => '/img/placeholder.png',
                'latitude' => -23.5605,
                'longitude' => -46.6233,
            ],
        ];

        return response()->json($events);
    }

    /**
     * Get all tips via API
     * TODO: Connect to database when backend is ready
     */
    public function getTips()
    {
        // Placeholder for backend integration
        $tips = [
            [
                'id' => 1,
                'title' => 'Vacinação Regular',
                'description' => 'Manter seu cachorro vacinado é fundamental para sua saúde. Consulte um veterinário para saber qual é o calendário vacinal adequado.',
                'type' => 'dog',
            ],
            [
                'id' => 2,
                'title' => 'Higiene Bucal',
                'description' => 'Escove os dentes do seu cachorro regularmente para prevenir problemas de saúde bucal.',
                'type' => 'dog',
            ],
            [
                'id' => 3,
                'title' => 'Nutrição Adequada',
                'description' => 'Ofereça uma alimentação balanceada e apropriada para a idade e tamanho do seu gato.',
                'type' => 'cat',
            ],
            [
                'id' => 4,
                'title' => 'Espaço para Arranhar',
                'description' => 'Gatos precisam arranhar. Disponibilize arranhadores para proteger seus móveis.',
                'type' => 'cat',
            ],
        ];

        return response()->json($tips);
    }

    /**
     * Get all map markers via API
     * TODO: Connect to database when backend is ready
     */
    public function getMarkers()
    {
        // Placeholder for backend integration
        $markers = [
            [
                'id' => 1,
                'title' => 'Doação - Centro de Adoção',
                'latitude' => -23.5505,
                'longitude' => -46.6333,
                'type' => 'donation', // donation, hospital, event
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
            [
                'id' => 3,
                'title' => 'Evento - Feira Pet',
                'latitude' => -23.5405,
                'longitude' => -46.6433,
                'type' => 'event',
                'description' => 'Feira pet beneficente',
            ],
        ];

        return response()->json($markers);
    }
}

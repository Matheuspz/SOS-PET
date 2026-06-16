<?php

namespace App\Http\Controllers;

use App\Models\Dica;
use App\Models\Evento;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the home page
     */
    public function index()
    {
        $dicas = Dica::all();

        return view('home', ['dicas' => $dicas]);
    }

    public function eventos()
    {
        $eventos = Evento::orderBy('data')
                        ->orderBy('hora')
                        ->get();

        return view('events', compact('eventos'));
    }

}

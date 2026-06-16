<?php

namespace App\Http\Controllers;

use App\Models\Dica;
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

    public function events()
    {
        return view('events');
    }

}

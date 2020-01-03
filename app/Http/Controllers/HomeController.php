<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = [   'nbreUsers' => DB::Table('users')->count(),
                    'nbrePropositions' => DB::Table('propositions')->count(),
                    'nbreSites' => DB::Table('sites')->count(),
                    'nbreTarifs' => DB::Table('tarifs')->count()  
                ];
        return view('home', compact('data'));
    }
}

<?php

namespace App\Http\Controllers;

use DB;
//use Auth;
//use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;

class WelcomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($url)
    {
        $landing = DB::table('Landing')->where('url', $url)->get();
        if(count($landing)){
            $idprograma = $landing[0]->idLanding;
            $landings = DB::table('Landing')->where('Programa_idPrograma', $idprograma)->limit(1)->get();
            $programas = DB::table('Programa')->where('idPrograma', $idprograma)->get();

            return view('welcome', compact('landings','programas','idprograma'));
        }
    }

}
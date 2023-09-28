<?php

namespace App\Http\Controllers\Admin;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreLandingsRequest;
use App\Http\Requests\Admin\UpdateLandingsRequest;

class LandingsController extends Controller
{
    /**
     * Display a listing of User.
     *
     * @return \Illuminate\Http\Response
     */

	public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        if (! Gate::allows('gestion_usuarios')) {
            return abort(401);
        }
        $landings = DB::table('Landing')->get();
        return view('admin.landings.index', compact('landings'));    	
    }    

    public function destroy($id)
    {
        if (! Gate::allows('gestion_usuarios')) {
            return abort(401);
        }        
        DB::table('Landing')->where('idLanding', '=', $id)->delete();

        return redirect()->route('admin.landings.index');
    }
}
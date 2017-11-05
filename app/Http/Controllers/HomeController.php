<?php

namespace App\Http\Controllers;

use App\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $show_admin_dashboard = Auth::user()->isAdmin;
        $view =  view('home')->with('show_admin_dashboard', $show_admin_dashboard );

        if($show_admin_dashboard == true){
            $custo_total = Produto::where('quantidade', '>', 0)->sum('custo');
            $view->with('custo_total',$custo_total);
        }

        return $view;
    }
}

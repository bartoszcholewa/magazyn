<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class DashboardController extends Controller
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
        //Return materials created by user:
        $material_CREATOR_ID = auth()->user()->id;
        $user = User::find($material_CREATOR_ID);
        return view('dashboard')->with('materials_creator', $user->materials_creator);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Operation;
use Illuminate\Support\Facades\URL;
use Session;

class PagesController extends Controller
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
    public function index(){

        /* lazy loading */
        //$operations = Operation::orderBy('operation_DATETIME', 'desc')->paginate(5);

        /* eager loading */
        $operations = Operation::with('user')->orderBy('operation_DATETIME', 'desc')->paginate(5);

        Session::put('requestReferrer', URL::current());
        return view('pages.index')->with('operations', $operations);
    }
}

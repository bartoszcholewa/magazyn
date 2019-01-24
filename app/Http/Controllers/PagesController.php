<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        $data = array(
            'title' => 'PROMAX | Magazyn',
            'materials' => ['Latex', 'Winyl na Flizelinie', 'Flizelina', 'EasyStick', 'Canvas', 'Winyl Canvas']
        );
        return view('pages.index')->with($data);
    }
}

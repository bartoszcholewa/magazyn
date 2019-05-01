<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Option;
use Illuminate\Support\Facades\URL;
use Session;

class OptionsController extends Controller
{
     /**
     * Autoryzacja dostępu
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $options = Option::orderBy('option_ID', 'asc')->get();
        Session::put('requestReferrer', URL::current());
        return view('options.index')->with('options', $options);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $option = Option::find($id);
        return view('options.edit')->with('option', $option);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $option = Option::find($id);
        $option->option_NAME = $option->option_NAME;
        $option->option_VALUE = $request->input('option_VALUE');
        $option->option_AUTOLOAD = $request->input('option_AUTOLOAD');
        $option->save();

        $redirect_respond = "Zaktualizowano ustawienia ogólne";
        Controller::operation($redirect_respond);

        return redirect(Session::get('requestReferrer'))->with('success', $redirect_respond);
    }

}

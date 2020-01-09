<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use App\Envelope;
use Session;

class EnvelopesController extends Controller
{
    /* AUTORYZACJA DOSTĘPU --------------------------------------------------------------------------------------- */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $envelopes = Envelope::all();
        Session::put('requestReferrer', URL::current());
        return view('envelopes.index')->with('envelopes', $envelopes);
    }

    public function create()
    {
        return view('envelopes.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'envelope_NAME' => 'required',
            'envelope_COMPANY' => 'required',
            'envelope_STREET' => 'required',
            'envelope_ZIPCODE' => 'required',
            'envelope_CITY' => 'required',
            'envelope_COUNTRY' => 'required',
        ]);

        $envelope = new Envelope;
        $envelope->envelope_NAME = $request->input('envelope_NAME');
        $envelope->envelope_COMPANY = $request->input('envelope_COMPANY');
        $envelope->envelope_PERSON = $request->input('envelope_PERSON');
        $envelope->envelope_STREET = $request->input('envelope_STREET');
        $envelope->envelope_ZIPCODE = $request->input('envelope_ZIPCODE');
        $envelope->envelope_CITY = $request->input('envelope_CITY');
        $envelope->envelope_COUNTRY = $request->input('envelope_COUNTRY');
        $envelope->save();

        $redirect_respond = "Dodano <a href='koperty/".$envelope->envelope_ID."'>".$envelope->envelope_NAME."</a>";
        Controller::operation($redirect_respond);

        return redirect(Session::get('requestReferrer'))->with('success', $redirect_respond);
    }

    public function show($id)
    {
        $envelope = Envelope::find($id);
        if(isset($envelope))
        {
            return view('envelopes.show')->with('envelope', $envelope);
        }
        else {
            return redirect(Session::get('requestReferrer'))->with('error', 'Ta koperta została usunięta.');
        }
    }

    public function destroy($id)
    {
        $envelope = Envelope::find($id);

        //if(auth()->user()->id !==$supplier->supplier_CREATOR_ID){
        //    return redirect('/suppliers')->with('error', 'Tylko autor może usunąć dostawcę');
        //}

        $envelope->delete();

        $redirect_respond = "Usunięto ".$envelope->envelope_NAME."</a>";
        Controller::operation($redirect_respond);

        return redirect(Session::get('requestReferrer'))->with('success', $redirect_respond);
    }

    public function edit($id)
    {
        $envelope = Envelope::find($id);
        return view('envelopes.edit')->with('envelope', $envelope);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'envelope_NAME' => 'required',
            'envelope_COMPANY' => 'required',
            'envelope_STREET' => 'required',
            'envelope_ZIPCODE' => 'required',
            'envelope_CITY' => 'required',
            'envelope_COUNTRY' => 'required',
        ]);


        $envelope = Envelope::find($id);
        $envelope->envelope_NAME = $request->input('envelope_NAME');
        $envelope->envelope_COMPANY = $request->input('envelope_COMPANY');
        $envelope->envelope_PERSON = $request->input('envelope_PERSON');
        $envelope->envelope_STREET = $request->input('envelope_STREET');
        $envelope->envelope_ZIPCODE = $request->input('envelope_ZIPCODE');
        $envelope->envelope_CITY = $request->input('envelope_CITY');
        $envelope->envelope_COUNTRY = $request->input('envelope_COUNTRY');
        $envelope->save();

        $redirect_respond = "Zaktualizowano <a href='koperty/".$envelope->envelope_ID."'>".$envelope->envelope_NAME."</a>";
        Controller::operation($redirect_respond);

        return redirect(Session::get('requestReferrer'))->with('success', $redirect_respond);
    }
}

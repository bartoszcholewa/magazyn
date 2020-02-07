<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Envelopelist;
use App\Envelope;
use Session;
use Illuminate\Support\Facades\URL;
use DB;
use Barryvdh\DomPDF\Facade as PDF;

class EnvelopelistsController extends Controller
{
    /* AUTORYZACJA DOSTĘPU --------------------------------------------------------------------------------------- */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $envelopelists = Envelopelist::with('packets.envelope')->get();
        //dd($envelopelists);
        Session::put('requestReferrer', URL::current());
        return view('envelopelists.index')->with('envelopelists', $envelopelists);
    }

    public function create()
    {
        $envelopes = Envelope::all();
        return view('envelopelists.create')->with('envelopes', $envelopes);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'envelopelist_NAME' => 'required',
        ]);

        $envelopelist = new Envelopelist;
        $envelopelist->envelopelist_NAME = $request->input('envelopelist_NAME');
        $envelopelist->save();

        $redirect_respond = "Dodano listę kopert <a href='koperty/".$envelopelist->envelopelist_ID."'>".$envelopelist->envelopelist_NAME."</a>";
        Controller::operation($redirect_respond);

        return redirect(Session::get('requestReferrer'))->with('success', $redirect_respond);
    }

    public function show($id)
    {
        $envelopelist = Envelopelist::find($id);
        if(isset($envelopelist))
        {
            return view('envelopelists.show')->with('envelopelist', $envelopelist);
        }
        else {
            return redirect(Session::get('requestReferrer'))->with('error', 'Ta lista została usunięta.');
        }
    }

    public function destroy($id)
    {
        $envelopelist = Envelopelist::find($id);

        //if(auth()->user()->id !==$supplier->supplier_CREATOR_ID){
        //    return redirect('/suppliers')->with('error', 'Tylko autor może usunąć dostawcę');
        //}

        $envelopelist->delete();

        $redirect_respond = "Usunięto listę kopert ".$envelopelist->envelopelist_NAME."</a>";
        Controller::operation($redirect_respond);

        return redirect(Session::get('requestReferrer'))->with('success', $redirect_respond);
    }

    public function edit($id)
    {
        $envelopelist = Envelopelist::find($id);
        return view('envelopelists.edit')->with('envelopelist', $envelopelist);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'envelopelist_NAME' => 'required',
        ]);

        $envelopelist = Envelopelist::find($id);
        $envelopelist->envelopelist_NAME = $request->input('envelopelist_NAME');
        $envelopelist->save();

        $redirect_respond = "Zaktualizowano listę <a href='koperty/".$envelopelist->envelopelist_ID."'>".$envelopelist->envelopelist_NAME."</a>";
        Controller::operation($redirect_respond);

        return redirect(Session::get('requestReferrer'))->with('success', $redirect_respond);
    }

    public function pdf($id)
    {
        // Wskazanie konkretnej listy kopert
        $envelopelist = Envelopelist::find($id);

        // Określanie niestandardowego wymiaru koperty
        $kopertaWojtek = array(0,0,325.98,453.54);

        // Generowanie widoku PDF
        $pdf = PDF::loadView('envelopelists.pdf', array('envelopelist' => $envelopelist))->setPaper($kopertaWojtek, 'landscape');

        // Pobieranie PDF'a
        return $pdf->download('Koperty-'.$envelopelist->envelopelist_NAME.'.pdf');

        // Podgląd PDF'a w przeglądarce
        //return $pdf->stream();

        // Podgląd HTML
        //return view('envelopelists.pdf')->with('envelopelist', $envelopelist);
    }
}

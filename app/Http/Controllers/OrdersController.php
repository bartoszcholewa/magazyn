<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Session;
use App\Material;
use App\Supplier;
use App\Order;
use App\Roll;
use App\Operation;
use Carbon;
use Mail;
use App\Mail\NewOrderMail;
use App\Mail\VerifiedOrderMail;
use App\Mail\PrintedOrderMail;
use App\Mail\FinishedOrderMail;
use Auth;
use Notification;
use App\Notifications\NewOrder;
use App\Option;
use App\ModelFilters\OrderFilter;

class OrdersController extends Controller
{

    /* AUTORYZACJA DOSTĘPU --------------------------------------------------------------------------------------- */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /* WIDOK LISTY ZLECEŃ ---------------------------------------------------------------------------------------------- */
    public function index(Request $request)
    {
        /* Populacja listy - eager loading */
        /* Lista aktywnych filtrów TuckerEric\EloquentFilter - App/ModelFilters */
        $orders = Order::filter($request->all())->with(['material', 'roll'])->orderBy('order_NAME', 'desc')->paginate(config('options.orderpagination'));

        /* Umieść link do sesji dla opcji "Wróć" */
        Session::put('requestReferrer', URL::current());
        return view('orders.index')->with('orders', $orders);
    }

    /* WIDOK TWORZENIA NOWEGO ZLECENIA ------------------------------------------------------------------------- */
    public function create()
    {
        /* Automatyczne wypełnienie nazwy zlecenia */
        $getLastOrder = Order::all()->last();
        if (isset($getLastOrder))
        {
            /* Jeśli ostatnie zlecenie jest kalibracją, pomiń i weź następny */
            if ($getLastOrder->order_NAME === "0") {
                $getLastOrder = Order::orderBy('order_ID', 'desc')->skip(1)->take(1)->first();
            }
            /* Jeśli nazwa ostatniego zlecenia jest liczbą - powiększ o jeden i dodaj przedrostek */
            if (is_numeric($getLastOrder->order_NAME)) {
                $getLastOrderName = ++$getLastOrder->order_NAME;
                if ($getLastOrderName < 1000) {
                    $giveNextOrder = "000" . $getLastOrderName;
                }
                if ($getLastOrderName >= 1000 && $getLastOrderName < 10000) {
                    $giveNextOrder = "00" . $getLastOrderName;
                }
                if ($getLastOrderName >= 10000 && $getLastOrderName < 100000) {
                    $giveNextOrder = "0" . $getLastOrderName;
                }
                if ($getLastOrderName >= 100000) {
                    $giveNextOrder = $getLastOrderName;
                }
                $giveSameName = "";
                $giveSameSurname = "";
            }
            /* Jeśli nazwa ostatniego zlecenia jest literą - powiększ o jeden i ustaw tego samego klienta */
            else {
                $giveNextOrder = ++$getLastOrder->order_NAME;
                $giveSameName = $getLastOrder->order_CLIENT_NAME;
                $giveSameSurname = $getLastOrder->order_CLIENT_SURNAME;
            }
        }
        /* Jeśli nie ma ostatniego zlecenia - zostaw puste */
        else {
            $giveNextOrder = NULL;
            $giveSameName = NULL;
            $giveSameSurname = NULL;
        }

        /* Pobieranie listy rolek i materiałów do zlecenia */
        $rolls = Roll::all()->pluck('roll_NAME', 'roll_ID')->toArray();
        $materials = Material::all()->pluck('material_NAME', 'material_ID')->toArray();
        return view('orders.create')->with([
                                            'rolls' => $rolls, 
                                            'materials' => $materials,
                                            'giveNextOrder' => $giveNextOrder,
                                            'giveSameName' => $giveSameName,
                                            'giveSameSurname' => $giveSameSurname
                                            ]);
    }

    /* Laravel Dynamic Dependent Dropdown - automatyczna populacja dostępnych rolek na podstawie wybranego materiału */
    public function getRolls($id)
    {
        $rolls = Roll::where('roll_MATERIAL_ID', $id)->pluck('roll_NAME', 'roll_ID');
        return json_encode($rolls);
    }

    /* TWORZENIE NOWEGO ZLECENIA ---------------------------------------------------------------------------- */
    public function store(Request $request)
    {
        /* Rozpoznanie typu zlecenia - kalibracja/zlecenie */
        if($request->input('order_NAME') == "0") {
            $order_name_validation = 'required';
            $redirect_respond = 'Dodano kalibrację';
        } else {
            $order_name_validation = 'required|unique:orders,order_NAME';
            $redirect_respond = 'Dodano PW-'.$request->input('order_NAME');
        }
        /* Walidacja wprowadzonych wartości */
        $this->validate($request, [
            'order_NAME' => $order_name_validation,
            'order_CLIENT_NAME' => 'required',
            'order_CLIENT_SURNAME' => 'required',
            'order_MATERIAL_ID' => 'required',
            'order_ROLL_ID' => 'nullable',
            'order_EXPECTED_L' => 'required',
            'order_SAFE_L' => 'required',
            'order_ACTUAR_L' => 'nullable',
            'order_DATE' => 'required',
            'order_CUTDATE' => 'nullable',
            'order_pp_PERIOD' => 'nullable',
            'order_DESCRIPTION' => 'nullable',
            'order_STATUS' => 'nullable',
            // DO POPRAWY - Wymagaj wypełnienia!!!:
            'order_URL' => 'nullable|url',
            'order_EFFECTS' => 'nullable',
            'order_ROTATION' => 'nullable',
            'order_FLIP_X' => 'nullable',
            'order_FLIP_Y' => 'nullable',
            'order_OVERLAP' => 'nullable',
            'order_LAMINATE' => 'nullable',
            'order_GLUE' => 'nullable',
            'order_QUANTITY' => 'required',
        ]);
        
        /* Wprowadzanie zwalidowanych danych */
        $order = new Order;
        $order->order_NAME = $request->input('order_NAME');
        $order->order_CLIENT_NAME = $request->input('order_CLIENT_NAME');
        $order->order_CLIENT_SURNAME = $request->input('order_CLIENT_SURNAME');
        $order->order_MATERIAL_ID = $request->input('order_MATERIAL_ID');
        $order->order_ROLL_ID = $request->input('order_ROLL_ID');
        $order->order_EXPECTED_L = $request->input('order_EXPECTED_L');
        $order->order_SAFE_L = $request->input('order_SAFE_L');
        $order->order_ACTUAR_L = $request->input('order_ACTUAR_L');
        $order->order_DATE = $request->input('order_DATE');
        $order->order_CUTDATE = $request->input('order_CUTDATE');
        $order->order_pp_ID = 0;
        $order->order_pp_ORDER = 0;
        $order->order_pp_PERIOD = $request->input('order_pp_PERIOD');
        $order->order_DESCRIPTION = $request->input('order_DESCRIPTION');
        $order->order_STATUS = $request->input('order_STATUS');
        $order->order_URL = $request->input('order_URL');
        $order->order_EFFECTS = $request->input('order_EFFECTS');
        $order->order_ROTATION = $request->input('order_ROTATION');
        $order->order_FLIP_X = $request->input('order_FLIP_X');
        $order->order_FLIP_Y = $request->input('order_FLIP_Y');
        $order->order_OVERLAP = $request->input('order_OVERLAP');
        $order->order_LAMINATE = $request->input('order_LAMINATE');
        $order->order_GLUE = $request->input('order_GLUE');
        $order->order_CREATOR_ID = auth()->user()->id;
        $order->order_EDITOR_ID = auth()->user()->id;
        $order->order_QUANTITY = $request->input('order_QUANTITY');
        
        /* Jeśli zlecenie jest kalibracją - zatwierdź weryfikacje - nie wysyłaj maila */
        if($order->order_NAME == "0")               
        {
            $op = "Dodano kablirację";
            $order->order_VERIFIED = Carbon\Carbon::now();
            $order->save();
        }
        else {  
            $op = "Dodano <a href='orders/".$order->order_ID."'>PW-".$order->order_NAME."</a>";
            /* Jeśli zlecenie jest "Nowe" - żądaj weryfikacji - wyślij maila */
            if($order->order_STATUS == 0 || $order->order_STATUS == 3)        
            {
                $order->save();
                /* Jeśli zlecenie jest "Nowe" - żądaj weryfikacji - wyślij maila */
                if(config('options_autoload.firstemail') == "yes") {
                    Mail::to(config('options.firstemail'))->send(new NewOrderMail($order, $user=auth()->user()));
                }
            }
            //jeśli zlecenie nie jest "Nowe" - zatwierdź weryfikacje - nie wysyłaj maila
            elseif($order->order_STATUS == 1) {
                /* Jeśli status aplikacji jest w trybie budowy - dodaj weryfikacje */
                if(config('options.apptype') == "development"){
                    $order->order_VERIFIED = Carbon\Carbon::now();   
                }                                 
                $order->order_PRINTED = Carbon\Carbon::now();
                $order->save();
            }
            elseif($order->order_STATUS == 2) {

                if(config('options.apptype') == "development"){
                    /* Jeśli status aplikacji jest w trybie budowy - dodaj weryfikacje */
                    $order->order_VERIFIED = Carbon\Carbon::now();
                    $order->order_PRINTED = Carbon\Carbon::now();   
                }                      
                $order->order_FINISHED = Carbon\Carbon::now();
                $order->save();
            }
        }
        //Sending a notification
        //TODO;

        /* Dodawanie operacji do listy aktywności */
        Controller::operation($op);

        return redirect(Session::get('requestReferrer'))->with('success', $redirect_respond);
    }

    /* WYŚWIETLANIE ZLECENIA ---------------------------------------------------------------------------------------------- */
    public function show($id)
    {
        
        $order = Order::find($id);
        if(isset($order))
        {
            /* Generowanie podglądu grafiki zlecenia - Adobe Stock */
            $img_url_500 = NULL;
            $img_url_1000 = NULL;
            $order_json = NULL;
            if(isset($order->order_URL)){
                parse_str(parse_url(urldecode($order->order_URL), PHP_URL_QUERY), $order_parse);
                $order_json = json_decode($order_parse['data'], true);
                $img_base64 = $order_json['image'];
                $img_url_500 = base64_decode($img_base64);
                $img_url_1000 = str_replace("500_", "1000_", $img_url_500);
            }
            return view('orders.show')->with([
                                            'order' => $order, 
                                            'img_url_500' => $img_url_500, 
                                            'img_url_1000' => $img_url_1000, 
                                            'order_json' => $order_json
                                            ]);
        }
        else {
            return redirect(Session::get('requestReferrer'))->with('error', 'To zlecenie zostało usunięte.');
        }
    }

    /* WIDOK EDYCJI ZLECENIA --------------------------------------------------------------------------------------------------- */
    public function edit($id)
    {
        $order = Order::find($id);
        /* Sprawdzenie przed edycją czy zlecenie zostało już zatwierdzone */
        if(isset($order->order_VERIFIED) && Auth::user()->type != "admin")
        {
            return redirect(Session::get('requestReferrer'))->with('error', 'Zatwierdzonego zlecenia nie można edytować!');
        }
        else 
        {
            $rolls = Roll::all()->pluck('roll_NAME', 'roll_ID')->toArray();
            $materials = Material::all()->pluck('material_NAME', 'material_ID')->toArray();
            return view('orders.edit', compact('order', 'rolls', 'materials'));
        }

    }

    /* EDYCJA ZLECENIA --------------------------------------------------------------------------------------------------------- */
    public function update(Request $request, $id)
    {
        $order = Order::find($id);
        /* Identyfikacja wybranego zlecenia na Kalibracja/Zlecenie */
        if($request->input('order_NAME') == "0") {
            $order_name_validation = 'required';
            $redirect_respond = 'Zaktualizowano kalibrację';
        } else {
            if($order->order_NAME == $request->input('order_NAME')){
                $order_name_validation = 'required';
            } else {
                $order_name_validation = 'required|unique:orders,order_NAME';
            }
            $redirect_respond = "Zaktualizowano <a href='orders/".$order->order_ID."'>PW-".$order->order_NAME."</a>";
        }
        /* Walidacja wprowadzonych zmian */
        $this->validate($request, [
            'order_NAME' => $order_name_validation,
            'order_CLIENT_NAME' => 'required',
            'order_CLIENT_SURNAME' => 'required',
            'order_MATERIAL_ID' => 'required',
            'order_ROLL_ID' => 'nullable',
            'order_EXPECTED_L' => 'required',
            'order_SAFE_L' => 'required',
            'order_ACTUAR_L' => 'nullable',
            'order_DATE' => 'required',
            'order_CUTDATE' => 'nullable',
            'order_pp_PERIOD' => 'nullable',
            'order_DESCRIPTION' => 'nullable',
            'order_STATUS' => 'nullable',
            'order_URL' => 'nullable|url',
            'order_EFFECTS' => 'nullable',
            'order_ROTATION' => 'nullable',
            'order_FLIP_X' => 'nullable',
            'order_FLIP_Y' => 'nullable',
            'order_OVERLAP' => 'nullable',
            'order_LAMINATE' => 'nullable',
            'order_GLUE' => 'nullable',
            'order_QUANTITY' => 'required',
        ]);
        /* Wprowadzanie zwalidowanych danych */
        $order->order_NAME = $request->input('order_NAME');
        $order->order_CLIENT_NAME = $request->input('order_CLIENT_NAME');
        $order->order_CLIENT_SURNAME = $request->input('order_CLIENT_SURNAME');
        $order->order_MATERIAL_ID = $request->input('order_MATERIAL_ID');
        $order->order_ROLL_ID = $request->input('order_ROLL_ID');
        $order->order_EXPECTED_L = $request->input('order_EXPECTED_L');
        $order->order_SAFE_L = $request->input('order_SAFE_L');
        $order->order_ACTUAR_L = $request->input('order_ACTUAR_L');
        $order->order_DATE = $request->input('order_DATE');
        $order->order_CUTDATE = $request->input('order_CUTDATE');
        $order->order_pp_PERIOD = $request->input('order_pp_PERIOD');
        $order->order_DESCRIPTION = $request->input('order_DESCRIPTION');
        $order->order_STATUS = $request->input('order_STATUS');
        $order->order_URL = $request->input('order_URL');
        $order->order_EFFECTS = $request->input('order_EFFECTS');
        $order->order_ROTATION = $request->input('order_ROTATION');
        $order->order_FLIP_X = $request->input('order_FLIP_X');
        $order->order_FLIP_Y = $request->input('order_FLIP_Y');
        $order->order_OVERLAP = $request->input('order_OVERLAP');
        $order->order_LAMINATE = $request->input('order_LAMINATE');
        $order->order_GLUE = $request->input('order_GLUE');
        $order->order_EDITOR_ID = auth()->user()->id;
        $order->order_QUANTITY = $request->input('order_QUANTITY');
        $order->save();
        
        Controller::operation($redirect_respond);
        return redirect(Session::get('requestReferrer'))->with('success', $redirect_respond);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::find($id);
        if(isset($order->order_VERIFIED) && Auth::user()->type != "admin")
        {
            return redirect(Session::get('requestReferrer'))->with('error', 'Zatwierdzonego zlecenia nie można usunąć!');
        }
        else 
        {
            $order->delete();

            if($order->order_NAME == "0")
            {
                $redirect_respond = "Usunięto kalibrację";
            }
            else {
                $redirect_respond = "Usunięto PW-".$order->order_NAME;
            }

            Controller::operation($redirect_respond);
        
            return redirect(Session::get('requestReferrer'))->with('success', $redirect_respond);
        }
        
        
    }

    /*public function wydrukowane($id)
    {
        //dodaj logikę z verified
        $order = Order::find($id);
        $order->order_STATUS = 1;
        $order->timestamps = false;
        $order->save();
        $redirect_respond = "Wydrukowano <a href='orders/".$order->order_ID."'>PW-".$order->order_NAME."</a>";
        Controller::operation($redirect_respond);

        return redirect(Session::get('requestReferrer'))->with('success', $redirect_respond);
    }*/

    public function verified($id)
    {
        if(in_array(Auth::user()->type, array('admin', 'boss')))
        {
            $order = Order::find($id);
            if(isset($order))
            {
                $order->order_VERIFIED = Carbon\Carbon::now();
                $order->timestamps = false;
                $order->save();
                $redirect_respond = "Zlecenie <a href='orders/".$order->order_ID."'>PW-".$order->order_NAME."</a> zatwierdzone";

                // Sending a verified email
                if(config('options_autoload.lastemail') == "yes") {
                    Mail::to(config('options.lastemail'))->send(new VerifiedOrderMail($order, $user=auth()->user()));
                }
                
                Controller::operation($redirect_respond);
                return redirect('/orders')->with('success', $redirect_respond);
            }
            else
            {
                return redirect(Session::get('requestReferrer'))->with('error', 'To zlecenie zostało usunięte.');
            }
        }
        else
        {
            return redirect('/orders')->with('error', "Brak uprawnień szefa.");
        }

    }

    public function printed($id)
    {
        if(in_array(Auth::user()->type, array('admin', 'boss')))
        {
            $order = Order::find($id);
            if(isset($order))
            {
                $order->order_PRINTED = Carbon\Carbon::now();
                $order->timestamps = false;
                $order->save();
                $redirect_respond = "Zlecenie <a href='orders/".$order->order_ID."'>PW-".$order->order_NAME."</a> wydrukowane";

                // Sending a verified email
                if(config('options_autoload.picturewallmail') == "yes") {
                    Mail::to(config('options.picturewallmail'))->send(new PrintedOrderMail($order, $user=auth()->user()));
                }
    
                Controller::operation($redirect_respond);
                return redirect('/orders')->with('success', $redirect_respond);
            }
            else
            {
                return redirect(Session::get('requestReferrer'))->with('error', 'To zlecenie zostało usunięte.');
            }
        }
        else
        {
            return redirect('/orders')->with('error', "Brak uprawnień szefa.");
        }

    }

    public function finished($id)
    {
        if(in_array(Auth::user()->type, array('admin', 'plastyk')))
        {
            $order = Order::find($id);
            if(isset($order))
            {
                $order->order_FINISHED = Carbon\Carbon::now();
                $order->timestamps = false;
                $order->save();
                $redirect_respond = "Zlecenie <a href='orders/".$order->order_ID."'>PW-".$order->order_NAME."</a> zakończone";

                // Sending a verified email
                if(config('options_autoload.picturewallmail') == "yes") {
                    Mail::to(config('options.picturewallmail'))->send(new FinishedOrderMail($order, $user=auth()->user()));
                }
    
                Controller::operation($redirect_respond);
                return redirect('/orders')->with('success', $redirect_respond);
            }
            else
            {
                return redirect(Session::get('requestReferrer'))->with('error', 'To zlecenie zostało usunięte.');
            }
        }
        else
        {
            return redirect('/orders')->with('error', "Brak uprawnień szefa.");
        }

    }

}

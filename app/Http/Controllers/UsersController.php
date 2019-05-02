<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Session;
use App\Operation;

class UsersController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        Session::put('requestReferrer', URL::current());
        return view('users.index')->with('users', $users);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        
        // Sprawdź czy istnieje przed wyświetleniem
        if(isset($user))
        {
            return view('users.show')->with('user', $user);
        }
        else {
            return redirect(Session::get('requestReferrer'))->with('error', 'Ten użytkownik został usunięty');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

        /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
            'password_confirm' => 'required|same:password'
        ]);
        $user = new User;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->type = $request->input('type');
        $password_validation = Hash::make($request->input('password_confirm'));
        $user->password = $password_validation;
        $user->save();

        $redirect_respond = "Dodano nowego użytkownika: <a href='users/".$user->id."'>".$user->name."</a>";
        Controller::operation($redirect_respond);

        return redirect(Session::get('requestReferrer'))->with('success', $redirect_respond);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('users.edit')->with('user', $user);
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
        $user = User::find($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->type = $request->input('type');
        $user->save();

        $redirect_respond = 'Zaktualizowano użytkownika <b>'.$user->name.'</b>';

        Controller::operation($redirect_respond);
        return redirect(Session::get('requestReferrer'))->with('success', $redirect_respond);
    }

    public function changepassword($id)
    {
        $user = User::find($id);
        return view('users.changepassword')->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatepassword(Request $request, $id)
    {
        $this->validate($request, [
            'password' => 'required',
            'password_confirm' => 'required|same:password'
        ]);
        $user = User::find($id);
        $password_validation = Hash::make($request->input('password_confirm'));
        $user->password = $password_validation;
        $user->save();

        $redirect_respond = 'Zmieniono hasło użytkownika <b>'.$user->name.'</b>';

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
        $user = User::find($id);
        $user->delete();

        $redirect_respond = 'Usunięto użytkownika <b>'.$user->name.'</b>';

        Controller::operation($redirect_respond);
        return redirect(Session::get('requestReferrer'))->with('success', $redirect_respond);
    }
}

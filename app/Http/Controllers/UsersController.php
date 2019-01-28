<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Session;

class UsersController extends Controller
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
        return view('users.show')->with('user', $user);
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

        return redirect(Session::get('requestReferrer'))->with('success', 'Poprawnie zmieniono hasło dla: <b>'.$user->name.'</b>');
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
        //return redirect('/materials')->with('success', 'Usunięto materiał');
        return redirect(Session::get('requestReferrer'))->with('success', 'Usunięto użytkownika <b>'.$user->name.'</b>');
    }
}

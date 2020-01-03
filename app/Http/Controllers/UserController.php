<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

use Auth;
use Hash;

class UserController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('user/index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nom' => 'required|max:255',
            'prenom' => 'required|max:255',
            'statut' => 'required|max:255',
            'email' => 'required|max:255',
            'telephone' => 'required|max:255',
            'password' => 'required',
        ]);

        $password = Hash::make($request->password);
  //login as well.
  
        
        $user = new user();
        $user->nom = request('nom');
        $user->prenom = request('prenom');
        $user->statut = request('statut');
        $user->email = request('email');
        $user->telephone = request('telephone');
        $user->password = $password;

        $user->save();
        //Auth::login($user,true);
        //$user = User::create($validatedData);
   
        //return redirect('/user')->with('success', 'User is successfully saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('user/edit', compact('user'));
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
        $validatedData = $request->validate([
            'nom' => 'required|max:255',
            'prenom' => 'required|max:255',
            'statut' => 'required|max:255',
            'email' => 'required|max:255',
            'telephone' => 'required|max:255',
            'password' => 'required|max:255',
        ]);
       // User::whereId($id)->update($validatedData);
       $user = new user();
        $user->nom = request('nom');
        $user->prenom = request('prenom');
        $user->statut = request('statut');
        $user->email = request('email');
        $user->telephone = request('telephone');
        $user->password = Hash::make(request('password'));

        $user->update();

        return redirect('/user')->with('success', 'User is successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect('/user')->with('success', 'User is successfully deleted');
    }
}

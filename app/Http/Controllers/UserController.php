<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $view = view('user.index')->with('usuarios', User::all());
        return $view;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        // load the create form (app/views/nerds/create.blade.php)
        
        $view = view('user.create');
        return $view;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User;
        $user->name        = $request->name;
        $user->email = $request->email;
        $user->password    = $request->password;
        $user->isAdmin       = $request->isAdmin;
        $user->isActive       = $request->isActive;
        $user->save();
        return redirect()->route('user.index')->with('message', 'Usuario criado com sucesso!');
        
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
        return view('user.show')->with('user', $user);
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
        return view('user.edit')->with('user', $user);
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
        $user->name        = $request->name;
        $user->email = $request->email;
        $user->password    = $request->password;
        $user->isAdmin       = $request->isAdmin;
        $user->isActive       = $request->isActive;
        $user->save();
        return redirect()->route('user.index')->with('message', 'Usuario salvo com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       // delete
        $nerd = User::find($id);
        $nerd->delete();

        // redirect
        return redirect()->route('user.index')->with('message',  'Usuario deletado com sucesso!');
    }
}

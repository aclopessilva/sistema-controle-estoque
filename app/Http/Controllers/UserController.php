<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

/**
 * Inspirado neste tutorial
 * 
 * https://scotch.io/tutorials/simple-laravel-crud-with-resource-controllers
 * e
 * um pouco desse
 * https://medium.com/trainingcenter/php-criando-um-crud-b%C3%A1sico-com-laravel-5-4-f17afe11c66e
 * 
 */
class UserController extends Controller
{
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
        //bloqueando acesso para usuarios diferentes de admin
        if(Auth::user()->isAdmin  != true){
            return response('Nao permitido.', 403);
        }

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
        //bloqueando acesso para usuarios diferentes de admin
        if(Auth::user()->isAdmin  != true){
            return response('Nao permitido.', 403);
        }
        
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

        //bloqueando acesso para usuarios diferentes de admin
        if(Auth::user()->isAdmin  != true){
            return response('Nao permitido.', 403);
        }

        $user = new User;
        $user->name        = $request->name;
        $user->email = $request->email;
        $user->password    = bcrypt($request->password);
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

        //bloqueando acesso para usuarios diferentes de admin
        if(Auth::user()->isAdmin  != true){
            return response('Nao permitido.', 403);
        }


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

        //bloqueando acesso para usuarios diferentes de admin
        if(Auth::user()->isAdmin  != true){
            return response('Nao permitido.', 403);
        }
        
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

        //bloqueando acesso para usuarios diferentes de admin
        if(Auth::user()->isAdmin  != true){
            return response('Nao permitido.', 403);
        }

        $user = User::find($id);
        $user->name        = $request->name;
        $user->email = $request->email;
        $user->password    = bcrypt($request->password);
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
        //bloqueando acesso para usuarios diferentes de admin
        if(Auth::user()->isAdmin  != true){
            return response('Nao permitido.', 403);
        }


       // delete
        $user = User::find($id);
        $user->delete();

        // redirect
        return redirect()->route('user.index')->with('message',  'Usuario deletado com sucesso!');
    }
}

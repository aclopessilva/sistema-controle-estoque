<?php

namespace App\Http\Controllers;

use App\Fornecedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Inspirado neste tutorial
 * 
 * https://scotch.io/tutorials/simple-laravel-crud-with-resource-controllers
 * e
 * um pouco desse
 * https://medium.com/trainingcenter/php-criando-um-crud-b%C3%A1sico-com-laravel-5-4-f17afe11c66e
 * 
 */
class FornecedorController extends Controller
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
        $view = view('fornecedor.index')->with('fornecedors', Fornecedor::all());
        return $view;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $view = view('fornecedor.create');
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
        
        //https://laravel.com/docs/5.5/authentication        
        $user = Auth::user();
        
        $fornecedor = new Fornecedor;
        $fornecedor->nome        = $request->nome;
        $fornecedor->endereco = $request->endereco;
        $fornecedor->cnpj    = $request->cnpj;
        $fornecedor->save();
        return redirect()->route('fornecedor.index')->with('message', 'Fornecedor criado com sucesso!');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $fornecedor = Fornecedor::find($id);        
        return view('fornecedor.show')->with('fornecedor', $fornecedor);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $fornecedor = Fornecedor::find($id);        
        return view('fornecedor.edit')->with('fornecedor', $fornecedor);
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
        $fornecedor = Fornecedor::find($id);
        $fornecedor->nome        = $request->nome;
        $fornecedor->endereco = $request->endereco;
        $fornecedor->cnpj    = $request->cnpj;
        $fornecedor->save();
        return redirect()->route('fornecedor.index')->with('message', 'Fornecedor salvo com sucesso!');
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
        $fornecedor = Fornecedor::find($id);
        
        $possui_produtos_estoque = false;
        foreach($fornecedor->produtos as $produto){
            if($produto->quantidade > 0){
                $possui_produtos_estoque = true;
            }
        }
        
        if($possui_produtos_estoque){
            return redirect()->route('fornecedor.index')->with('error', 'O fornecedor possui produtos em estoque, NÃO pode ser eliminado!');
        }else{
            $fornecedor->delete();
            // redirect
            return redirect()->route('fornecedor.index')->with('message',  'Fornecedor deletado com sucesso!');
        }
    }
}

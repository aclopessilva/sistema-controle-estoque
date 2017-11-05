<?php

namespace App\Http\Controllers;

use App\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
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
        $view = view('produto.index')->with('produtos', Produto::all());
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
        $fornecedores = \App\Fornecedor::all()->pluck('nome', 'id');
        $view = view('produto.create')->with('fornecedores', $fornecedores);
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
        $produto = new Produto;
        $produto->nome              = $request->nome;
        $produto->descricao         = $request->descricao;
        $produto->custo             = $request->custo;
        $produto->quantidade        = $request->quantidade;
        $produto->fornecedor_id     = $request->fornecedor_id;
        $produto->save();
        return redirect()->route('produto.index')->with('message', 'Produto criado com sucesso!');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $produto = Produto::find($id);        
        return view('produto.show')->with('produto', $produto);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $produto = Produto::find($id);
        $fornecedores = \App\Fornecedor::all()->pluck('nome', 'id');
        return view('produto.edit')->with('produto', $produto)->with('fornecedores', $fornecedores);
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
        $produto = Produto::find($id);
        $produto->nome              = $request->nome;
        $produto->descricao         = $request->descricao;
        $produto->custo             = $request->custo;
        $produto->quantidade        = $request->quantidade;
        $produto->fornecedor_id     = $request->fornecedor_id;
        $produto->save();
        return redirect()->route('produto.index')->with('message', 'Produto salvo com sucesso!');
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
        $produto = Produto::find($id);
        $produto->delete();

        // redirect
        return redirect()->route('produto.index')->with('message',  'Produto deletado com sucesso!');
    }
    
    
    
    
    public function comestoque()
    {
        $view = view('produto.comestoque')->with('produtos', Produto::where('quantidade', '>', 0)->get());
        return $view;
    }
    
    public function semestoque()
    {
        $view = view('produto.semestoque')->with('produtos', Produto::where('quantidade', '=', 0)->get());
        return $view;
    }
    
}

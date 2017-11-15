<?php

namespace Tests\Feature;

use App\Fornecedor;
use App\Produto;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SCEGerenciarProdutosTest extends TestCase
{
    use RefreshDatabase;


    /************************************************************************
     * a. Os usuários logados poderão inserir produtos
     *      i. Um produto é composto por nome, descrição, fornecedor, custo no momento da compra e quantidade
     */

    /** @test */
    public function usuario_logado_pode_inserir_produto()
    {
        $usuario = factory(User::class)->create();

        $this->assertDatabaseHas('users',$usuario->toArray());


        $fornecedor = factory(Fornecedor::class)->create();
        $produto = factory(Produto::class)->make();
        $produto->fornecedor_id = $fornecedor->id;

        $this->actingAs($usuario)->post('/produto', $produto->toArray());

        $this->assertDatabaseHas('produtos', $produto->toArray());
    }

    /** @test */
    public function usuario_deslogado_nao_pode_inserir_produto()
    {

        $fornecedor = factory(Fornecedor::class)->create();
        $produto = factory(Produto::class)->make();
        $produto->fornecedor_id = $fornecedor->id;

        $this->post('/produto', $produto->toArray());

        $this->assertDatabaseMissing('produtos', $produto->toArray());
    }


}

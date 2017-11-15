<?php

namespace Tests\Feature;

use App\Fornecedor;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SCEGerenciarFornecedoresTest extends TestCase
{
    use RefreshDatabase;


    /************************************************************************
     *  a. Os usuários logados poderão inserir fornecedores no sistema
     *      i. Fornecedores consistem de nome, endereço, cnpj
     */

    /** @test */
    public function usuario_logado_pode_inserir_fornecedores()
    {
        $usuario = factory(User::class)->create();

        $this->assertDatabaseHas('users',$usuario->toArray());

        $fornecedor = factory(Fornecedor::class)->make();

        $this->actingAs($usuario)->post('/fornecedor', $fornecedor->toArray());

        $this->assertDatabaseHas('fornecedors', $fornecedor->toArray());
    }

    /** @test */
    public function usuario_deslogado_nao_pode_inserir_fornecedores()
    {
        $fornecedor = factory(Fornecedor::class)->make();

        // se nao usamos actingAs, laravel ja considera como usuario deslogado
        //$this->actingAs($usuario)->post('/fornecedor', $fornecedor->toArray());
        //
        $this->post('/fornecedor', $fornecedor->toArray());

        $this->assertDatabaseMissing('fornecedors', $fornecedor->toArray());
    }


}

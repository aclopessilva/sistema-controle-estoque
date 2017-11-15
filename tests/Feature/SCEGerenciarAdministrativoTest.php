<?php

namespace Tests\Feature;

use App\Fornecedor;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SCEGerenciarAdministrativoTest extends TestCase
{
    use RefreshDatabase;


    /************************************************************************
     *  a. Os usuários do tipo administrador poderão visualizar o valor total dos produtos  em estoque, em uma “Dashboard”
     */

    /** @test */
    public function usuario_admin_pode_ver_dashboard()
    {
        $usuario_admin = factory(User::class)->states('admin')->create();

        $this->assertDatabaseHas('users',$usuario_admin->toArray());

        $response = $this->actingAs($usuario_admin)->get('/home');

        $response->assertSee('Valor total de items com estoque:');
    }

    /** @test */
    public function usuario_normal_nao_pode_ver_dashboard()
    {
        $usuario = factory(User::class)->create();

        $this->assertDatabaseHas('users',$usuario->toArray());

        $response = $this->actingAs($usuario)->get('/home');

        $response->assertDontSee('Valor total de items com estoque:');
    }


}

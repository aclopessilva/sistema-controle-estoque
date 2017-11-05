<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SCETest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function usuario_admin_logado_pode_inserir_novo_usuario_normal()
    {
        $admin = factory(User::class)->states('admin')->create();

        $this->assertDatabaseHas('users',$admin->toArray());

        $novo_usuario = factory(User::class)->make();

        $this->actingAs($admin)->post('/user', $novo_usuario->toArray());

        $this->assertDatabaseHas('users', $novo_usuario->toArray());
    }

    /** @test */
    public function usuario_normal_logado_nao_pode_inserir_novo_usuario_normal()
    {
        $usuario_normal = factory(User::class)->create();

        $this->assertDatabaseHas('users',$usuario_normal->toArray());

        $novo_usuario = factory(User::class)->make();

        $this->actingAs($usuario_normal)->post('/user', $novo_usuario->toArray());

        $this->assertDatabaseMissing('users', $novo_usuario->toArray());
    }


    /** @test */
    public function usuario_admin_logado_pode_listar_usuarios()
    {
        $admin = factory(User::class)->states('admin')->create();
        $novo_usuario = factory(User::class)->create();

        $response = $this->actingAs($admin)->get('/user');
        $response->assertSee($novo_usuario->name);
    }

    /** @test */
    public function usuario_normal_logado_nao_pode_listar_usuarios()
    {
        $usuario_normal = factory(User::class)->create();
        $novo_usuario = factory(User::class)->create();

        $response = $this->actingAs($usuario_normal)->get('/user');
        $response->assertDontSee($novo_usuario->name);
    }

}

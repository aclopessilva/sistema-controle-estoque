<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SCEGerenciarUsuariosTest extends TestCase
{
    use RefreshDatabase;


    /************************************************************************
     * a. Um usuário poderá fazer login no sistema
     */

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

    /**********************************************************************
     * b. O usuário do tipo administrador poderá realizar o cadastro de usuários
     *      i. Um usuário consiste de nome, e-mail e senha.
     */

    /** @test */
    public function usuario_admin_logado_pode_listar_usuarios()
    {
        $admin = factory(User::class)->states('admin')->create();
        $novo_usuario = factory(User::class)->create();

        $response = $this->actingAs($admin)->get('/user');
        //verificamos se aparece na lista de usuarios
        $response->assertSee($novo_usuario->name);
    }

    /** @test */
    public function usuario_normal_logado_nao_pode_listar_usuarios()
    {
        $usuario_normal = factory(User::class)->create();
        $novo_usuario = factory(User::class)->create();

        $response = $this->actingAs($usuario_normal)->get('/user');
        //verificamos QUE NAO APARECA na lista de usuarios
        $response->assertDontSee($novo_usuario->name);
    }


    /************************************************************************
     * c. O usuário do tipo administrador pode desativar o acesso de um usuário ao sistema
     */

    /** @test */
    public function usuario_admin_pode_bloquear_usuario()
    {
        $admin = factory(User::class)->states('admin')->create();

        $novo_usuario = factory(User::class)->create();

        $response = $this->actingAs($admin)->get('/user/block/'.$novo_usuario->id);

        $response->assertRedirect('user');

        //tentamos logar, nao deve conseguir logar e deve mandar para a tela de login novamente
        $response = $this->post('login', [
            'email' => $novo_usuario->email,
            'password' => 'secret',
            '_token' => csrf_token()
        ]);

        $response->assertRedirect('login');

    }

    /** @test */
    public function usuario_normal_nao_pode_bloquear_usuario()
    {
        $usuario_normal = factory(User::class)->create();
        $otro_usuario = factory(User::class)->create();

        $response = $this->actingAs($usuario_normal)->get('/user/block/'.$otro_usuario->id);

        //verificamos que NAO apareca essa mensagem
        $response->assertDontSee('Usuario bloqueado com sucesso!');
        //e que a apareca mensagem seja... Nao permitido.
        $response->assertSee('Nao permitido');

        //tentamos logar, e deve conseguir logar
        $response = $this->post('/login', [
            'email' => $otro_usuario->email,
            'password' => 'secret',
            '_token' => csrf_token()
        ]);

        $response->assertRedirect('home');
    }

}

<?php

use App\User;
//use Illuminate\Foundation\Testing\RefreshDatabase;

class SCETest extends TestCase
{
    // use RefreshDatabase;

    /** @test */
    public function usuario_admin_logado_pode_inserir_novo_contato()
    {
         $user = factory(User::class)->create();
         echo 'name:' .$user->name;
         $this->seeInDatabase('users', 
                 [
                     'name' => $user->name
                 ]
                 );
         
         
         $this->visit(route('login'))
            ->type($user->email, 'email')
            ->type('secret', 'password')
            ->press('Login')
            ->seePageIs(route('home'));
    }
}

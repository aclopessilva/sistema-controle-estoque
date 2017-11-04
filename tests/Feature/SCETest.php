<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SCETest extends TestCase
{
     use RefreshDatabase;

    /** @test */
    public function usuario_admin_logado_pode_inserir_novo_contato()
    {
         $user = factory(User::class)->create();
         echo 'name:' .$user->name;
         $this->assertDatabaseHas('users', 
                 [
                     'name' => $user->name
                 ]
                 );
         
//          $this->browse(function ($browser) use ($user) {
//            $browser->visit('/login')
//                    ->type('email', $user->email)
//                    ->type('password', 'secret')
//                    ->press('Login')
//                    ->assertPathIs('/home');
//        });
        
         /*
         $this->visit('/login')
            ->type($user->email, 'email')
            ->type($user->password, 'password')
            ->press('Login')
            ->seePageIs('/home');*/
    }
}

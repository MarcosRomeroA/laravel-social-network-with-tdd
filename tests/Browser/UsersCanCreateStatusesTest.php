<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Throwable;

class UsersCanCreateStatusesTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * A Dusk test example.
     *
     * @test
     * @throws Throwable
     */
    public function usersCanCreateStatusesTest()
    {
        $user = User::factory()->create();

        $this->browse(function (Browser $browser) use ($user){
            $browser->loginAs($user)
                    ->visit('/')
                    ->type('body', 'Mi primer status') // Llena el textarea
                    ->press('#create-status') // Envia el form
                    ->waitForText('Mi primer status')
                    // Crea una imagen con este nombre
                    //->screenshot('create-status')
                    ->assertSee('Mi primer status'); // Espera ver esto
        });
    }
}

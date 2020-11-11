<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Throwable;

// php artisan dusk:make loginTest
class loginTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * A Dusk test example.
     *
     * @test
     * @throws Throwable
     */
    public function registeredUsersCanLogin()
    {
        User::factory()->create([
            'email'=>'marcos.andres.romero@gmail.com'
        ]);

        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                    ->type('email', 'marcos.andres.romero@gmail.com')
                    ->type('password', 'password')
                    ->press('#login-btn')
                    ->screenshot('login')
                    ->assertPathIs('/')
                    ->assertAuthenticated();
        });
    }
}

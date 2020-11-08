<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

// Browser test
// composer require laravel/dusk --dev
// php artisan dusk:install
// php artisan dusk:make UsersCanCreateStatusesTest


class CreateStatusTest extends TestCase
{
    // Este test fue creado usando 'php artisan make:test', lo cual genero este archivo en la carpeta Test/Feature

    // Trait => Ejecuta las migraciones
    use RefreshDatabase;

    /** @test */
    public function GuestUsersCannotCreateStatuses()
    {
        // Deshabilita el manejo de excepciones en este test
        //$this->withoutExceptionHandling();

        // Intenta crear un registro, no es un usuario autenticado
        $response = $this->post(route('statuses.store'), ['body'=>'']);

        // Debe ir a login, caso contrario test siguiente, recibe un json
        $response->assertRedirect('login');
    }


    /** @test */
    public function AnAuthenticatedUserShouldCreateStatuses()
    {
        // Deshabilita el manejo de excepciones en este test
        $this->withoutExceptionHandling();

        // 1. Given => teniendo un usuario autenticado
        $user = User::factory()->create();
        $this->actingAs($user);

        // 2. When => Cuando hace un post request a status
        $response = $this->postJson(route('statuses.store'), ['body'=>'Mi primer estado']);

        // Verifica que el codigo de respuesta sea mayor a 200 y menor a 300, redireccion es 302 por lo cual falla
        //$response->assertSuccessful();

        //Verifica que nos redireccione, util si trabajos con vista blade
        //$response->assertRedirect('/');

        $response->assertJson([
            'body'=>'Mi primer estado'
        ]);

        // 3. Then => Un nuevo estado en DB
        $this->assertDatabaseHas('statuses', [
            'user_id'=>$user->id,
            'body'=> 'Mi primer estado'
        ]);
    }

    /**
     * @test
     */
    public function aStatusRequiresBodyRequiresAminimumLength(){
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->postJson(route('statuses.store'), ['body'=>'asdf']);

        // Error 422 Entidad no procesable
        $response->assertStatus(422);

        //dd($response->getContent());
        //{"message":"The given data was invalid.","errors":{"body":["The body field is required."]}}

        // Verifica la estructura del json
        $response->assertJsonStructure([
            'message',
            'errors'=>['body']
        ]);
    }
}

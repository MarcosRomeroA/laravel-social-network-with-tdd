<?php

namespace Tests\Feature;

use App\Models\Status;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ListStatusesTest extends TestCase
{
    //php artisan make:factory StatusFactory -m Models\\Status

    use RefreshDatabase;

    /** @test */
    public function canGetAllStatuses()
    {
        // Deshabilitar el manejo de excepciones para obtener mas detalles
        $this->withoutExceptionHandling();

        $status1 = Status::factory()->create(['created_at'=>now()->subDays(4)]);
        $status2 = Status::factory()->create(['created_at'=>now()->subDays(3)]);
        $status3 = Status::factory()->create(['created_at'=>now()->subDays(2)]);
        $status4 = Status::factory()->create(['created_at'=>now()->subDays(1)]);

        $response = $this->get('statuses');

        $response->assertSuccessful();

        $response->assertJson([
            'total' => 4
        ]);

        $response->assertJsonStructure([
            'data',
            'total',
            'first_page_url',
            'last_page_url',
        ]);

        $this->assertEquals(
            $status4->id,
            $response->json('data.0.id'),
        );
    }
}

<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Service;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookingTest extends TestCase
{
   public function test_customer_can_book_service()
{
    $user = User::factory()->create();
    $service = Service::factory()->create();

    Sanctum::actingAs($user);

    $response = $this->postJson('/api/bookings', [
        'service_id' => $service->id,
        'booking_date' => now()->addDay()->toDateString(),
    ]);

    $response->assertStatus(201);
}

    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}

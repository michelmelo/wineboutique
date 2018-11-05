<?php

namespace Tests\Feature\Cart;

use App\User;
use App\Wine;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CartStoreTest extends TestCase
{
    public function test_it_fails_if_unauthenticated()
    {
        $this->postJson('/cart')
            ->assertStatus(401);
    }

    public function test_it_requires_wines()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->postJson('cart')
            ->assertJsonValidationErrors(['wines']);
    }

    public function test_it_required_wines_to_be_an_array()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->postJson('cart', [
                'wines' => 1
            ])
            ->assertJsonValidationErrors(['wines']);
    }

    public function test_it_required_wines_to_have_an_id()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->postJson('cart', [
                'wines' => [
                    ['quantity' => 1]
                ]
            ])
            ->assertJsonValidationErrors(['wines.0.id']);
    }

    public function test_it_requires_wines_to_exist()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->postJson('cart', [
                'wines' => [
                    ['id' => 0, 'quantity' => 1]
                ]
            ])
            ->assertJsonValidationErrors(['wines.0.id']);
    }

    public function test_it_requires_wines_quantity_to_be_numeric()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->postJson('cart', [
                'wines' => [
                    ['id' => 0, 'quantity' => 'one']
                ]
            ])
            ->assertJsonValidationErrors(['wines.0.quantity']);
    }

    public function test_it_requires_wines_quantity_to_be_at_least_one()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->postJson('cart', [
                'wines' => [
                    ['id' => 0, 'quantity' => 0]
                ]
            ])
            ->assertJsonValidationErrors(['wines.0.quantity']);
    }

    public function test_it_can_add_wines_to_the_users_cart()
    {
        $user = factory(User::class)->create();

        $wine = factory(Wine::class)->create();

        $this->actingAs($user)
            ->postJson('cart', [
                'wines' => [
                    ['id' => $wine->id, 'quantity' => 2]
                ]
            ]);

        $this->assertDatabaseHas('cart_user', [
            'wine_id' => $wine->id,
            'quantity' => 2
        ]);
    }
}

<?php

namespace Tests\Unit\Cart;

use App\Cart;
use App\User;
use App\Wine;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CartTest extends TestCase
{
    public function test_it_can_add_wines_to_the_cart()
    {
        $cart = new Cart(
            $user = factory(User::class)->create()
        );

        $wine = factory(Wine::class)->create();

        $cart->add([
            ['id' => $wine->id, 'quantity' => 1]
        ]);

        $this->assertCount(1, $user->fresh()->cart);
    }

    public function test_it_increments_quantity_when_adding_more_wines()
    {
        $wine = factory(Wine::class)->create();

        $cart = new Cart(
            $user = factory(User::class)->create()
        );

        $cart->add([
            ['id' => $wine->id, 'quantity' => 1]
        ]);


        $cart = new Cart($user->fresh());

        $cart->add([
            ['id' => $wine->id, 'quantity' => 1]
        ]);

        $this->assertEquals($user->fresh()->cart->first()->pivot->quantity, 2);
    }

    public function test_it_can_update_quantities_in_the_cart()
    {
        $cart = new Cart(
            $user = factory(User::class)->create()
        );

        $user->cart()->attach(
            $wine = factory(Wine::class)->create(), [
                'quantity' => 1
            ]
        );

        $cart->update($wine->id, 2);

        $this->assertEquals($user->fresh()->cart->first()->pivot->quantity, 2);
    }
}

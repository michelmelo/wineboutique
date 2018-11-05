<?php

namespace Tests\Feature\Cart;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CartUpdateTest extends TestCase
{
    public function test_it_fails_if_unauthenticated()
    {
        $this->patchJson('/cart/1')
            ->assertStatus(401);
    }
}

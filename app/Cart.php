<?php

namespace App;

class Cart
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function add($wines)
    {
        $this->user->cart()->syncWithoutDetaching(
            $this->getStorePayload($wines)
        );
    }

    public function update($wineId, $quantity)
    {
        $this->user->cart()->updateExistingPivot($wineId, [
            'quantity' => $quantity
        ]);
    }

    public function delete($wineId)
    {
        $this->user->cart()->detach($wineId);
    }

    public function empty()
    {
        $this->user->cart()->detach();
    }

    protected function getStorePayload($wines)
    {
        return collect($wines)->keyBy('id')->map(function($wine) {
            return [
                'quantity' => $wine['quantity'] + $this->getCurrentQuantity($wine['id'])
            ];
        })->toArray();
    }

    protected function getCurrentQuantity($wineId)
    {
        if($wine = $this->user->cart->where('id', $wineId)->first()) {
            return $wine->pivot->quantity;
        }

        return 0;
    }
}
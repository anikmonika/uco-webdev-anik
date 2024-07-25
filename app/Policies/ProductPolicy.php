<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;

class ProductPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function create_product(User $user):bool
    {
        if ($user->email == 'andyjanuar@gmail.com') {
            return true;
        }
        return false;
    }


    public function edit_product(User $user, Product $product):bool
    {
        if ($product->id == 51) {
            return true;
        }
        return false;
    }
}
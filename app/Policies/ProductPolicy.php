<?php
namespace App\Policies;

use App\Models\User;
use App\Models\Product;

class ProductPolicy
{
    public function authorize(User $user, Product $product)
    {
        // Check if the user has permission to view this product
        return $user->id === $product->user_id;
    }
}
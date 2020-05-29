<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Domain\Models\Tables\Seller;
use App\Domain\Models\Tables\Transaction;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Transaction::class, static function (Faker $faker) {
    $seller = Seller::has('products')->get()->random();
    $buyer = User::all()->except($seller->id)->random();
    return [
        'quantity' => $faker->numberBetween(1,3),
        'buyer_id' => $buyer->id,
        'product_id'=> $seller->products->random(),
    ];
});

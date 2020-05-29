<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Domain\Models\Tables\Product;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Product::class, static function (Faker $faker)
{
    return [
        'name' => $faker->word,
        'description' => $faker->word,
        'quantity' => $faker->numberBetween(1,10),
        'status' => $faker->randomElement([Product::STATUS_AVAILABLE, Product::STATUS_UNAVAILABLE]),
        'image' => $faker->randomElement(['1.png', '2.png', '3.png']),
        'seller_id' => User::all()->random()->id,
    ];
});

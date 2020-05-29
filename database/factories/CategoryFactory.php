<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Domain\Models\Tables\Category;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Category::class, static function (Faker $faker)
{
    return [
        'name' => $faker->word,
        'description' => $faker->paragraph(1),
    ];
});

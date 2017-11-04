<?php

use Faker\Generator as Faker;

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\Produto::class, function (Faker $faker) {
    return [
        
        'nome' => $faker->name,
        'descricao' => $faker->text,
        'custo' => $faker->randomFloat(2, 3, 10),
        'quantidade' => $faker->randomDigit,

    ];
});

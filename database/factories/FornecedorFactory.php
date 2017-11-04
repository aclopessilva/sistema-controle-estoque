<?php

use Faker\Generator as Faker;

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\Fornecedor::class, function (Faker $faker) {
    
    return [
        
        'nome' => $faker->name,
        'endereco' => $faker->text,
        'cnpj' => $faker->randomDigit,

    ];
});

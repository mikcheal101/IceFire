<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Author;
use App\Book;
use Faker\Generator as Faker;

$factory->define(Book::class, function (Faker $faker) {

    return [
        'name' => $faker->name,
        'isbn' => $faker->uuid,
        'country' => $faker->country,
        'number_of_pages' => 23,
        'publisher' => $faker->name,
        'release_date' => $faker->date(),
    ];
});

$factory->afterCreating(Book::class, function ($book, $faker) {
    $book->authors()->save(factory(Author::class)->make());
});

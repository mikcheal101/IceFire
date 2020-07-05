<?php

namespace Tests\Feature;

use App\Book;
// use Faker\Generator as Faker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class Api extends TestCase
{
    use WithFaker;
    use RefreshDatabase;


    /**
     * When the endpoint:
     * GET http://localhost:8080/api/external-books?name=:nameOfABook
     * is requested, your application should query the Ice And Fire API 
     * and use the data received to respond with a JSON result
     *
     * @return void
     */
    public function testRequirementOne()
    {
        $route = route("get-external-books", [
            'name' => $this->faker->name
        ]);
        $response = $this->get($route);

        $response->assertStatus(200);
    }

    public function testCanGetAllBooks()
    {
        $route = route("books.index");
        $response = $this->get($route);
        // dd([$route, $response]);
        $response->assertStatus(200);
    }

    public function testCanGetABook()
    {

        $book = factory(Book::class)->create();
        $route = route("books.show", [
            'book' => $book->id,
        ]);

        $response = $this->get($route);
        $json = [
            "name" => $book->name,
            "isbn" => $book->isbn,
            "authors" => collect($book->authors)->map(function ($author) {
                return $author->name;
            })->toArray(),
            "number_of_pages" => "$book->number_of_pages",
            "publisher" => $book->publisher,
            "country" => $book->country,
            "release_date" => $book->release_date,
        ];
        $response->assertStatus(200);
        $response->assertExactJson([
            'status' => 'success',
            'status_code' => 200,
            'data' => $json,
        ]);
    }

    public function testCanUpdateABook()
    {
        $book = factory(Book::class)->create();
        $route = route("books.update", [
            'book' => $book->id,
        ]);
        $data = [
            'name' => $this->faker->name,
            'isbn' => $this->faker->uuid,
            'country' => $this->faker->country,
            'number_of_pages' => 20,
            'publisher' => $this->faker->name,
            'release_date' => $this->faker->date(),
            'authors' => [
                $this->faker->name,
            ]
        ];

        $response = $this->put($route, $data);
        $response->assertStatus(200);
        $response->assertExactJson([
            'status_code' => 200,
            'status' => 'success',
            'message' => 'the book {$book->name} was updated successfully',
            'data' => $data,
        ]);
    }

    public function testCanDeleteABook()
    {
        $book = factory(Book::class)->create();
        $route = route("books.destroy", [
            'book' => $book->id,
        ]);

        $response_data = [
            "status_code" => 204,
            "status" => "success",
            "message" => "The book {$book->name} was deleted successfully",
            "data" => [],
        ];

        $response = $this->delete($route);
        $response->assertStatus(200);
        $response->assertExactJson($response_data);
    }

    public function testCanCreateABook()
    {
        $route = route("books.store");
        $data = [
            'name' => $this->faker->name,
            'isbn' => $this->faker->uuid,
            'country' => $this->faker->country,
            'number_of_pages' => 20,
            'publisher' => $this->faker->name,
            'release_date' => $this->faker->date(),
            'authors' => [
                $this->faker->name,
            ]
        ];

        $response = $this->post($route, $data);
        $response->assertStatus(200);
        $response->assertExactJson([
            'status_code' => 201,
            'status' => 'success',
            'data' => ['book' => $data,]
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Author;
use App\Book;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;

use App\Http\Resources\Book as BookResource;
use App\Http\Resources\NewBook as NewBookResource;
use App\Http\Resources\OfflineBook as OfflineBookResource;

class BooksController extends Controller
{
    /**
     * Method to return all the books
     *
     * @param Request $request
     * @return JsonResponse [Book] instance
     */
    public function LoadBooks(Request $request, $name): JsonResponse
    {
        try {
            $http = Http::get(env('ICE_FIRE_API'));
            return response()->json([
                'status_code' => 200,
                'status' => 'success',
                'data' => OfflineBookResource::collection($http->json())
            ], 200);
        } catch (Exception $exception) {
            return response()->json($exception->getMessage(), 400);
        }
    }

    /**
     * Method to create a book
     *
     * @param Request $request
     * @return JsonResponse $book Book instance
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $book = new Book();
            $book->name = $request->name;
            $book->isbn = $request->isbn;
            $book->number_of_pages = $request->number_of_pages;
            $book->publisher = $request->publisher;
            $book->country = $request->country;
            $book->release_date = $request->release_date;
            $book->save();

            if ($request->authors) {
                $book->authors()->sync(collect($request->authors)->map(function ($author) {
                    return Author::firstOrCreate(['name' => $author])->id;
                }));
            }

            return response()->json([
                'status_code' => 201,
                'status' => 'success',
                'data' => ['book' => new BookResource($book),],
            ], 200);
        } catch (Exception $exception) {
            return response()->json($exception->getMessage(), 400);
        }
    }

    /**
     * Method to get all the books from the db
     *
     * @param Request $request
     * @return JsonResponse [Book] instance
     */
    public function index(Request $request): JsonResponse
    {
        $books = Book::all();
        $response = [
            'status_code' => 200,
            'status' => 'success',
            'data' => NewBookResource::collection($books),
        ];
        return response()->json($response, 200);
    }

    /**
     * Method to update a book
     * @param Request $request
     * @param int $book id
     * @return JsonResponse $book instance
     */
    public function update(Request $request, int $id): JsonResponse
    {
        try {
            $book = Book::find($id);

            if ($book) {
                $book->name = $request->name ?? $book->name;
                $book->isbn = $request->isbn ?? $book->isbn;
                $book->number_of_pages = $request->number_of_pages ?? $book->number_of_pages;
                $book->publisher = $request->publisher ?? $book->publisher;
                $book->country = $request->country ?? $book->country;
                $book->release_date = $request->release_date ?? $book->release_date;
                if ($request->authors) {
                    $book->authors()->sync(collect($request->authors)->map(function ($author) {
                        return Author::firstOrCreate(['name' => $author])->id;
                    }));
                }
                $book->save();
            }
            return response()->json(
                [
                    'status_code' => 200,
                    'status' => 'success',
                    'message' => 'the book {$book->name} was updated successfully',
                    'data' => new BookResource($book),
                ],
                200
            );
        } catch (Exception $exception) {
            return response()->json($exception->getMessage(), 400);
        }
    }

    /**
     * Method to delete a book
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse boolean instance
     */
    public function destroy(Request $request, int $id): JsonResponse
    {
        try {
            $book = Book::find($id);
            $response = [
                "status_code" => 204,
                "status" => "success",
                "message" => "The book {$book->name} was deleted successfully",
                "data" => [],
            ];
            $book->delete();
            return response()->json($response, 200);
        } catch (Exception $exception) {
            $response = [
                "status_code" => 400,
                "status" => "error",
                "message" => $exception->getMessage(),
                "data" => [],
            ];
            return response()->json($response, 200);
        }
    }

    /**
     * Method to get all a books from the db
     * 
     * @param Request $request
     * @param int $id book id
     * @return JsonResponse $book instance
     */
    public function show(Request $request, int $id): JsonResponse
    {
        $book = Book::find($id);
        $response = [
            'status_code' => 200,
            'status' => 'success',
            'data' => new BookResource($book)
        ];
        return response()->json($response, 200);
    }
}

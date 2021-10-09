<?php

namespace App\Services;

use App\Http\Resources\Book\BookCollection;
use App\Http\Resources\Book\BookResource;
use App\Repositories\Book\BookRepository;
use DB;
use Illuminate\Support\Facades\Redis;
use Storage;

class BookService
{
    protected BookRepository $bookRepository;

    /**
     * @param BookRepository $bookRepository
     */
    public function __construct(BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    public function getBooks(array $relations = [])
    {
        $cache = Redis::connection()->client()->get('books');

        if($cache) {
            $books = [
                'data' => json_decode($cache)
            ];
        } else {
            $books = new BookCollection($this->bookRepository->all($relations));
            Redis::connection()->client()->set('books', $books->toJson());
        }

        return $books;
    }

    public function findBook($id, array $relations = [])
    {
        $cache = Redis::connection()->client()->get("book_{$id}");

        if($cache) {
            $book = [
                'data' => json_decode($cache)
            ];
        } else {
            $book = new BookResource($this->bookRepository->find($id, $relations));
            Redis::connection()->client()->set("book_{$id}", $book->toJson());
        }

        return $book;
    }

    public function storeBook($request)
    {
        return $this->bookRepository->create($request);
    }

    public function uploadCover($id, $request)
    {
        $path = $this->bookRepository->find($id)->cover;

        if($path) {
            Storage::disk('public')->delete($path);
        }
        $path = $request['cover']->store('/assets/cover_book', 'public');

        return $this->bookRepository->update($id, [
            'cover' => $path
        ]);
    }

    public function updateBook($id, $request)
    {
        DB::transaction(function () use ($id, $request){
            return $this->bookRepository->update($id, $request);
        });
    }

    public function deleteBook($id)
    {
        $path = $this->bookRepository->find($id)->cover;

        if($path) {
            Storage::disk('public')->delete($path);
        }

        return $this->bookRepository->delete($id);
    }
}

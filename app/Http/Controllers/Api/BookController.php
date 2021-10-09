<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Book\StoreBookRequest;
use App\Http\Requests\Book\UpdateBookRequest;
use App\Http\Requests\UploadCoverRequest;
use App\Services\BookService;
use Illuminate\Http\Request;

class BookController extends Controller
{
    private BookService $bookService;

    /**
     * @param BookService $bookService
     */
    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }

    public function index()
    {
        return $this->bookService->getBooks(['author']);
    }

    public function show($id)
    {
        return $this->bookService->findBook($id, ['author']);
    }

    public function store(StoreBookRequest $request)
    {
        $book = $this->bookService->storeBook($request->validated());

        return response()
            ->json([
                'message' => 'success',
                'data' => $book,
            ]);
    }

    /**
     * @param $id
     * @param UpdateBookRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, UpdateBookRequest $request)
    {
        $this->bookService->updateBook($id, $request->validated());

        return response()
            ->json(['message' => 'success']);
    }

    public function uploadCover(UploadCoverRequest $request, $id)
    {
        $this->bookService->uploadCover($id, $request->validated());

        return response()
            ->json(['message' => 'success']);
    }

    public function destroy($id)
    {
        $this->bookService->deleteBook($id);

        return response()
            ->json(['message' => 'success']);
    }
}

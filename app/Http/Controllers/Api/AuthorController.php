<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Author\StoreAuthorRequest;
use App\Http\Requests\Author\UpdateAuthorRequest;
use App\Http\Resources\Author\AuthorCollection;
use App\Services\AuthorService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class AuthorController extends Controller
{

    /**
     * @var AuthorService
     */
    private $authorService;


    /**
     * @param AuthorService $authorService
     */
    public function __construct(AuthorService $authorService)
    {
        $this->authorService = $authorService;
    }

    /**
     * @return \App\Http\Resources\Author\AuthorCollection
     */
    public function index()
    {
        return $this->authorService->getAuthors(['books']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreAuthorRequest $request)
    {
        $author = $this->authorService->createAuthor($request->validated());

        return response()
            ->json([
                'message' => 'success',
                'data' => $author,
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \App\Http\Resources\Author\AuthorResource
     */
    public function show($id)
    {
        return $this->authorService->findAuthor($id, ['books']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateAuthorRequest $request, $id)
    {
        $this->authorService->updateAuthor($id, $request->validated());

        return response()
            ->json([
                'message' => 'success',
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $this->authorService->deleteAuthor($id);

        return response()
            ->json([
                'message' => 'success',
            ]);
    }
}

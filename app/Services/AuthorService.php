<?php

namespace App\Services;

use App\Http\Resources\Author\AuthorCollection;
use App\Http\Resources\Author\AuthorResource;
use App\Repositories\Author\AuthorRepository;
use Illuminate\Support\Facades\Redis;

class AuthorService
{
    private AuthorRepository $authorRepository;

    /**
     * @param AuthorRepository $authorRepository
     */
    public function __construct(AuthorRepository $authorRepository)
    {
        $this->authorRepository = $authorRepository;
    }

    public function getAuthors(array $relations = [])
    {
        $cache = Redis::connection()->client()->get('authors');

        if($cache) {
            $authors = [
                'data' => json_decode($cache)
            ];
        } else {
            $authors = new AuthorCollection($this->authorRepository->all($relations));
            Redis::connection()->client()->set('authors', $authors->toJson());
        }

        return $authors;
    }

    public function findAuthor($id, array $relations = [])
    {
        $cache = Redis::connection()->client()->get("author_{$id}");

        if($cache) {
            $author = [
                'data' => json_decode($cache)
            ];
        } else {
            $author = new AuthorResource($this->authorRepository->find($id, $relations));
            Redis::connection()->client()->set("author_{$id}", $author->toJson());
        }

        return $author;
    }

    public function createAuthor($request)
    {
        return $this->authorRepository->create($request);
    }

    public function updateAuthor($id, $request)
    {
        return $this->authorRepository->update($id, $request);
    }

    public function deleteAuthor($id)
    {
        return $this->authorRepository->delete($id);
    }
}

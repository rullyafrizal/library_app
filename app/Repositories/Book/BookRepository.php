<?php

namespace App\Repositories\Book;

use App\Models\Book;
use App\Repositories\EloquentRepository;

class BookRepository extends EloquentRepository
{
    protected Book $model;

    /**
     * @param Book $model
     */
    public function __construct(Book $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }
}

<?php

namespace App\Repositories\Author;

use App\Models\Author;
use App\Repositories\EloquentRepository;

class AuthorRepository extends EloquentRepository
{
    protected Author $model;

    /**
     * @param Author $model
     */
    public function __construct(Author $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

}

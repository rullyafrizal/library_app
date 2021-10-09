<?php

namespace App\Repositories;

use App\Interfaces\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class EloquentRepository implements RepositoryInterface
{
    private Model $model;

    /**
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function all(array $relations = [])
    {
        return $this->model->newQuery()->with($relations)->get();
    }


    /**
     * @param $id
     * @param array $relations
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|Model|null
     */
    public function find($id, array $relations = [])
    {
        return $this->model->newQuery()->with($relations)->findOrFail($id);
    }

    /**
     * @param array $payload
     * @return \Illuminate\Database\Eloquent\Builder|Model
     */
    public function create(array $payload = [])
    {
        return $this->model->newQuery()->create($payload);
    }

    /**
     * @param $id
     * @param array $payload
     * @return bool|int
     */
    public function update($id, array $payload = [])
    {
        return $this->model->newQuery()->findOrFail($id)->update($payload);
    }

    /**
     * @param $id
     * @return bool|mixed|null
     */
    public function delete($id)
    {
        return $this->model->newQuery()->findOrFail($id)->delete();
    }

}

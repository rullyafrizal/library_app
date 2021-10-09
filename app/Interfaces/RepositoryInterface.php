<?php

namespace App\Interfaces;

interface RepositoryInterface
{
    public function all(array $relations = []);
    public function find($id, array $relations = []);
    public function create(array $payload = []);
    public function update($id, array $payload = []);
    public function delete($id);
}

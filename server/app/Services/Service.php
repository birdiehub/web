<?php

namespace App\Services;


use Illuminate\Database\Eloquent\Model;

abstract class Service
{
    private Model $_model;

    public function __construct(Model $model)
    {
        $this->_model = $model;
    }

    public function model() : Model
    {
        return $this->_model;
    }

    public function find($id) : Model
    {
        return $this->model()->findOrFail($id);
    }

    public function create($data) : Model
    {
        return $this->model()->create($data);
    }

    public function update($id, $data) : Model
    {
        $model = $this->find($id);
        $model->update($data);
        return $model;
    }

    public function delete($id) : bool {
        $model = $this->find($id);
        return $model->delete();
    }

}

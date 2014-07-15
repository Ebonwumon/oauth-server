<?php

namespace UAlberta\Authentication;


use Illuminate\Database\Eloquent\ModelNotFoundException;
use Whoops\Example\Exception;

class UserRepository {

    protected $model;

    public function __construct(User $model) {
        $this->model = $model;
    }

    public function find($id) {
        return $this->model->findOrFail($id);
    }

    public function create(array $attributes = array()) {
        if (!isset($attributes['id']) || $attributes['id'] === null) {
            throw new Exception("Id is required"); // Todo class this exception
        }
        try {
            $user = $this->find($attributes['id']);
            // TODO validation
            $user->fill($attributes);
            $user->save();
            return $user;

        } catch (ModelNotFoundException $exception) {
            // TODO validation
            return $this->model->create($attributes);
        }
    }

} 
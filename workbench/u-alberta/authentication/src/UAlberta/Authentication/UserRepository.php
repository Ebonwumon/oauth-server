<?php

namespace UAlberta\Authentication;


use Depotwarehouse\Toolbox\Verification;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserRepository {

    protected $model;

    public function __construct(User $model) {
        $this->model = $model;
    }

    public function find($ccid) {
        return $this->model->where('ccid', $ccid)->firstOrFail();
    }

    public function create(array $attributes = array()) {
        Verification::require_set($attributes, [ "ccid" ]);
        try {
            $user = $this->find($attributes['ccid']);
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
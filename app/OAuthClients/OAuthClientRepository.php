<?php
/**
 * Created by PhpStorm.
 * User: ebon
 * Date: 7/8/14
 * Time: 4:13 AM
 */

namespace OAuthClients;


use OAuthClients\EloquentModels\OAuthClientEloquent;

class OAuthClientRepository implements OAuthClientRepositoryInterface {

    /** @var \OAuthClients\EloquentModels\OAuthClientEloquent  */
    protected $model;

    public function __construct(OAuthClientEloquent $oauth_client) {
        $this->model = $oauth_client;
    }


    public function find($id)
    {
        // TODO: Implement find() method.
    }

    public function create(array $attributes)
    {
        // TODO validation
        $attributes = array_merge($attributes, [ 'id' => $this->generateRandomString(), 'secret' => $this->generateRandomString() ]);
        return $this->model->create($attributes);

    }

    public function destroy($id)
    {
        // TODO: Implement destroy() method.
    }

    protected function generateRandomString($length = 40) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }
}
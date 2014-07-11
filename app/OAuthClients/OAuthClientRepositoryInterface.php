<?php
/**
 * Created by PhpStorm.
 * User: ebon
 * Date: 7/8/14
 * Time: 4:12 AM
 */

namespace OAuthClients;


interface OAuthClientRepositoryInterface {

    public function find($id);

    public function create(array $attributes);

    public function destroy($id);


} 
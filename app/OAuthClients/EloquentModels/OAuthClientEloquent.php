<?php
/**
 * Created by PhpStorm.
 * User: ebon
 * Date: 7/8/14
 * Time: 4:14 AM
 */

namespace OAuthClients\EloquentModels;


class OAuthClientEloquent extends \Illuminate\Database\Eloquent\Model {

    protected $table = 'oauth_clients';

    protected $primaryKey = 'id';
    public $incrementing = false;

    protected $fillable = array('id', 'secret', 'name');




} 
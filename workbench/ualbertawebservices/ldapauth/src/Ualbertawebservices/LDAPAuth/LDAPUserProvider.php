<?php
/**
 * Created by PhpStorm.
 * User: ebon
 * Date: 7/3/14
 * Time: 5:50 AM
 */

namespace Ualbertawebservices\LDAPAuth;


use Illuminate\Auth\UserInterface;
use Illuminate\Auth\UserProviderInterface;

class LDAPUserProvider implements UserProviderInterface {

    /** @var resource  */
    protected $connection;

    public function __construct() {
        $this->connection = ldap_connect("ldaps://directory.srv.ualberta.ca", 636);
    }

    /**
     * Retrieve a user by their unique identifier.
     *
     * @param  mixed $identifier
     * @return \Illuminate\Auth\UserInterface|null
     */
    public function retrieveById($identifier)
    {
        // TODO: Implement retrieveById() method.
    }

    /**
     * Retrieve a user by the given credentials.
     *
     * @param  array $credentials
     * @return \Illuminate\Auth\UserInterface|null
     */
    public function retrieveByCredentials(array $credentials)
    {
        $results = ldap_search($this->connection, "ou=people,dc=ualberta,dc=ca", "uid={$credentials['ccid']}");
        return new LDAPUser($results);
    }

    /**
     * Validate a user against the given credentials.
     *
     * @param  \Illuminate\Auth\UserInterface $user
     * @param  array $credentials
     * @return bool
     */
    public function validateCredentials(UserInterface $user, array $credentials)
    {
        // TODO do I need to sanitize these?
        $binding = ldap_bind($this->connection, "uid={$credentials['ccid']},ou=people,dc=ualberta,dc=ca", $credentials['password']);

       return $binding;
    }

    /**
     * Retrieve a user by by their unique identifier and "remember me" token.
     *
     * @param  mixed $identifier
     * @param  string $token
     * @return \Illuminate\Auth\UserInterface|null
     */
    public function retrieveByToken($identifier, $token)
    {
        // TODO: Implement retrieveByToken() method.
    }

    /**
     * Update the "remember me" token for the given user in storage.
     *
     * @param  \Illuminate\Auth\UserInterface $user
     * @param  string $token
     * @return void
     */
    public function updateRememberToken(UserInterface $user, $token)
    {
        // TODO: Implement updateRememberToken() method.
    }
}
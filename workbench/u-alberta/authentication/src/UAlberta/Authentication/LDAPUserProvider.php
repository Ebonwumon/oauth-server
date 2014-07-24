<?php
/**
 * Created by PhpStorm.
 * User: ebon
 * Date: 7/21/14
 * Time: 5:55 AM
 */

namespace UAlberta\Authentication;


use Illuminate\Auth\UserInterface;
use Illuminate\Auth\UserProviderInterface;

use Config;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use UAlberta\Authentication\Exceptions\LDAPConnectionException;
use UAlberta\Authentication\Exceptions\LDAPSearchException;
use Depotwarehouse\Toolbox\Verification;

class LDAPUserProvider implements UserProviderInterface {

    /** @var resource  */
    protected $connection;
    /** @var  UserRepository */
    protected $userRepository;

    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
        $this->connection = $this->initalizeLDAP();
    }

    /**
     * Initialize an LDAP connection
     * @return resource
     * @throws Exceptions\LDAPConnectionException
     */
    protected function initalizeLDAP() {
        $host = Config::get('authentication::ldap_host');
        $port = Config::get('authentication::ldap_port');
        $conn = ldap_connect($host, $port);
        if ($conn === false) {
            throw new LDAPConnectionException("Error connecting to the LDAP server {$host}:{$port}");
        }
        return $conn;
    }

    /**
     * Retrieve a user by their unique identifier.
     *
     * @param  string $identifier The CCID of the user
     * @return \Illuminate\Auth\UserInterface|null
     * @throws LDAPSearchException
     */
    public function retrieveById($identifier)
    {
        try {
            return $this->userRepository->find($identifier);
        } catch (ModelNotFoundException $exception) {
            // We must bind to our service account to get the employeenumber
            $service_user = Config::get("authentication::ldap_service_user");
            $service_password = Config::get("authentication::ldap_service_password");
            ldap_bind($this->connection, "uid={$service_user},ou=people,dc=ualberta,dc=ca", "{$service_password}");

            $results = ldap_search($this->connection, "ou=People,dc=ualberta,dc=ca", "(uid={$identifier})");

            if ($results === false) {
                throw new LDAPSearchException("Error searching LDAP for the required object");
            }

            $entries = ldap_get_entries($this->connection, $results);

            if ($entries === false) {
                throw new LDAPSearchException("Error searching LDAP for the required object");
            }

            if ($entries["count"] == 0) {
                throw new LDAPSearchException("Could not find any matching results in the LDAP server");
            }
            $attributes = [
                'first_name' => $entries[0]["givenname"][0],
                'last_name' => $entries[0]["sn"][0],
                'ccid' => $entries[0]["uid"][0],
                'id' => $entries[0]["employeenumber"][0],
            ];
            return $this->userRepository->create($attributes);
        }
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

    /**
     * Retrieve a user by the given credentials.
     *
     * @param  array $credentials
     * @return \Illuminate\Auth\UserInterface|null
     */
    public function retrieveByCredentials(array $credentials)
    {
        Verification::require_set($credentials, [ "ccid" ]);
        return $this->retrieveById($credentials['ccid']);
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
        Verification::require_set($credentials, [ "ccid", "password" ]);
        try {
            return ldap_bind($this->connection, "uid={$credentials['ccid']},ou=People,dc=ualberta,dc=ca", $credentials['password']);
        } catch (\ErrorException $exception) {
            return false;
        }

    }
}
<?php
/**
 * Created by PhpStorm.
 * User: ebon
 * Date: 7/3/14
 * Time: 5:51 AM
 */

namespace Ualbertawebservices\LDAPAuth;


use Illuminate\Auth\UserInterface;

class LDAPUser implements UserInterface {

    protected $id;
    protected $ccid;

    public function __construct(array $userData) {
        $this->id = $userData['employeeNumber'];
        $this->ccid = $userData['uid'];
    }

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->ccid;
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        // TODO: Implement getAuthPassword() method.
    }

    /**
     * Get the token value for the "remember me" session.
     *
     * @return string
     */
    public function getRememberToken()
    {
        // TODO: Implement getRememberToken() method.
    }

    /**
     * Set the token value for the "remember me" session.
     *
     * @param  string $value
     * @return void
     */
    public function setRememberToken($value)
    {
        // TODO: Implement setRememberToken() method.
    }

    /**
     * Get the column name for the "remember me" token.
     *
     * @return string
     */
    public function getRememberTokenName()
    {
        // TODO: Implement getRememberTokenName() method.
    }
}
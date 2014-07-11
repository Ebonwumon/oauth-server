<?php
/**
 * Created by PhpStorm.
 * User: ebon
 * Date: 7/11/14
 * Time: 3:57 AM
 */

namespace OAuthClients\Storage;


use League\OAuth2\Server\Storage\ScopeInterface;

class Scope implements ScopeInterface {

    /**
     * Return information about a scope
     *
     * Example SQL query:
     *
     * <code>
     * SELECT * FROM oauth_scopes WHERE scope = :scope
     * </code>
     *
     * Response:
     *
     * <code>
     * Array
     * (
     *     [id] => (int) The scope's ID
     *     [scope] => (string) The scope itself
     *     [name] => (string) The scope's name
     *     [description] => (string) The scope's description
     * )
     * </code>
     *
     * @param  string $scope The scope
     * @param  string $clientId The client ID (default = "null")
     * @param  string $grantType The grant type used in the request (default = "null")
     * @return bool|array If the scope doesn't exist return false
     */
    public function getScope($scope, $clientId = null, $grantType = null)
    {
        return \DB::table('oauth_scopes')->where('scope', '=', $scope)->select([ 'id', 'scope', 'name', 'description' ])->get();
        // Todo what are clientID and grant type for
    }
}
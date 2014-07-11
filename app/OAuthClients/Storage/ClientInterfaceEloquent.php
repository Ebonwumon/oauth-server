<?php
/**
 * Created by PhpStorm.
 * User: ebon
 * Date: 7/10/14
 * Time: 5:17 AM
 */

namespace OAuthClients\Storage;


use Illuminate\Database\Eloquent\ModelNotFoundException;
use OAuthClients\OAuthClientRepositoryInterface;

class ClientInterfaceEloquent implements \League\OAuth2\Server\Storage\ClientInterface {

    protected $repository;

    public function __construct(OAuthClientRepositoryInterface $clientRepositoryInterface) {
        $this->repository = $clientRepositoryInterface;
    }

    /**
     * Validate a client
     *
     * Example SQL query:
     *
     * <code>
     * # Client ID + redirect URI
     * SELECT oauth_clients.id, oauth_clients.secret, oauth_client_endpoints.redirect_uri, oauth_clients.name,
     * oauth_clients.auto_approve
     *  FROM oauth_clients LEFT JOIN oauth_client_endpoints ON oauth_client_endpoints.client_id = oauth_clients.id
     *  WHERE oauth_clients.id = :clientId AND oauth_client_endpoints.redirect_uri = :redirectUri
     *
     * # Client ID + client secret
     * SELECT oauth_clients.id, oauth_clients.secret, oauth_clients.name, oauth_clients.auto_approve FROM oauth_clients
     * WHERE oauth_clients.id = :clientId AND oauth_clients.secret = :clientSecret
     *
     * # Client ID + client secret + redirect URI
     * SELECT oauth_clients.id, oauth_clients.secret, oauth_client_endpoints.redirect_uri, oauth_clients.name,
     * oauth_clients.auto_approve FROM oauth_clients LEFT JOIN oauth_client_endpoints
     * ON oauth_client_endpoints.client_id = oauth_clients.id
     * WHERE oauth_clients.id = :clientId AND oauth_clients.secret = :clientSecret AND
     * oauth_client_endpoints.redirect_uri = :redirectUri
     * </code>
     *
     * Response:
     *
     * <code>
     * Array
     * (
     *     [client_id] => (string) The client ID
     *     [client secret] => (string) The client secret
     *     [redirect_uri] => (string) The redirect URI used in this request
     *     [name] => (string) The name of the client
     *     [auto_approve] => (bool) Whether the client should auto approve
     * )
     * </code>
     *
     * @param  string $clientId The client's ID
     * @param  string $clientSecret The client's secret (default = "null")
     * @param  string $redirectUri The client's redirect URI (default = "null")
     * @param  string $grantType The grant type used in the request (default = "null")
     * @return bool|array               Returns false if the validation fails, array on success
     */
    public function getClient($clientId, $clientSecret = null, $redirectUri = null, $grantType = null)
    {
        try {
            $client = $this->repository->find($clientId);
        } catch (ModelNotFoundException $ex) {
            return false;
        }

        
    }
}
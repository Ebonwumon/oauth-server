<?php

use League\OAuth2\Server\Util\Request;
use League\OAuth2\Server\Authorization;
use League\OAuth2\Server\Grant\AuthCode;
use League\OAuth2\Server\Exception\ClientException;

use Illuminate\Support\MessageBag;

class OAuthController extends \BaseController {

    /** @var \UAlberta\Authentication\UserRepository  */
    protected $userRepository;

    public function __construct(\UAlberta\Authentication\UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function login() {
        return View::make('login/login');
    }

    public function login_auth() {
        $attributes = array(
            'id' => '1346889',
            'first_name' => "Troy",
            'last_name' => "Pavlek",
            'ccid' => 'tpavlek'
        );
        $user = $this->userRepository->create($attributes);
        Auth::login($user);
        $params = Session::get('authorize-params');
        unset($params['client_details']);
        return Redirect::route('oauth.authorize', $params);
    }

    public function authorize() {
        $params = Session::get('authorize-params');

        $params['user_id'] = Auth::user()->getAuthIdentifier();
        $oauth_client = new stdClass;
        $oauth_client->name = $params['client_details']['name'];
        $oauth_client->description = "A cool application";
        $oauth_client->scopes = $params['scopes'];

        return View::make('login/authorization')->with('oauth_client', $oauth_client);
    }

    public function finalize_auth() {
        $params = Session::get('authorize-params');

        $params['user_id'] = Auth::user()->getAuthIdentifier();

        if (Input::get('approve') !== null) {
            $auth_code = AuthorizationServer::newAuthorizeRequest('user', $params['user_id'], $params);
            Session::forget('authorize-params');

            return Redirect::to(AuthorizationServer::makeRedirectWithCode($auth_code, $params));
        }

        if (Input::get('deny') !== null) {
            Session::forget('authorize-params');

            return Redirect::to(AuthorizationServer::makeRedirectWithError($params));

        }

        // TODO full return path
    }

    public function access_token() {
        return AuthorizationServer::performAccessTokenFlow();
    }


}

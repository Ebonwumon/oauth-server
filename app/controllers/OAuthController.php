<?php

use Depotwarehouse\Toolbox\Verification;
use Depotwarehouse\Toolbox\Exceptions\ParameterRequiredException;
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
        $credentials = Input::only("ccid", "password");

        $params = Session::get('authorize-params');

        // Since we're passing data in the URL, we don't want client details cluttering our bar
        unset($params['client_details']);

        try {
            Verification::require_set($credentials, [ "ccid", "password" ]);
        } catch (ParameterRequiredException $exception) {
            return Redirect::route('oauth.login_form', $params)->withErrors(
                new MessageBag([ 'errors' => $exception->getMessage() ])
            );
        }

        if (!Auth::attempt($credentials)) {
            return Redirect::route('oauth.login_form', $params)->withErrors(
                new MessageBag([ 'errors' => "CCID or password is incorrect" ])
            );
        }
        return Redirect::route('oauth.authorize', $params);
    }

    public function authorize() {
        $params = Session::get('authorize-params');

        $params['user_id'] = Auth::user()->id;
        $oauth_client = new stdClass;
        $oauth_client->name = $params['client_details']['name'];
        $oauth_client->description = "A cool application";
        $oauth_client->scopes = $params['scopes'];

        // If we only request the basic scope, we don't need explicit authorization, so we bypass to finalizing auth.
        if (count($oauth_client->scopes) == 1 && $oauth_client->scopes[0]["scope"] == "basic") {
            return $this->finalize_auth(true);
        }

        return View::make('login/authorization')->with('oauth_client', $oauth_client);
    }

    public function finalize_auth($bypass = false) {
        $params = Session::get('authorize-params');

        $params['user_id'] = Auth::user()->id;

        if ($bypass || Input::get('approve') !== null) {
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

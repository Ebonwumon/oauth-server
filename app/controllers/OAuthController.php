<?php

use League\OAuth2\Server\Util\Request;
use League\OAuth2\Server\Authorization;

class OAuthController extends \BaseController {

    /** @var \League\OAuth2\Server\Util\Request  */
    protected $oauth_request;

    protected $authserver;

    public function __construct() {
        $this->oauth_request = new Request();
        $this->authserver = new Authorization();

    }

    public function access_token() {
        return AuthorizationServer::performAccessTokenFlow();
    }

    public function authorize() {
        $params = Session::get('authorize-params');

        $params['user_id'] = Auth::user()->id;

        return View::make('authorize/form', array('params' => $params));
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}

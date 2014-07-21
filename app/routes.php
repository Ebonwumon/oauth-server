<?php

Route::get('/', function() {
    return "This is the auth server";
});

Route::group(array('prefix' => 'oauth'), function() {
    Route::get('login', array(
        'uses' => 'OAuthController@login',
        'as' => 'oauth.login_form',
        'before' => 'check-authorization-params'
    ));

    Route::post('login', array(
        'uses' => 'OAuthController@login_auth',
        'as' => 'oauth.login_auth',
    ));

    Route::get('authorize', array(
        'uses' => 'OAuthController@authorize',
        'as' => 'oauth.authorize',
        'before' => 'check-authorization-params|auth'
    ));
    Route::post('authorize', array(
        'uses' => 'OAuthController@finalize_auth',
        'as' => 'oauth.finalize_auth',
        'before' => 'check-authorization-params|auth|csrf'
    ));

    Route::post('access_token', array('uses' => 'OAuthController@access_token'));
});




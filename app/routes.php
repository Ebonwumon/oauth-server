<?php

Route::get('authorize', array('before' => 'check-authorization-params|auth', 'uses' => 'OAuthController@authorize'));

Route::post('access_token', array('uses' => 'OAuthController@access_token'));

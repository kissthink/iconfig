<?php

return array(

	/*
	|--------------------------------------------------------------------------
	| Default Session Driver
	|--------------------------------------------------------------------------
	|
	*/

	'driver' => 'native',

	/*
	|--------------------------------------------------------------------------
	| Session Lifetime
	|--------------------------------------------------------------------------
	|
	*/

	'lifetime' => 120,

	/*
	|--------------------------------------------------------------------------
	| Session File Location
	|--------------------------------------------------------------------------
	|
	*/

	'files' => '/sessions',

	/*
	|--------------------------------------------------------------------------
	| Session Database Connection
	|--------------------------------------------------------------------------
	|
	*/

	'connection' => null,

	/*
	|--------------------------------------------------------------------------
	| Session Database Table
	|--------------------------------------------------------------------------
	|
	*/

	'table' => 'sessions',

	/*
	|--------------------------------------------------------------------------
	| Session Sweeping Lottery
	|--------------------------------------------------------------------------
	|
	*/

	'lottery' => array(2, 100),

	/*
	|--------------------------------------------------------------------------
	| Session Cookie Name
	|--------------------------------------------------------------------------
	|
	*/

	'cookie' => 'laravel_session',

	/*
	|--------------------------------------------------------------------------
	| Session Cookie Path
	|--------------------------------------------------------------------------
	|
	*/

	'path' => '/',

	/*
	|--------------------------------------------------------------------------
	| Session Cookie Domain
	|--------------------------------------------------------------------------
	|
	*/

	'domain' => null,

	/*
	|--------------------------------------------------------------------------
	| Session Payload Cookie Name
	|--------------------------------------------------------------------------
	|
	*/

	'payload' => 'laravel_payload',

);

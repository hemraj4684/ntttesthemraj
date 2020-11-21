<?php

$router->get('/', [ 'uses' => 'RouterController@index' ]);
$router->post('/store', [ 'uses' => 'RouterController@store' ]);
$router->post('/edit', [ 'uses' => 'RouterController@edit' ]);
$router->get('/delete/{id:[0-9]+}', [ 'uses' => 'RouterController@delete' ]);
$router->get('/get/{id:[0-9]+}', [ 'uses' => 'RouterController@get' ]);

/** API */
$router->get('/api', [ 'middleware' => 'jwt', 'uses' => 'RestController@index' ]);
$router->get('/api/delete', [ 'middleware' => 'jwt', 'uses' => 'RestController@delete' ]);
$router->post('/api/store', [ 'middleware' => 'jwt', 'uses' => 'RestController@store' ]);
$router->get('/api/get', [ 'middleware' => 'jwt', 'uses' => 'RestController@get' ]);
$router->post('/api/edit', [ 'middleware' => 'jwt', 'uses' => 'RestController@edit' ]);

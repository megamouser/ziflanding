<?php
$router->get('', 'PagesController@home');
$router->get('test', 'PagesController@test');
$router->post('email', 'PagesController@email');


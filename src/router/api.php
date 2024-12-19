<?php
return [
    'user/create' => ['controller' => 'UserController', 'method' => 'createUser'],
    'user/list' => ['controller' => 'UserController', 'method' => 'listUsers'],
    'auth/login' => ['controller' => 'AuthController', 'method' => 'login'],
    'auth/register' => ['controller' => 'AuthController', 'method' => 'register'],
];

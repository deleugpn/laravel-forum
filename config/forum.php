<?php

return [

    'prefix'        => 'forum',

    'namespace'     => '\Bitporch\Forum\Controllers',

    'user'          => App\User::class,

    'middlewares'   => [
        'web' => [
            Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ],
];

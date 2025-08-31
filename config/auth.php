<?php

return [

    'defaults' => [
        'guard' => 'web',
        'passwords' => 'users',
    ],

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],

        'etudiant' => [
            'driver' => 'session',
            'provider' => 'etudiants',
        ],

        'formateur' => [
            'driver' => 'session',
            'provider' => 'formateurs',
        ],

        'api_etudiant' => [
            'driver' => 'token',
            'provider' => 'etudiants',
            'hash' => false,
        ],

        'api_formateur' => [
            'driver' => 'token',
            'provider' => 'formateurs',
            'hash' => false,
        ],
    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],

        'etudiants' => [
            'driver' => 'eloquent',
            'model' => App\Models\Etudiant::class,
        ],

        'formateurs' => [
            'driver' => 'eloquent',
            'model' => App\Models\Formateur::class,
        ],

    ],

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],

        'etudiants' => [
            'provider' => 'etudiants',
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
         ],

        'formateurs' => [
            'provider' => 'formateurs',
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => 10800,

];

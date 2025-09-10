<?php

return [

  'defaults' => [
    'guard' => env('AUTH_GUARD', 'web'),  // يمكنك تغييرها إلى 'admin' أو 'support' إذا كنت تستخدم حارس معين بشكل افتراضي
    'passwords' => env('AUTH_PASSWORD_BROKER', 'users'),
],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    */
    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],
        'admin' => [
            'driver' => 'session',
            'provider' => 'admins',
        ],
        'support' => [
            'driver' => 'session',
            'provider' => 'a_supports',
        ],
        'student' => [
            'driver' => 'session',
            'provider' => 'students',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    */
    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],
        'admins' => [
            'driver' => 'eloquent',
            'model' => App\Models\Admin::class,
        ],
        'a_supports' => [
            'driver' => 'eloquent',
            'model' => App\Models\ASupports::class,
        ],
        'students' => [
            'driver' => 'eloquent',
            'model' => App\Models\Student::class,
        ],
    ],

    
];

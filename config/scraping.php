<?php

return [
    'clients' => [
        'http' => [
            'options' => [
                'verify' => env('APP_ENV', 'local') !== "local",
                'connect_timeout' => 10
            ]
        ]
    ]
];
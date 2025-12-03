<?php

return [

    'accounts' => [

        'default' => [
            'host'          => env('IMAP_HOST', '127.0.0.1'),
            'port'          => env('IMAP_PORT', 993),
            'encryption'    => env('IMAP_ENCRYPTION', 'ssl'),
            'validate_cert' => env('IMAP_VALIDATE_CERT', false),
            'username'      => env('IMAP_USERNAME'),
            'password'      => env('IMAP_PASSWORD'),
            'protocol'      => 'imap',
        ],
    ],

];

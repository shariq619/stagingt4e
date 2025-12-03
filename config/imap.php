<?php

return [

    'default' => 'support',

    'accounts' => [
        'support' => [
            'host'          => env('IMAP_SUPPORT_HOST', 'mail.training4employment.co.uk'),
            'port'          => env('IMAP_SUPPORT_PORT', 993),
            'encryption'    => env('IMAP_SUPPORT_ENCRYPTION', 'ssl'),
            'validate_cert' => env('IMAP_SUPPORT_VALIDATE_CERT', false),
            'username'      => env('IMAP_SUPPORT_USERNAME', 'support@training4employment.co.uk'),
            'password'      => env('IMAP_SUPPORT_PASSWORD'),
            'protocol'      => 'imap',
        ],

        'sales' => [
            'host'          => env('IMAP_SALES_HOST', 'mail.training4employment.co.uk'),
            'port'          => env('IMAP_SALES_PORT', 993),
            'encryption'    => env('IMAP_SALES_ENCRYPTION', 'ssl'),
            'validate_cert' => env('IMAP_SALES_VALIDATE_CERT', false),
            'username'      => env('IMAP_SALES_USERNAME', 'sales@training4employment.co.uk'),
            'password'      => env('IMAP_SALES_PASSWORD'),
            'protocol'      => 'imap',
        ],
    ],

    'options' => [
        'delimiter'         => '/',
        'fetch'             => \Webklex\PHPIMAP\IMAP::FT_PEEK,
        'fetch_order'       => 'desc',
        'open'              => [
            'DISABLE_AUTHENTICATOR' => 'GSSAPI'
        ],
    ],
];

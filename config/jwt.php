<?php


return [
    'secret'      => env('JWT_SECRET', 'd58a1c8a7a6a7a5637d0e2147fc71705'),
    //Asymmetric key
    'public_key'  => env('JWT_PUBLIC_KEY'),
    'private_key' => env('JWT_PRIVATE_KEY'),
    'password'    => env('JWT_PASSWORD'),
    //JWT time to live
    'ttl'         => env('JWT_TTL', 1200),
    //Refresh time to live
    'refresh_ttl' => env('JWT_REFRESH_TTL', 20160),
    //JWT hashing algorithm
    'algo'        => env('JWT_ALGO', 'HS256'),
    //token获取方式，数组靠前值优先
    'token_mode'    => ['header', 'param'],
    //黑名单后有效期
    'blacklist_grace_period' => env('BLACKLIST_GRACE_PERIOD', 10),
    'blacklist_storage' => thans\jwt\provider\storage\Tp6::class,
];

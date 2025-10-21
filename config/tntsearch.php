<?php

return [
  'driver' => env('tntsearch.driver', 'mysql'),
  'host' => env('tntsearch.host', '127.0.0.1'),
  'database' => env('tntsearch.database', 'your_database_name'),
  'username' => env('tntsearch.username', 'your_database_username'),
  'password' => env('tntsearch.password', 'your_database_password'),
  'storage' => '../runtime/',
  'stemmer'  => \TeamTNT\TNTSearch\Stemmer\PorterStemmer::class,
];

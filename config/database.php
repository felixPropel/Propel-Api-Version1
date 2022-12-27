<?php  return array (
  'default' => 'mysql',
  'connections' =>
  array(
    'sqlite' =>
    array(
      'driver' => 'sqlite',
      'url' => NULL,
      'database' => 'propel_new',
      'prefix' => '',
      'foreign_key_constraints' => true,
    ),
    'mysql' =>
    array(
      'driver' => 'mysql',
      'url' => env('DATABASE_URL'),
      'host' => '127.0.0.1',
      'port' => '3306',
      'database' => env('DB_DATABASE', 'forge'),
      'username' => env('DB_USERNAME', 'forge'),
      'password' => '',
      'unix_socket' => '',
      'charset' => 'utf8mb4',
      'collation' => 'utf8mb4_unicode_ci',
      'prefix' => '',
      'prefix_indexes' => true,
      'strict' => true,
      'engine' => 'InnoDB',
    ),
    'mysql_external' =>
    array(
      'driver' => 'mysql',
      'url' => NULL,
      'host' => '127.0.0.1',
      'port' => '3306',
      'database' =>'',
      'username' =>  "root",
      'password' =>"",
      'unix_socket' => '',
      'charset' => 'utf8mb4',
      'collation' => 'utf8mb4_unicode_ci',
      'prefix' => '',
      'strict' => true,
      'engine' => 'InnoDB',
    ),
    'pgsql' =>
    array(
      'driver' => 'pgsql',
      'url' => NULL,
      'host' => '127.0.0.1',
      'port' => '3306',
      'database' => 'propel_new',
      'username' => 'root',
      'password' => '',
      'charset' => 'utf8',
      'prefix' => '',
      'prefix_indexes' => true,
      'schema' => 'public',
      'sslmode' => 'prefer',
    ),
    'sqlsrv' =>
    array(
      'driver' => 'sqlsrv',
      'url' => NULL,
      'host' => '127.0.0.1',
      'port' => '3306',
      'database' => 'propel_new',
      'username' => 'root',
      'password' => '',
      'charset' => 'utf8',
      'prefix' => '',
      'prefix_indexes' => true,
    ),
    'divamoto' =>
    array(
      'driver' => 'mysql',
      'host' => '127.0.0.1',
      'database' => 'divamoto',
      'username' => 'root',
      'password' => '',
      'charset' => 'utf8',
      'collation' => 'utf8_unicode_ci',
      'prefix' => '',
      'strict' => false,
    ),
    'gsfgfdhb' =>
    array(
      'driver' => 'mysql',
      'host' => '127.0.0.1',
      'database' => 'gsfgfdhb',
      'username' => 'root',
      'password' => '',
      'charset' => 'utf8',
      'collation' => 'utf8_unicode_ci',
      'prefix' => '',
      'strict' => false,
    ),
    'DivaMoto' =>
    array(
      'driver' => 'mysql',
      'host' => '127.0.0.1',
      'database' => 'DivaMoto',
      'username' => 'root',
      'password' => '',
      'charset' => 'utf8',
      'collation' => 'utf8_unicode_ci',
      'prefix' => '',
      'strict' => false,
    ),
    'ss motors' =>
    array(
      'driver' => 'mysql',
      'host' => NULL,
      'database' => 'ss motors',
      'username' => NULL,
      'password' => NULL,
      'charset' => 'utf8',
      'collation' => 'utf8_unicode_ci',
      'prefix' => '',
      'strict' => false,
    ),
    'genomics' =>
    array(
      'driver' => 'mysql',
      'host' => NULL,
      'database' => 'genomics',
      'username' => NULL,
      'password' => NULL,
      'charset' => 'utf8',
      'collation' => 'utf8_unicode_ci',
      'prefix' => '',
      'strict' => false,
    ),
  ),
  'migrations' => 'migrations',
  'redis' =>
  array(
    'client' => 'phpredis',
    'options' =>
    array(
      'cluster' => 'redis',
      'prefix' => 'laravel_database_',
    ),
    'default' =>
    array(
      'url' => NULL,
      'host' => '127.0.0.1',
      'password' => NULL,
      'port' => '6379',
      'database' => '0',
    ),
    'cache' =>
    array(
      'url' => NULL,
      'host' => '127.0.0.1',
      'password' => NULL,
      'port' => '6379',
      'database' => '1',
    ),
  ),
);

<?php
if (getenv('DATABASE_URL')) {
    $connection = 'pgsql';
} else {
    $connection = 'sqlite';
}
return [
    /*
    |--------------------------------------------------------------------------
    | Default Database Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the database connections below you wish
    | to use as your default connection for all database work. Of course
    | you may use many connections at once using the Database library.
    |
    */
    'default'     => $connection,
    /*
    |--------------------------------------------------------------------------
    | Database Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the database connections setup for your application.
    | Of course, examples of configuring each database platform that is
    | supported by Laravel is shown below to make development simple.
    |
    |
    | All database work in Laravel is done through the PHP PDO facilities
    | so make sure you have the driver for your particular database of
    | choice installed on your machine before you begin development.
    |
    */
    'connections' => [
        'sqlite' => [
            'driver'   => 'sqlite',
            'database' => env('DB_DATABASE', database_path('database.sqlite')),
            'prefix'   => '',
        ],
        'pgsql'  => [
            'driver'   => 'pgsql',
            'host'     => 'ec2-50-17-193-83.compute-1.amazonaws.com',
            'port'     => '5432',
            'database' => 'd503r63sho69ej',
            'username' => 'nrjvprhfkpfeqj',
            'password' => 'e61444a877446a9a875216c477b7b4e70b33c83f4cc84a9faaf153f78fb07949',
            'charset'  => 'utf8',
            'prefix'   => '',
            'schema'   => 'public',
            'sslmode'  => 'prefer',
        ],
    ],
];
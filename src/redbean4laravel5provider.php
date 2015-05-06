<?php namespace Mamift\Redbean4Laravel5;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Config;

class Redbean4Laravel5Provider extends ServiceProvider {

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // get DB configs from app/config/database.php
        // $default = Config::get('app_env');
        $default = env('DB_CONNECTION');
        // $connections = Config::get('database.connections');
        // $connections = env()

        // var_dump($default);
        // var_dump($connections);

        // $db_host = $connections[$default]['host'];
        $db_host = env('DB_HOST');
        // $db_user = $connections[$default]['username']; 
        $db_user = env('DB_USERNAME');
        // $db_pass = $connections[$default]['password'];
        $db_pass = env('DB_PASSWORD');
        // $db_name = $connections[$default]['database'];
        $db_name = env('DB_DATABASE');
        // $db_driver = $connections[$default]['driver'];
        // $db_driver = $connections[$default]['driver'];
        
        // run the R::setup command based on db_type
        if ($default != 'sqlite') {
            $conn_string = $default.':host='.$db_host.';dbname='.$db_name;
        } else {
            $conn_string = $default.':'.$db_name;
        }

        \R::setup($conn_string, $db_user, $db_pass);
    }

}

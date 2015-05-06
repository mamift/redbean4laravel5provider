<?php namespace Mamift\Redbean4Laravel5;

use Illuminate\Support\ServiceProvider;

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
        $default = \Laravel\Config::get('database.default');
        $connections = \Laravel\Config::get('database.connections');
        
        $db_host = $connections[$default]['host'];
        $db_user = $connections[$default]['username']; 
        $db_pass = $connections[$default]['password'];
        $db_name = $connections[$default]['database'];
        $db_driver = $connections[$default]['driver'];
        
        // run the R::setup command based on db_type
        if ($default != 'sqlite') {
            $conn_string = $db_driver.':host='.$db_host.';dbname='.$db_name;
        } else {
            $conn_string = $db_driver.':'.$db_name;
        }

        \R::setup($conn_string, $db_user, $db_pass);
    }

}

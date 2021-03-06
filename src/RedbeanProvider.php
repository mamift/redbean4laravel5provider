<?php namespace Mamift\Redbean4Laravel5;

use Illuminate\Support\ServiceProvider;

class RedbeanProvider extends ServiceProvider {

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
        $rb_m_p = env('REDBEAN_MODEL_PREFIX');

        if (!empty($rb_m_p)) {
            define('REDBEAN_MODEL_PREFIX', $rb_m_p);
        }

        // get DB configs from root .env file
        $default = env('DB_CONNECTION');
        $db_name = env('DB_DATABASE');
        
        // run the R::setup command based on default database type
        if ($default != 'sqlite') {
            $db_host = env('DB_HOST');
            $db_port = env('DB_PORT');
            $db_user = env('DB_USERNAME');
            $db_pass = env('DB_PASSWORD');
            $conn_string = $default . ':host=' . $db_host . ';port=' . $db_port . ';dbname=' . $db_name;
            if (\R::testConnection()) return;
            \R::setup($conn_string, $db_user, $db_pass);
        } else {
            $conn_string = $default . ':' . database_path() . DIRECTORY_SEPARATOR . 'database.sqlite';
            if (\R::testConnection()) return;
            \R::setup($conn_string);
        }

    }

}

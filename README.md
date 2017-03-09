# redbean4-laravel5
### A Laravel 5 and Lumen-compatible service provider package for RedBeanPHP ORM 4.3.

NOTE: This is not Laravel 4 compatible.

This is a Laravel 5 and Lumen-compatible package to allow the use of [Redbean PHP ORM](http://redbeanphp.com), version 4.3.

### License - GPL2

As redbeanPHP is itself licensed under GPL2, so is this package.

Please refer to the [GPL 2 license here](https://www.gnu.org/licenses/gpl-2.0.html).

### Pre-requisites for Lumen

In Lumen, you must enable [dotenv](http://lumen.laravel.com/docs/database#configuration) as it is disabled by default in new Lumen installations (uncomment this line inside app.php):
	
	Dotenv::load(__DIR__.'/../');
	
Also you must configure a default .env file in both Laravel and Lumen with database connection settings. As a minimum you must have the following settings configured:
	
	DB_CONNECTION=
	DB_HOST=
	DB_DATABASE=
	DB_USERNAME=
	DB_PASSWORD=

	DB_CONNECTION determines what type of database you're using (mysql or postresql or whatever)
	DB_HOST is the name or IP of the database server
	DB_DATABASE is the name of the database
	DB_USERNAME is the username used to the connect to the database
	DB_PASSWORD is the password for the DB_USERNAME

### How to install

Add this line
	
	"mamift/redbean4-laravel5":"dev-master" 
	
to your composer.json file. Then run composer update in your Lumen or Laravel app directory. 

#### For Lumen 

Add this line:

	$app->register('Mamift\Redbean4Laravel5\RedbeanProvider');

to app.php inside the bootstrap/ folder, so RedBeanPHP is setup using Lumen's database settings. 

#### For Laravel 5

Add this line

	\Mamift\Redbean4Laravel5\RedbeanProvider::class,

to the providers array inside config/app.php.

For both Lumen and Laravel, RedBeanPHP will register it's own facade class ("R"), and you can begin using Redbean using the 'R::' prefix.

### Usage

Read [RedBeanPHP's documentation](http://redbeanphp.com/crud) for a complete overview of what you can do with RedBean. Because this package includes the full rb.php file unmodified, every programmable interface listed on RedBean's API documentation pages should be usable.

An example:

	$user = R::dispense('user');
	$user['description'] = "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis";
	$user->username = "mamift";
	$user->gender = R::enum('gender:male');
	R::store($user);

### A note on how this package exposes RedBean in Laravel

What this package does is load rb.php for each request. Under the "autoload" JSON object inside composer.json, rb.php is specified as part of the "files" array:

	{
	    "autoload": {
    	    "files": [
    	        "src/rb.php"
    	    ]
    	}
	}
	
A quote from the [Composer documentation](https://getcomposer.org/doc/04-schema.md#files) says:
>If you want to require certain files explicitly on every request then you can use the 'files' autoloading mechanism. This is useful if your package includes PHP functions that cannot be autoloaded by PHP.

Due to rb.php being loaded on each request, there may be a slight performance penalty incurred.
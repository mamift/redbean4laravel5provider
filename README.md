# redbean4-laravel5
### A Laravel 5 and Lumen-compatible service provider package for RedBeanPHP ORM 4.2.

This is a Laravel 5 and Lumen-compatible package to allow the use of [Redbean PHP ORM](http://redbeanphp.com), version 4.2.

### License - GPL2

As redbeanPHP is itself licensed under GPL2, so is this package.

Please refer to the [GPL 2 license here](https://www.gnu.org/licenses/gpl-2.0.html).

### Pre-requisites for Lumen

In Lumen, you must enable [dotenv](http://lumen.laravel.com/docs/database#configuration) as it is disabled by default in new Lumen installations (uncomment this line inside app.php):
	
	Dotenv::load(__DIR__.'/../');
	
Also you must configure a default .env file in both Laravel and Lumen with database connection settings. As a minimum you must have:
	
	DB_CONNECTION=mysql
	DB_HOST=localhost
	DB_DATABASE=lumen
	DB_USERNAME=lumen
	DB_PASSWORD=lumen1

### How to install

Add 
	
	"mamift/redbean4-laravel5":"dev-master" 
	
to your composer.json file. Then add this line:

	$app->register('Mamift\Redbean4Laravel5\Redbean4Laravel5Provider');

to app.php inside the bootstrap/ folder, so RedBeanPHP is setup using Laravel's database settings.

RedBeanPHP will automatically register it's own facade class ("R").

### Usage

Read [RedBeanPHP's documentation](http://redbeanphp.com/crud) for a complete overview of what you can do with RedBean. Because this package includes the full rb.php file unmodified, every programmable interface listed on RedBean's API documentation pages should be usable.

An example:

	$user = R::dispense('user');
	$user['description'] = "Lorem ipsum dolor sit amet, consectetur" + adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.";
	$user->username = "mamift";
	$user->gender = R::enum('gender:male');
	R::store($user);

### A note on how this package exposes RedBean in Laravel

Due to the way the author of RedBean uses PHP namespaces (it doesn't appear to be PSR-4 compliant), he does not provide his own composer.json and as such, the rb.php file (the file that RedBeanPHP is commonly distributed in) does not appear to be autoloadable by composer.

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
# Iconfig [![Build Status](https://travis-ci.org/heera/iconfig.png?branch=master)](https://travis-ci.org/heera/iconfig)

A very simple, light-weight and smart configuration manager for PHP applications.

Iconfig (Instant Config) could be used as a stand alone component to manage the configuration of any php application. It can load
settings saved in a php file and build an array which would be available at run time. It provides useful methods to set or retrieve any configuration at the run time of an application.

## Installation

Iconfig uses [Composer](http://getcomposer.org/) to make things easy.

Learn to use composer and add this to require (in your composer.json):

    "sheikhheera/iconfig": "dev-master"
    
And run:

	composer update

Library on [Packagist](https://packagist.org/packages/sheikhheera/iconfig).

## An Example
Basically a php applications or `mvc` framework use array for configurations, for example, this is a sample of database configuration
```PHP
return array(
 	'default' => 'mysql',
	'connections' => array(
		'sqlite' => array(
			'driver'   => 'sqlite',
			'database' => 'public/caliber.sqlite',
			'prefix'   => 'cb_',
		),
		'mysql' => array(
			'driver'    => 'mysql',
			'host'      => 'localhost',
			'database'  => 'caliber',
			'username'  => 'root',
			'password'  => 'bossboss',
			'charset'   => 'utf8',
			'collation' => 'utf8_unicode_ci',
			'prefix'    => 'cb_',
		)
   ),
);
```
An `mvc` framework or an applicarion without any framework must have some common settings and user can configure those according to his/her need and
most often all configuration files reside in a single folder, commonly, the `config` name is used. So, keeping that on mind, this dynamic configuration
manager (or whatever you say) has been built, which loads all files from a given path. For example :
```PHP
$config = new Iconfig\Config('config');
```
Above code will load all files from the `config` folder (it expects arrays inside files) and will put everything in an array (groups using file name). Now, you can set/get any
item from the array. For example, if you want to get the `default` item from the array, then you cn use
```PHP
$default = $config->getDatabase('default'); // mysql
```
Now, what is `getDatabase` ? Actually, in this example, I've used the file name `database.php` for this array so I can use `getDatabase()` and `setDatabase()` to get or set an item.
If I have a file named with `session.php` then I can use `getSession()` and `setSession()` to get or set any settings for session management. Which means, when you will pass the path
(where you all configuration files are saved) to the constructor it'l load all 'php' files from that path/folder. So If, for example, in a folder named `settings` you have three files
inside that folder as `database.php`, `session.php` and for example `chache.php` and if you initialize it using
```PHP
$settings = new Iconfig\Config('settings');
```
Then, it'll load all three `php` files from the folder and it'll create one associative array using three groups like
```PHP
Array(
  'database' => array(
    'default' => 'mysql',
    'connections' => array(
		    'sqlite' => array(
			  'driver'   => 'sqlite',
			  'database' => 'public/caliber.sqlite',
			  'prefix'   => 'cb_',
		  )
  ),
  'session' => array(
    'driver' => 'native',
    'lifetime' 120,
    'files' => '/sessions'
  ),
  'chache' =>array(
    'path' => 'c:/web/app/storage'
  )
);
```
Now, you can use,
```PHP
$settings->setDatabase('default', 'sqlite');
$settings->getDatabase('default'); // sqlite

$settings->setSession('lifetime', 240);
$settings->getSession('lifetime'); // 240
```

If you want you can set an `Alias` and can use methods `statically` like
```PHP
new Iconfig\Config('../myApp/config', 'Config'); // Config as Alias, you can use any name
if(Config::isExist('session')) {
    Config::setSession('driver', 'database');
    $sessionArray = Config::getSession(); // full array will be returned when called without argument
}
```
Some more examples (use a callback function with `getMethod($key, $callback)`)
```PHP
$connections = Config::getDatabase('connections', function($data){
  if(is_array($data) && array_key_exists('sqlite', $data)) {
		Config::setDatabase('connections.sqlite.driver', 'myNewSqliteDriver');
		return Config::getDatabase('connections'); // this will return connections array with new value
	}
});
```
Also you can use a defult value like
```PHP
$chache = getChache('path', '/web') // if path doesn't exist then "/web" will be returned
```
If you have three database connections and all have a driver `key` then you can specify which `driver` key you want like
```PHP
Config::getDatabase('connections.sqlite.driver'); // get the driver from sqlite
Config::getDatabase('connections.pgsql.driver'); // get the driver from pgsql
```
Same could be used when setting a value like `setDatabase('connections.pgsql.driver', 'pgsql')`. 

You can also use `::find()` to search for an item as
```PHP
Config::find('sqlite'); // if it exists, you'll get the value
Config::find('connections.sqlite'); // it'll look sqlite in to the connections
Config::find('connections.sqlite.driver'); it'll look driver in to the connections.sqlite array
```
Also you can use
```PHP
$all = Config::getAll();
var_dump($all); // full configuration array will be returned
```

You can also use
```PHP
Config::load('filePath'); // new items will be added.
```
That's all for now. Hope, I'll be able to add more features in future, In Sha Allah! (on God's will).

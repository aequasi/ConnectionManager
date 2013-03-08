Connection Manager
=========================

Install:
--------

To Install this, just run the shell code below. 

```sh
git clone git@github.com:aequasi/ConnectionManager.git
cd ConnectionManager
composer install
```

OR, if you are using composer
```sh
composer require aequasi/connection-manager dev-master
```

In your php file, add this at the top, changing the path to wherever it belongs
```php
// If you arent using composer in your global project, make sure you use the autoloader
require_once( __DIR__ . '/ConnectionManager/vendor/autoload.php" );
use Aequasi\ConnectionManager;

```

Then, make a yml config file (placing it wherever you need) that looks like `ConnectionManager/src/Aequasi/ConnectionManager/Resources/config/connection.yml`

Use:
----

In your code, that has the required above, follow this example:

```php
ConnectionManager::$config = $customConfigFilename;
$classDb = ConnectionManager::getConnection( 'classdb', 'someuser', 'somepassword' );

$result = $classDb->executeQuery( $query )->fetchAll();
```

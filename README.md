
## Installation

Run

```sh
git clone https://github.com/phpdevsolutions/admin.git
```

Install dependencies

```sh
composer install
```

If there are errors update

```sh
composer update
```

Create a database with file admin.sql. By default, a user will be created with the credentials: admin@mail.mx and password 12345678.

You can directly modify the password in the database in the configurations table

Generate an encrypted password using the following code

```php
<?php
use App\Functions;
echo Functions::generatePassword('your_password');

```

Configure your connection keys in file config.php (the variable global FOLDER_ADMIN references to url folder admin or whatever name you choose for your managed folder)

This admin was designed following the MVC control structure

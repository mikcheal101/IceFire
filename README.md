# IceFire

## SERVER REQUIREMENTS

##### composer

##### PHP >= 7.2.5

##### BCMath PHP Extension

##### Ctype PHP Extension

##### Fileinfo PHP extension

##### JSON PHP Extension

##### Mbstring PHP Extension

##### OpenSSL PHP Extension

##### PDO PHP Extension

##### Tokenizer PHP Extension

##### XML PHP Extension

## INSTALLATION INSTRUCTIONS

### Clone Project

```bash
git clone https://github.com/mikcheal101/IceFire.git
```

### Navigate into project folder

```bash
cd IceFire
```

### Copy the env sample to create enviroment files for development and testing

```bash
cp .env.example .env
cp .env.example .env.testing
```

### Install project deppendencies

```bash
composer install
```

### Generate the application key for both the dev and testing environments

```bash
php artisan key:generate
php artisan key:generate —env=testing
```

### Set up database variables in env file

use laravel's [documentation](https://laravel.com/docs/7.x/database).

### Edit both .env and .env.testing and add the line

```bash
ICE_FIRE_API=“https://www.anapioficeandfire.com/api/books”
```

### Migrate database

```bash
php artisan migrate
php artisan migrate —env=testing
```

### Run test

```bash
php artisan test --env=testing
```

### Run application

```bash
php artisan serve
```

## License

[MIT](https://choosealicense.com/licenses/mit/)

# IceFire

[-] Clone Project
git clone https://github.com/mikcheal101/IceFire.git

[-] Navigate into project folder
cd IceFire

[-] Copy the env sample to create enviroment files for development and testing
cp .env.example .env
cp .env.example .env.testing

[-] Install project deppendencies
composer install

[-] Generate an app key for dev and testing environments
php artisan key:generate
php artisan key:generate —env=testing

[-] Set up database variables in env file using the laravel documentation url below
https://laravel.com/docs/7.x/database

[-] Edit .env and Add
ICE_FIRE_API=“https://www.anapioficeandfire.com/api/books”

[-] Edit .env.testing and Add
ICE_FIRE_API=“https://www.anapioficeandfire.com/api/books”

[-] Migrate database
php artisan migrate
php artisan migrate —env=testing

[-] Run test
php artisan test --env=testing

[-] Run application
php artisan serve

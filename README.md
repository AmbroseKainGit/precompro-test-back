## Install-steps
1. Clone this repository
2. `composer install`
3. `cp .env.example .env`
4. `php artisan migrate`
5. `php artisan key:generate`
6. `php artisan serve`
7. `php artisan websockets:serve`
8. Consume the apis with the console open on the default laravel port

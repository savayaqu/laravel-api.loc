
## From rep
1. Clone rep to domains
```sh
git clone https://github.com/savayaqu/laravel-api.loc
```
2. i composer to project
```sh
composer i
```
3. copy .env.example to .env
```sh
cp .env.exaple .env
```
4. Generate app-key 
```sh
php artisan key:generate
```
5. Settings .env
```shell
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=name_db
DB_USERNAME=log_db
DB_PASSWORD=password_db

SESSION_DRIVER=file
```
## Empty project created
```sh
cd domain
mkdir laravel-api.loc
cd laravel-api.loc
composer self-update
composer create-project laravel/laravel .
php artisan i:api
php artisan config:publish cors
php artisan storage:link
```
.htaccess
```php
RewriteEngine on
RewriteRule &(.*)$ public/$1 [L]
```

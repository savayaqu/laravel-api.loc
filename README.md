
## Установка проекта из репозитория
1. Склонируйте репозиторий
```shell
git clone https://github.com/kopchan/laravel-api.loc.git 
```
2. Перейдите в папку с проектом и скачайте зависимости
```shell
cd laravel-api.loc
composer i
```
3. Скопируйте файл конфигурации .env.example в .env
```shell
cp .env.example .env
```
4. Сгенерируйте ключ шифрования
```shell
php artisan key:generate
```
5. Изменить файл конфигурации .env (пример для БД MySQL)
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1   # Домен/IP_СУБД
DB_PORT=3306        # Порт_СУБД
DB_DATABASE=laravel # Имя_БД
DB_USERNAME=root    # Логин_пользователя
DB_PASSWORD=        # Пароль_пользователя

SESSION_DRIVER=file # Использовать файловый драйвер сессий
```
6. Выполнить миграции для создания таблиц
```shell
php artisan migrate
```

## Пустой проект 
Создан в OSPanel следующими командами:
```shell
cd domains
composer self-update
composer create laravel/laravel laravel-api.loc
cd laravel-api.loc
php artisan install:api
php artisan config:publish cors
php artisan storage:link
```
В корне проекта создан файл .htaccess
```apacheconf
RewriteEngine on
RewriteRule ^(.*)$ public/$1 [L]
```

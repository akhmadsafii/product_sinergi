# Installation

1) Create database `db_test`. 
3) Copy `.env.example` to `.env`
4) Set valid database credentials of env variables `DB_USERNAME`, and `DB_PASSWORD`
5) Run `composer install`
6) Create symbolic link for AdminLTE (Run the commands as an administrator)

- Windows example:
  
 ```php
 mklink /d "C:\xampp\htdocs\laravel-adminlte\public\assets\adminlte" "C:\xampp\htdocs\laravel-adminlte\vendor\almasaeed2010\adminlte"
 ```
 
 - Linux example:    
    
```php
ln -s public_html/laravel-adminlte/vendor/almasaeed2010/adminlte public_html/laravel-adminlte/public/assets/adminlte
``` 
 
 - Macbook example:    
    
```php
ln -s ~/public_html/laravel-adminlte/vendor/almasaeed2010/adminlte ~/public_html/laravel-adminlte/public/assets/adminlte
```

public_html/laravel-adminlte  ubah ke directory project anda

7) Run
```php
php artisan migrate
```
```php
php artisan db:seed
```
```php
php artisan storage:link
```
```php
php artisan key:generate
```
```php
php artisan serve
```
8) Access the application. Example: `http://127.0.0.1:8000`
9) Login: `dev@dev.com` Password: `root`

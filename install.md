#DEPLOY

### you will need to make sure your server meets the following requirements:

- PHP >= 7.1.3
- BCMath PHP Extension
- Ctype PHP Extension
- JSON PHP Extension
- Mbstring PHP Extension
- OpenSSL PHP Extension
- PDO PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension

Clone source code 

```
git clone repo-url medays
cd medays
```

## Install Laravel dependencies : 

```
composer install
```

## migrate database :

```
php artisan migarte
```

## Seed database default data:

```
php artisan db:seed
```

Nginx config : https://laravel.com/docs/5.8/deployment#nginx

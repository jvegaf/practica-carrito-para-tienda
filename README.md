
# Practica Carrito para Tienda

Stack:

* PHP 7.3
* PHPunit 8


## Arrancar entorno e instalar dependencias 

```
$ docker-compose up
```

```
$ docker exec -ti webserver /usr/local/bin/composer install
 
```

## Run composer

```
$ docker exec -ti webserver /usr/local/bin/composer
```

## Run tests

```
$ docker exec -ti webserver /usr/local/bin/composer test
$ docker exec -ti webserver /var/www/html/vendor/bin/phpunit --configuration /var/www/html/phpunit.xml
```

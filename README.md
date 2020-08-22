# tienda-clase
practica colaborativa de creacion de un ecommerce en php


# Stack

* PHP 7.4.9
* MySQL 8
* PhpMyAdmin
* PHPunit 8
* XDebug

# Despliegue

Tenemos dos maneras, la manera tradicional con los comandos de docker, o mediante el Makefile si estas en Linux. Los usuarios de Windows tambien tenemos un script de batch **[WIP]** que realiza las mismas funciones que el Makefile para Linux

La primera vez que despleguemos necesitamos por un lado primero levantar los contenedores con

#### Manera tradicional
```bash

    $> sudo docker-compose up -d

```
#### Con Makefile
```bash
    $> make run
```



y por otro lado necesitaremos instalar las dependencias necesarias con este comando
#### Manera tradicional

```bash
    
    $ docker exec -ti webserver /usr/local/bin/composer install
```

#### Con Makefile
```bash
    $> make prepare
```
Una vez instaladas todas las dependencias ya podriamos correr las pruebas unitarias.

## Argumentos de Make
Detener los contenedores sin destruirlos
```bash
    $> make stop
```
Detener y destruir los contenedores
```bash
    $> make clean
```
Entrar en el contenedor del webserver
```bash
    $> make ssh-be
```




# Video explicativo preparacion del entorno

Por definir

# Requisitos puestos por el profesor
Poner enlace al documento

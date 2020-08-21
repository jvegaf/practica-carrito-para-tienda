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

# requisitos puestos por el profesor

### Programar un Proceso de compra:

### Hay productos.

### Añado al carrito X unidades a X precio (que puede variar posteriormente)

### Voy a pagar.

### https://es.wikiloc.com/rutas-senderismo/cascada-de-la-chorranca-por-cerro-del-puerco-cueva-del-monje-y-vuelta-por-senda-de-la-acequia-desde-38197065

### El banco me genera un código de validación y vuelve a mi página.

### Yo compruebo contra ese banco que mi pedido está validado, por tantos euros.

### Añado una entrada a pedidos realizados y vacío el carrito

## modelo de datos (BD)

### (configuracion)

#### 

### producto

#### id

#### nombre

#### descripcion

#### precio

### 

#### lineaCarrito

##### 

###### (carrito_id)

##### cliente_id

##### producto_id

##### unidades

#### (carrito)

##### id

##### fechaInicioCarrito

##### cliente_id

### linea

#### pedido_id

#### producto_id

#### unidades

#### precioUnitario

### pedido

#### id

#### cliente_id

#### direccionEnvio

#### fechaConfirmacion

##### si es null --> es un carrito

#### ?

##### precioTotal

##### (confirmado)

### cliente

#### id

#### email

#### contrasenna

#### codigoCookie

#### nombre

##### (incluye apellidos; puede ser nombre comercial)

#### direccion

#### teléfono

#### 

##### registrado

###### =TRUE/FALSE

### FUTURIBLES

#### 

##### 

###### ¿usuario?

##### administrador

#### direccion

##### cliente_id

##### nombre

##### direccion

##### telefono

#### proveedor

#### marca

#### color

## modelo de objetos (OO)

### Cliente

#### ?

##### .obtenerCarrito()

##### .obtenerProductosEnCarrito()

### Pedido

### ? Carrito

#### ¿Subclase de Pedido?

### ? LineaPedido

### Producto

## interfaz DAO

### productoObtenerTodos()

#### 
(? criteriosOrdenacion...)

### (private) DAO::carritoCrearParaCliente(clienteId);

#### creamos un nuevo pedido-no-confirmado, con nulls y tal... Es decir, un nuevo CARRITO

### DAO::carritoObtenerParaCliente(clienteId);

#### si no existía el carrito (porque es lo primero que el usuario añade a su carrito), tenemos que crearlo

#### y devolvemos el carrito

### DAO::carritoVariarUnidadesProducto($clienteId, $productoId, $variacionUnidades)

#### obtener unidades producto

#### hace la suma

#### establecer nuevo Nº de unidades

### (private) DAO::carritoObtenerUnidadesProducto($clienteId, $productoId);

#### si este producto no está: tenemos 0 unidades

### (private) DAO::carritoEstablecerUnidadesProducto(...)

#### if (me piden >1 unidades, y está en la tabla)

##### update

#### if (me piden >1 unidades, pero no está en la tabla)

##### insert (añadimos el producto nuevo al carrito con unidades=x)

#### if (me piden 0 unidades)

##### detele: retirar el produto del carrito

### futuribles

#### ClienteDAO::obtenerPorId(id)

#### ?

##### CarritoDAO::obtenerPorCliente(idCliente)

##### ProductoDAO::obtenerEnCarritoPorCliente(idCliente)

#### ProductoDAO::obtenerPorId(id)

#### ProductoDAO::obtenerDeLineaPedido(lineaPedido)

### ...

## estructura de scripts/páginas

### normas para la denominación

#### primero ponemos el ente principal con el que está asociado el PHP y luego le ponemos "los apellidos" (aunque no sea gramaticalmente correcto en español)

### (convertir todo lo de sesión a este modelo)

### productos-listado.php

#### DAO::productoObtenerTodos()

#### foreach ($productos) { ... }

### producto-detalle.php ?id=17

#### $producto = DAO::productoObtenerPorId(id);

#### $producto->getNombre() ...

#### con botón de añadir a carrito

### carrito-gestionar-producto.php ?productoId=17&variacionUnidades=+/-3

#### obtener datos de $_REQUEST y $_SESSION

##### $clienteId

##### $productoId

##### $variacionUnidades

#### 

##### (AQUÍ NOS FALTA COMPROBAR SI HAY STOCK)

###### ...

##### (hemos tomado la decisión de obligar al cliente a existir, así que estará ya con sesión iniciada)

##### $carrito = DAO::carritoObtenerParaCliente(clienteId);

##### $carrito.variarUnidadesProducto($productoId, $variacionUnidades);

###### DAO::carritoVariarUnidadesProducto($clienteId, $productoId, $variacionUnidades)

##### (AQUÍ NOS FALTA ACTUALIZAR EL STOCK)

###### ...

#### redirección a carrito-ver.php

##### "Aquí se vería el carrito"

### carrito-ver.php

#### CarritoDAO::obtenerPorCliente(idCliente)

#### ...

### paluego-s

#### pedido-ver.php

##### DAO, dame LineaPedido-s por Pedido

##### foreach (...) { ... }

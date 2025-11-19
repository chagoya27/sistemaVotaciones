<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>


## Instalación

Para poder correr el proyecto necesitamos de varias herramientas:

* PHP 8.3+
* Composer
* Node .js
* Npm
* Gestor de base de datos SQL (en nuestro caso postgre)
* Administrador de base de datos (opcional, en nuestro caso pgAdmin)

Afortunadamente ya hay una herramienta que nos provee la mayoria de los servicios **LARAVEL HERD** para descargarla accedemos a la siguiente liga https://herd.laravel.com/windows


Una vez en el panel inicial damos click en download

![alt text](images/image.png)

Nos descargará el instalador

![alt text](images/image-1.png)

Ejecutamos el instalador y esperamos

![alt text](images/image-2.png)

Finalizamos el instalador 

![alt text](images/image-3.png)

Por defecto crea el acceso en el escritorio

![alt text](images/image-4.png)


Abrimos la aplicacion

![alt text](images/image-5.png)


No es necesario pasarse a la versión pro. Por lo que damos click en 'Get Dashboard'

![alt text](images/image-6.png)

Ahora podemos ver que en el dashboard tenemos php, nginx y dumps corriendo
![alt text](images/image-7.png)

Vamos al apartado 'General' y en path es la ruta en donde se encontrará nuestro proyecto (nosotros lo dejamos por defecto)

![alt text](images/image-8.png)

En el apartado de 'Node' verificamos que se haya instalado

![alt text](images/image-9.png)

Ahora vamos a clonar el repositorio

Para ello accedemos al path en donde le indicamos que queremos tener nuestros proyectos. Como se dejó por default la ruta será C:\Users\nombreUsuario\Herd

Aqui tendremos una carpeta vacia

![alt text](images/image-10.png)


Abrimos git bash

![alt text](images/image-12.png)

En el buscador accedemos a la siguiente liga https://github.com/chagoya27/sistemaVotaciones#

Copiamos el link para clonar el repositorio

![alt text](images/image-11.png)

Clonamos el repositorio con

    $ git clone git@github.com:chagoya27/sistemaVotaciones.git

Observamos que el repositorio a sido clonado con éxito
![alt text](images/image-13.png)

Regresando a laravel Herd, en el apartado sites, hasta la esquina superior derecha obtendremos un candado damos click para asegurar la aplicación y en la parte inferior observaremos la url del sitio. Damos click en ella
![alt text](images/image-14.png)

Se abrirá nuestro navegador por defecto en donde aparecerán estos errores, esto es normal. Para solucionarlo tenemos que abrir nuestro proyecto en el editor de código preferido
![alt text](images/image-15.png)

Una vez abierto el editor de texto, buscamos la carpeta 'vendor' y observamos que no se encuentra
![alt text](images/image-16.png)

Para generar dicha carpeta, abrimos una nueva terminal
![alt text](images/image-17.png)

Ejecutamos el siguiente comando
    composer install

Verificamos que todas las dependencias del proyecto hayan sido instaladas
![alt text](images/image-18.png)


Aqui ya termino
![alt text](images/image-19.png)

Posteriormente ejecutamos este comando en la terminal

    copy .env.example .env

Lo cual nos genera un .env generico

![alt text](images/image-21.png)

Ejecutamos el comando para generar una llave de nuestro programa

    php artisan key:generate

![alt text](images/image-22.png)

Hasta este momento en nuestra url debemos de tener este error, el cual nos indica que no se encuentra la base de datos

![alt text](images/image-23.png)


Para evitarnos la instalacion de una base de datos, accedemos y creamos una cuenta en railway https://railway.com/
![alt text](images/image-24.png)

Una vez dentro damos click en new project
![alt text](images/image-25.png)

Seleccionamos new database

![alt text](images/image-26.png)

Seleccionamos postgres
![alt text](images/image-27.png)


Y accedemos al apartado de variables
![alt text](images/image-28.png)

En donde copiamos las credenciales de Host,Port, Database, UserName y Password y las colocamos en nuestro .env. Las credenciales de Host y Port se obtienen en settings >networking

![alt text](images/image-29.png)

Para fines practicos puede ocupar estas credenciales.
![alt text](images/image-30.png)

En nuestro proyecto ocupamos el comando para correr las migraciones de la base de datos

    php artisan migrate
![alt text](images/image-31.png)


Asi como los seeders

    php artisan db:seed


![alt text](images/image-32.png)


Por ultimo ya sea que en la misma aplicacion de laravel heard abran el link o den la consola ejecuten el comando

    php artisan serve

Y en una terminal diferente

    npm install

Y posteriormente 

    npm run dev

Podremos abrir el proyecto en el siguiente link

    http://127.0.0.1:8000

![alt text](images/image-33.png)

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

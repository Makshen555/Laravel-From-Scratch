[<--- Volver](/README.md)

# Working with databases

## Archivos de entorno y conexiones de bases de datos / Environment Files and Database Connections

Los archivos de entorno nos ayudan a tener privatizados algunos datos sobre nuestro proyecto que no queremos que salgan a la luz, por ejemplo las conexiones a nuestra base de datos, y para eso se utilizan las varibales .env, dentro del arhivo .env se establecen varables para lo que quieras mentener en secreto por ejemplo API Keys o en nuestro caso la conexion a la base de datos.

Ademas de hacer los cambios para poder conectarnos  al abse de datos vamos a utlizar un software como MySQL Workbench para tener una mejor interfaz de la base de datos.

## Migraciones: conceptos básicos absolutos / Migrations: The Absolute Basics

Para crear migraciones en la base de datos utilizamos el comando

```bash
php artisan migrate
```

Y para volver atras de una migración utilizamos el comando

```bash
php artisan migrate:rollback
```

Aca añadiré los demás comandos que se pueden utilizar con ``migrate``

![Alt text](image.png)

Para que los cambios que realizamos en el esquema de la base de datos en los archivos de migracion, tenemos que utilizar los comandos 

![Alt text](image-1.png)

```bash
php artisan migrate:rollback
php artisan migrate

// O por el contrario podemos utilizar

php artisan migrate:fresh
```

## Elocuente y el patrón de registro activo / Eloquent and the Active Record Pattern

Ahora vamos a crear un usuario directamente desde nuestra terminal de comandos, por lo que vamos a ingresar a la VM webserver y vamos a correr los siguientes comandos


```php
php artisan tinker

$user = new App\Models\User;

$user = new User;

$user->name = 'Andres Salas'

$user->email = 'andressalas@gmail.com'

$user->password = bcrypt('!password')

$user->save();
```

Ahora vamos a Workbench a verificar si nuestro nuevo usuario fue creado

![Alt text](image-2.png)

Como podemos visualizar nuestro usuario fue creado perfectamente.

Ahora si dentro de la terminal de comandos utilizamos la variable ``$user` podremos observar la información del usuario recientemente creado

![Alt text](image-3.png)

Tambien podemos realizar cambios sobre ese mismo objeto, de la siguiente manera

```bash
$user->name = 'John Doe';

$user->save();
```

Podemos visualizar como los cambios son mostrados la proxima vez que llamemos la variable

![Alt text](image-4.png)

Tambien podemos buscar usuarios por medio del ID de la siguiente manera

![Alt text](image-5.png)

En mi caso yo ya tenia un usuario guardado en la base de datos, pero para buscar el recien creado utilizamos el mismo coamdno con el id `2`

![Alt text](image-6.png)

Tambien podemos llamar todos los usuarios de esta manera

![Alt text](image-7.png)

Podemos guardar el resultado de esta funcion dentro de una variable

![Alt text](image-8.png)

Y retornar lo que queramos de esta variable

![Alt text](image-9.png)

Tambien podemos retornar el primer dato de esa variable

![Alt text](image-10.png)

O tambien podemos hacerlo como un array

![Alt text](image-11.png)

## Tres formas de mitigar las vulnerabilidades de las asignaciones masivas / 3 Ways to Mitigate Mass Assignment Vulnerabilities

## Enlace del modelo de ruta / Route Model Binding

## Tu primera relación elocuente / Your Firts Eloquent Relationship

## Mostrar todas las publicaciones asociadas con una categoría / Show All Posts Associated With a Category

## El mecanismo de relojería y el problema N+1 / Clockwork, and the N+1 Problem

## La siembra de bases de datos ahorra tiempo / Database Seeding Saves Time

## Turbo Boost con fábricas / Turbo Boost With Factories

## Ver todos los mensajes de un autor / View All Posts by An Author

## Relaciones de carga ansiosas en un modelo existente / Eager Load Relationships on an Existing Model
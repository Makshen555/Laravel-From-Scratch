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

## Tres formas de mitigar las vulnerabilidades de las asignaciones masivas / 3 Ways to Mitigate Mass Assignment Vulnerabilities

## Enlace del modelo de ruta / Route Model Binding

## Tu primera relación elocuente / Your Firts Eloquent Relationship

## Mostrar todas las publicaciones asociadas con una categoría / Show All Posts Associated With a Category

## El mecanismo de relojería y el problema N+1 / Clockwork, and the N+1 Problem

## La siembra de bases de datos ahorra tiempo / Database Seeding Saves Time

## Turbo Boost con fábricas / Turbo Boost With Factories

## Ver todos los mensajes de un autor / View All Posts by An Author

## Relaciones de carga ansiosas en un modelo existente / Eager Load Relationships on an Existing Model
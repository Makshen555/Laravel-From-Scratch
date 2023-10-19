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

## Crear un modelo de Post y migrarlo / Make a Post Model adn Migration

Vamos a eliminar la clase Post que creamos para crar una nueva con un modelo elocuente.

![Alt text](image-12.png)

Ahora nos dirigimos a la terminal de comandos y junto a _php artisan_ vamos a utilizar una extension llamada ``make` la cual funciona para crear archivos.

Primero utilizamos este comando para crear una tabla de post

```bash
php artisan make:migration create_post_table
```

![Alt text](image-13.png)

Y como podemos observar, en la carpeta de migrations en el folder de nuestro proyecto se creó una nueva migracion

![Alt text](image-14.png)

Ahora eliminamos la carpeta posts que habiamos creado en el pasado ya que ahora los posts se cargaran desde la base de datos

![Alt text](image-15.png) 

![Alt text](image-16.png)

Ahora vamos a la migracion de posts y editamos el codigo

```php
public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('excerpt');
            $table->text('body');
            $table->timestamps();
            $table->timestamp('published_at')->nullable();
        });
    }
```

Ahora nos movemos a la terminal y migramos la tabla a la base de datos

![Alt text](image-17.png)

Y ahora checamos en Workbench que nuestra nueva tabla haya sido creada correctamente

![Alt text](image-18.png)

Ahora vamos a crear el respectivo modelo elocuente, recordar que el nombre del modelo siempre debe ser el nombre de la tabla preo en singular, en este caso la tabla se llama ``posts`` y el modelo se llama ``Post``

![Alt text](image-19.png)

Y ahora podemos observar que tenemos una clase Post en nuestra caperta de modelos

![Alt text](image-20.png)

Ahora vamos a utilizar tinker y vamos a intentar traer todos los posts que tengamos en la base de datos, aunque de momento no tenemos ninguno.

![Alt text](image-21.png)

Tambien podemos utilizar count() para verificar cuantos posts tenenmos en la base de datos

![Alt text](image-22.png)

Ahora vamos a crear un nuevo post desde la terminal

![Alt text](image-23.png)

Revisamos Workbench para visualziar nuestro nuevo posts

![Alt text](image-24.png)

Y desde nuestra terminal volvemos a utilizar las funciones de count() y all()

![Alt text](image-25.png)

Ahora vamos a cambiar en el archivo ``web.php`` el siguiente codigo ya que no necesitamos pasar el slug, si no el id del post

```php
Route::get('posts/{post}', function ($id) {

    return view('post', [
        'post' => Post::findOrFail($id)
    ]);
});
```

Y ahora visualizamos la pagina web para comprobar que todo este en orden.

![Alt text](image-26.png)

Y ahora necesitamos cambiar en el archivo ``posts.blade.php`` el _slug_ por _id_

```php
@extends('layouts.layout')

@section('content')
    @foreach ($posts as $post)
        <article>
            <h1><a href="/posts/{{ $post->id }}"> {{$post->title}} </a></h1>
            <div>
                {{$post->excerpt}}
            </div>
        </article>
    @endforeach
@endsection
```

Y como podemos ver ahora podemos ingresar al post y se carga la infromación.

![Alt text](image-27.png)

Vamos a crear un post mas

![Alt text](image-28.png)

Y visualizamos la web para visualizar nuestro nuevo post

![Alt text](image-29.png)

![Alt text](image-30.png)

## Eloquent Updates and HTML Escanping

## Tres formas de mitigar las vulnerabilidades de las asignaciones masivas / 3 Ways to Mitigate Mass Assignment Vulnerabilities


## Enlace del modelo de ruta / Route Model Binding

## Tu primera relación elocuente / Your Firts Eloquent Relationship

## Mostrar todas las publicaciones asociadas con una categoría / Show All Posts Associated With a Category

## El mecanismo de relojería y el problema N+1 / Clockwork, and the N+1 Problem

## La siembra de bases de datos ahorra tiempo / Database Seeding Saves Time

## Turbo Boost con fábricas / Turbo Boost With Factories

## Ver todos los mensajes de un autor / View All Posts by An Author

## Relaciones de carga ansiosas en un modelo existente / Eager Load Relationships on an Existing Model
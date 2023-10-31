[<--- Volver](/README.md)

# Admin Section

## Limitar acceso solo para administradores / Limit Access to Only Admins

Creamos una nueva ruta en `web.php`

```php
Route::get('admin/posts/create', [PostController::class, 'create']);
```

Luego vamos a PostController para crear la funcion que se encargara de crear los posts
public function create()
    
```php
{
    return view('posts.create');
}
```

Luego creamos la vista create dentro del folder de vistas de posts

![Alt text](image.png)

Pegamos el siguiente codigo para probar que todo funcione.

```php
<x-layout>
    <section class="px-6 py-8">
        Hello
    </section>
</x-layout>
```

Y probamos en el navegador que todo funcione correctamente
![Alt text](image-1.png)

Ahora vamos a filtrar para que no todos puedan acceder a esta funcion

```php
{
    if(auth()->user()?->username=='LuisGomez') {
        abort(Response::HTTP_FORBIDDEN);
    }
    return view('posts.create');
}
```

Ahora nos ndirigimos a nuestra terminal en la Vm webserver y creamos un nuevo middleware

```bash
php artisan make:middleware MustBeAdministrator
```

![Alt text](image-2.png)

![Alt text](image-3.png)

Ahora la logica de la funcioin create la vamos a mover a este nuevo Middleware

```php
public function handle(Request $request, Closure $next)
    {
        if(auth()->user()?->username=='LuisGomez') {
            abort(Response::HTTP_FORBIDDEN);
        }
        return $next($request);
    }
```

Luego vamos al archivo `Kernel.php` el cual se encutra en la ruta _app/Http_ para annadir nuestro nuevo middleware, este ultimo lo agregamos en `$routeMiddleware `

```php
'admin' => MustBeAdministrator::class;
```


Ahora nos vamos al archivo de rutas y prodremos agregar el middleware admin

```php
Route::get('admin/posts/create', [PostController::class, 'create'])->middleware('admin');
```
Probamos con un usuario que no sea admin



##

```php

```

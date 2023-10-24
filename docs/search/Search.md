[<--- Volver](/README.md)

# Search

## Búsqueda (de forma desordenada) / Search (The Messy Way)

Vamos a habilitar la busqueda de post de una manera un poco fea

Lo primero será ir al archivo _post-header.blade.php y centranos en esta parte

```php
<div class="relative flex lg:inline-flex items-center bg-gray-100 rounded-xl px-3 py-2">
        <form method="GET" action="#">
            <input type="text" name="search" placeholder="Find something"
                    class="bg-transparent placeholder-black font-semibold text-sm">
        </form>
    </div>
```

Esta parte del código lo que hace es buscar por medio de la URL

![Alt text](image.png)

Para que esto funcione iremos al archivo de ruta `web.php` y agregamos lo siguiente en la ruta principal

```php
Route::get('/', function () {

    $posts = Post::latest();

    if (request('search')) {
        $posts->where('title', 'like', '%' . request('search') . '%');
    }
   return view('posts', [
        'posts' => $posts->get(),
       'categories' => Category::all()
    ]);
})->name('home');
```

![Alt text](image-1.png)

![Alt text](image-2.png)

Como se puede visualizar la busqueda por palabras ya funciona, sin embargo no es la manera mas limpia de hacerlo.

También se puede buscar de manera que en el cuerpo del post también se encuentre la palabra buscada, esto se hace modificando un poco el código anterior


```php
Route::get('/', function () {

    $posts = Post::latest();

    if (request('search')) {
        $posts->where('title', 'like', '%' . request('search') . '%')
        ->orWhere('body', 'like', '%' . request('search') . '%');
    }
   return view('posts', [
        'posts' => $posts->get(),
       'categories' => Category::all()
    ]);
})->name('home');
```

Ahora vamos a agregar esta pequeña linea en el input de buscar para que quede escrito la plabra que buscamos a la hora de buscar los post

```php
value="{{ request('search) }}"
```

## Búsqueda (de forma más limpia) / Search (The Cleaner Way)
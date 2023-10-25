[<--- Volver](/README.md)

# Filtering

## Restricciones de consulta elocuente avanzada / Advanced Eloquent Query Constrainst

Moficamos en PostController la funcion index para que tambien se habilite la busqueda por categorias

```php
public function index() {

    return view('posts', [
        'posts' => Post::latest()->filter(request(['search', 'category']))->get(),
        'categories' => Category::all()
    ]);
 }
```

Y añadimos u nuevo filtro en la funcion scopeFilter() en la clase Post

```php
public function scopeFilter($query, array $filters) {

    $query->when($filters['search'] ?? false, fn($query, $search) =>
        $query->where('title', 'like', '%' . $search . '%')
              ->orWhere('body', 'like', '%' . $search . '%'));

    $query->when($filters['category'] ?? false, fn($query, $category) =>
        $query
            ->whereExists(fn($query) =>
                $query->from('categories')
                    ->whereColumn('categories.id', 'posts.category_id')
                    ->where('categories.slug', $category))
       );
}
```

Como vemos, buscamos por medio de la URL y este nos muestra el post con la categoria correcta.
![Alt text](image.png)

En este caso la catgoria y el slug no son los mismos pero si revisamo en workbench veremos que ese slug equivale a esa categoria

![Alt text](image-1.png)

Otra manera un poco mas limpia de utilizar el mismo query es la siguiente

```php
public function scopeFilter($query, array $filters) {

        $query->when($filters['search'] ?? false, fn($query, $search) =>
            $query->where('title', 'like', '%' . $search . '%')
                  ->orWhere('body', 'like', '%' . $search . '%'));

        $query->when($filters['category'] ?? false, fn($query, $category) =>
            $query
                ->whereHas('category', fn ($query) =>
                    $query->where('slug', $category)
                )
        );
    }
```

Ahora vamos a post-header y vamos a actualizar el metodo por el que buscamos las categorias

```php
<x-dropdown-item
        href="/?category={{ $category->slug }}"
            :active="request()->is('categories/' . $category->slug)"
        >{{ ucwords($category->name) }}
</x-dropdown-item>
```
Ahora volvemos a la pagina y buscamos por medio de categorias y veremos que la URL será el nuevo metodo y no el antiguo

![Alt text](image-2.png)

En PostController a la funcion index agregamos lo siguiente

```php
public function index() {
     return view('posts', [
        'posts' => Post::latest()->filter(request(['search', 'category']))->get(),
        'categories' => Category::all(),
        'currentCategory' => Category::firstWhere('slug', request('category'))
    ]);
}
```

Por ultimo en web.php eliminamos la ruta de las categorías por lo que el archivo quedaría asi

```php
Route::get('/', [PostController::class, 'index'])->name('home');

Route::get('posts/{post}', [PostController::class, 'show']);

Route::get('authors/{author:username}', function (User $author) {

    return view('posts', [
        'posts' => $author->posts,
        'categories' => Category::all()
    ]);
});
```

## Extraer un componente de hoja desplegable de categoría / Extract a Category Dropdown Blade Component

Lo primero que haremos será crear un nuevo componente llamado `category-dropdown` lo podemos crear de la siguiente manera desde la terminal de nuestra VM webserver en la ruta de nuestro proyecto

```bash
php artisan make:component CategoryDropdown
```

Pegamos toda la logica del dropdown dentro de este nuevo componente

Dentro de _app/View/Components_ se creó un nuevo componente al que agregaremos el siguiente codigo

```php
public function render()
    {
        return view('components.category-dropdown', [
            'categories' => Category::all()
        ]);
    }
```

Modificamos le archivo web.php ya que mo necesitamos pasar las categorias por la ruta

```php
Route::get('/', [PostController::class, 'index'])->name('home');

Route::get('posts/{post}', [PostController::class, 'show']);

Route::get('authors/{author:username}', function (User $author) {

    return view('posts', [
        'posts' => $author->posts
    ]);
});
```

Y en PostController modificamos también

```php
public function index() {

    return view('posts', [
        'posts' => Post::latest()->filter(request(['search', 'category']))->get()
    ]);
}
```

Movemos el trozo de codigo de que eliminamos de PostController y lo movemos al componente de CategoryDropdown ya que esté será quien se encargue de las categorias

```php
public function render()
    {
        return view('components.category-dropdown', [
            'categories' => Category::all(),
            'currentCategory' => Category::firstWhere('slug', request('category'))
        ]);
    }
```

Dentro de la carpeta _resources/views_ vamos a crar una carpeta llamada posts parar guardar las vistas de los post y renombramos las vistas

![Alt text](image-3.png)

Esto para que se llamen como sus respectivas funciones dentro del PostControllerS

##

##

##

##

##
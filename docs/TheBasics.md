[<--- Volver](/README.md)

# The Basics

## Como una ruta carga una vista / How a route load a view

En el directorio de nuestro proyecto hay varias carpertas, para el tema de rutas nos interesan estas dos es particular `routes` y `resources/views`

En la primer carpeta la cual se llama `routes` podemos encontrar los siguientes archivos, el que nos interesa es el el llamado `web.php` ya que ese archivo es el que maneja las rutas de nustra pagina web.

![Alt text](image.png)

En este archivo podemos encontrar el siguiente codigo que es el encargado de cargar la informacion que se despliega en la pagina principal de nuestra web.

```php
 
```

En el return de la función podemos ver un archivo llamado `'welcome'`, ese archivo es el que contiene todo el html que se despliega en la pagina de inicio
![Alt text](image-1.png)

Ese archivo es importado desde la carpeta `resources/views` y el archivo que contiene todo el html para desplegar el contenido de la pagina se llama `welcome.blade.php` solo que al colocarlo en la funcion solo hace falta poner el primer nombre antes del primer punto.

![Alt text](image-2.png)

Cualquier cambio producido en el archivo `welcome.blade.php` se verá reflejado en `web.php` al momento de cargar la pagina.

De igual manera, un cambio producido en el return de la función comentada lineas arriba, se vera reflejado en la pagina de incio al cargar la pagina web. Por ejemplo: cambiamos el archivo `'welcome'` por el archivo `'home'`

```php
Route::get('/', function () {
    return view('home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

```

Ahora podemos visualizar que en nuestra main page lo que se carga es la pagina `home` en lugar de la página `welcome`

![Alt text](image-3.png)

[<--- Volver](/README.md)

# Forms and Authentication

## Construir una pagina de registro de usuarios / Build a Register User Page

Necesitamos una pagina para registrar usuarios en nuestra web, por lo que vamos a crear una nueva ruta en el archivo web.php

```php
Route::get('register', [RegisterController::Class, 'create']);
```

Ahora nos vamos a la terminal de la VM webserver a crear el nuevo controlador por medio de comandos

```php
php artisan make:controller RegisterController
```
![Alt text](image.png)

En RegisterController creamos la siguiente función

```php
public function create() {
    return view('register.create');
}
```

Y ahora creamos la nueva vista

![Alt text](image-1.png)

Como podemos observar al poner _/register_ en la URL de la pagina, esta nos redirige a la vista que creamos.

Luego de crear el formulario en el que vamos a registrar los usuarios, nos movemos al arcihov de rutas ``web.php`` para que el endpoint admita request de tipo POST

```php
Route::post('register', [RegisterController::Class, 'store']);
```

Ahora nos movemos al RegisterController y creamos una nueva funcion()

```php
public function store() {
        $attributes = request()->validate([
            'name' => 'required|max:255',
            'username' => 'required|max:255|min:3',
            'email' => 'required|email|max:255',
            'password' => 'required|min:7|max:255',
        ]);

        User::create($attributes);

        return redirect('/');
    }
```
Ahora vamos a nuestra pagina web a crear un usuario por medio del formulario antes creado

![Alt text](image-2.png)

Como vemos el usuario se crea, pero este se crea con ciertos errores, pero esto lo arreglaremos en el siguiente video

## Hashing automático de contraseñas con mutadores / Automatic Password Hashing with mutators

Agregamos lo siguiente en la funcion store() en RegisterController

```php
public function store() {
        $attributes = request()->validate([
            'name' => 'required|max:255',
            'username' => 'required|max:255|min:3',
            'email' => 'required|email|max:255',
            'password' => 'required|min:7|max:255',
        ]);

        $attributes ['password'] = bcrypt($attributes ['password']);
        User::create($attributes);

        return redirect('/');
    }
```

Otra manera de ocultar el password dentro de la base de datos sería con un mutator en el modelo User.php

```php
public function setPasswordAttribute($password) {
    $this->attributes['password'] = bcrypt($password);
}
```
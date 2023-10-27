[<--- Volver](/README.md)

# Comments

## Escriba el margen para comentarios en los post / Write the markup for a Post Comment

Vamos al archivo show en la carpeta posts y modificamos para agregar una nueva seccion para los comentarios

```php
<article class="flex bg-gray-100 border border-gray-200 p-6 rounded-xl space-x-4">
    <div class="flex-shrink-0">
        <img src="https://i.pravatar.cc/" alt="" width="60" height="60" class="rounded-xl">
    </div>
    <div>
        <header>
            <h3 class="fonr-bold">Jonh Doe</h3>
            <p class="text-xs">
                Posted
                <time>8 months ago</time>
            </p>
        </header>
        <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
         </p>
    </div>
</article>
```

Este seria solo la base para crear la seccion de comentarios, este codigo lo vamos a mover a un componentesque llamaremos `post-comment`

Asi se veria los comentarios de los posts dentro del post

![Alt text](image.png)

## 
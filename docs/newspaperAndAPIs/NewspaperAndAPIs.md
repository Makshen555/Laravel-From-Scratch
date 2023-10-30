[<--- Volver](/README.md)

# Newspaper and APIs

## Modificación de la API de Mailchimp / Mailchimp API Tinkering

Ahora vamos a agregar funcionalidad a la parte baja de nuestra pagina web, en concreto esta

![Alt text](image.png)

En el componente `layout` vamos a editar la referencia

```php
<a href="#newletter" class="bg-blue-500 ml-3 rounded-full text-xs font-semibold text-white uppercase py-3 px-5">
    Subscribe for Updates
</a>
```

Posterior a esto lo que haremos sera ir a la pagina de maolchip, para consumir la API que necesitamos para poder enviar los mensajes por medio del correo
- [Pagina oficial de Mailchip](https://mailchimp.com/es/)

Aca lo que haremos sera darle al boton que dice `Sign In` o `Registrate` para registarnos en la pagina y poder utilizar la API.

Al darle al boton nos saldra la opcion de suscribirnos en varios planes, en este caso utilizamos el plan gratis.

Una vez dentro de la pagina luego de habernos registrado y completado el correspondiente formulario, vamos a nuestra cuenta para crear una API key

![Alt text](image-1.png)

Nos vamos a cuenta y facturacion

![Alt text](image-2.png)

Y una vez aca nos dirigimos hacia la parte de extras, y al apartado de claves API 

![Alt text](image-3.png)

Escroleamos un poco hasta toparnos con esta parte y damos click deonde dice `crear una clave`

![Alt text](image-4.png)

Una vez creada la clave, la copiamos y la llevamos a nuestro .env para guardarla

```php
MAILCHIMP_KEY=YOURAPIKEYHERE
```

Luego nos vfamos a la ruta _config_ y nos dirigimos al archivo `services.php`, aca lo que haremos sera crear el nuevo servicio que vamos a annadir a nuestro proyecto.

```php
'mailchimp' => [
    'key' => env('MAILCHIMP_KEY')
]
```

Ahora vamos a la terminal de nuestra VM webserver para verificar que el programa reconozca el servicio

```bash
php artisan tinker
config('services.mailchimp')
```
Nos dirigimos a la pagina de documentacion de la API para que sea mucho mas facil seguir los pasos para contruir la llamada de la API

-[Documentacion de la API Mailchimp](https://mailchimp.com/developer/marketing/guides/quick-start/)

Igulamente dentro de nuestra terminal vamos a instalar la libreria para poder utilizar la API, esto con el siguiente comando

```bash
composer require mailchimp/marketing
```
![Alt text](image-5.png)

Ahora copiamos el codigo de la API call en nuestro archivo de rutasm esto sera temporal

```php
Route::get('ping', function () {
    $mailchimp = new \MailchimpMarketing\ApiClient();

    $mailchimp->setConfig([
        'apiKey' => 'YOUR_API_KEY',
        'server' => 'YOUR_SERVER_PREFIX'
    ]);

    $response = $mailchimp->ping->get();
    ddd($response);
});
```

Aca colocamos la API key y ademasd de eso nos pide el server Prrfix, ese lo conseguimos viendop la URL que tenemos al entrar en nuestra cuenta en mailchimp, en mi caso es `us14`

![Alt text](image-6.png)

Si al entrar al endpoint de /ping y nos sale esto, significa que todo esta perfectamente configurado y ya podemos hacer uso de la API

![Alt text](image-7.png)

Ahora cambiamos esta liean en el response para obtener un array con los datos

```php
$response = $mailchimp->lists->getAllLists();
```

Y recibiremos esto

![Alt text](image-8.png)

Ahora al realizar un hardcoding con los datos de mi usuario, nos estariamos subscribiendo para recibir correos

```php
$response = $mailchimp->lists->addListMember('9b3f6bdc7d', [
    'email_address' => 'luis@gmail.com',
    'status' => 'suscribed'
]);
```

##
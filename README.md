## Puesta en Marcha del proyecto
###Version de PHP utilizada:
php -v
PHP 7.4.28 (cli) (built: Feb 24 2022 02:16:32) ( ZTS Visual C++ 2017 x64 )
Copyright (c) The PHP Group
Zend Engine v3.4.0, Copyright (c) Zend Technologies
with Xdebug v3.1.5, Copyright (c) 2002-2022, by Derick Rethans

### Instalacion de gestor de dependencias Composer:
https://getcomposer.org/download/

Windows Installer:

The installer - which requires that you have PHP already installed - will download Composer for you and set up your PATH environment variable so you can simply call composer from any directory.

Download and run https://getcomposer.org/Composer-Setup.exe - it will install the latest composer version whenever it is executed.

### Puesta en Marcha

- Crear la base de datos "tiendaonline" en mysql
- La aplicacion espera que las credenciales de la base de datos sean "root" 1234
pero pueden ser seteadas otras en el fichero .env del proyecto.
  DB_CONNECTION=mysql
  DB_HOST=127.0.0.1
  DB_PORT=3306
  DB_DATABASE=tiendaonline
  DB_USERNAME=root
  DB_PASSWORD=1234
- Ejecutar dentro del proyecto los siguientes comandos: 

``composer install`` (Instala la dependencias del proyecto laravel)

``php artisan storage:link`` (Crea un enlace simbolico de la carpeta uploads hacia la carpeta public !importante hacerlo)

``php artisan migrate:refresh`` (Crea el schema en la base de datos)

``php artisan db:seed``  (Rellena con datos la base de datos (./database/seeders/DatabaseSeeder.php)

``php artisan serve`` (Levanta la aplicacion sobre 127.0.0.1:8080)

### Datos a tener en cuenta:
Para acceder al panel de administracion de la tienda 127.0.0.1:8080/admin
es necesario utilizar las credenciales : admin@admin.com - password (literalmente la palabra password)

Una vez creado el entorno por primera vez si se quiere resetear solo la base de datos ejecutar solo:

``php artisan migrate:refresh`` (Crea el schema en la base de datos)


``php artisan db:seed``  (Rellena con datos la base de datos (./database/seeders/DatabaseSeeder.php)

Si tuvieras cualquier problema poniendo en marcha la aplicación, por favor ponte en contacto conmigo via email fcamachomaya@uoc.edu


  
    

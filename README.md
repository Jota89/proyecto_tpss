## Pasos para la Levantar el Proyecto por 1ra Vez (Solo la primera vez)

- Instalar dependencias php: **composer install**
- Instalar dependencias js: **npm install**
- Crear archivos estaticos: **npm run dev**
- Crar migraciones: **php artisan migrate:refresh --seed**
- Ejecutar proyecto: **php artisan serve**


## Para ejecutar el Proyecto cada que necesitemos
-- Ejecutar proyecto: **php artisan serve**


## Traer los cambios de Git 
-- Hacemos pull a la rama principal: **git pull origin master**


## Para crear una tabla (migraciones)
-- Se pone la palabra create, el nombre de la tabla y al final la palabra table (create_nombre_tabla_table): **php artisan make:migration create_nombre_tabla_table**


## Para agregar campos a la tabla despues de estar la base de datos llena
**php artisan make:migration add_votes_to_user_table --table=users**
Despues de crear se corre de la siguiente manera:
**php artisan migrate --path=database/migrations/2022_09_03_190322_add_transaction_id_to_ordenes_table.php**


## cada que ser cree una ruta hay que correr este comando
php artisan route:cache
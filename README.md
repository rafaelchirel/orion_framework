<p align="center"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/27/PHP-logo.svg/1200px-PHP-logo.svg.png" width="197px" height="64px"></p>

## Link publico del proyecto (URL)
https://orion-framework.herokuapp.com/

**Usuario previamente registrado**
```shell
	Administrador:
		usuario:  admin@gmail.com
		password: 123456
	Moderador:
		usuario:  moderador@gmail.com
		password: 123456
```

## Componentes que incluye el Framework:

- Autenticación.
- Enrutamiento.
- Notifcaciones.
- Validación.
- Eloquent.
- Redireccionamiento.
- Proteccion de Rutas.
- Filtros de seguridad (Auth).
- Sistema simple de View / layout y content.

## Requerimientos

- PHP >=5.6.4
- MySQL
- Git
- Composer

## Instalación

**Git**
```shell
	git clone https://github.com/rafaelchirel/orion_framework.git
```

**Archivo .sql (base de datos) - Importar desde phpmyadmin**
```shell
	path: orion_framework-master/db/orion_microframework.sql
```

**Credencias de la base de datos `database.php`**
```shell
	path: orion_framework-master/app/database.php
	Tipo de Driver: Opciones ->(mysql or sqlite)
		'driver' => 'mysql'
```

**Dependencias**
```shell
	composer install
```

**iniciar**
```shell
	Carpeta raiz y desde consola / Ubuntu
		command: php -S localhost:8080 -t public
```

## Consideraciones
Agradezco cualquier consideración y/o sugerencia que puedas darme al respecto. El Framework apenas está en su v1.0
Está estructura básica y simple puede servir de modelo o base para ampliar y expandir dichas funcionalidades, agregando más componentes y filtros de seguridad.
¡Saludos!.

## Colaborar

Cualquier aportación vía Pull-Request  :)

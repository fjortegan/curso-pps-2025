# Resolución tarea Módulo 2 
## Actividad 1 Explotación y Mitigación de SQL Injection (SQLi)

### Preparación del entorno

En lugar de instalar directamente apache y php en mi máquina he usado docker-compose.

### Sistema inseguro

Siguiendo los pasos establecidos en la actividad, comienzo creando el archivo `login.php`

Se ejecuta el comando: `docker-compose up`
![Captura 5](capturas/captura5.png)

Este comando crea los contenedores para la base de datos (mariadb) y el servidor apache con php. 

Se explota la inyección SQL:

![Captura 1](capturas/captura1.png)

![Captura 2](capturas/captura2.png)

### Asegurando el sistema

Siguiendo las instrucciones de la tarea se crea el archivo `login_secure.php`

Se prueba que no se puede explotar la inyección:

![Captura 3](capturas/captura3.png)

![Captura 4](capturas/captura4.png)

### Archivos utilizados

Todos los archivos de la tarea se encuentran en este repositorio para su revisión.


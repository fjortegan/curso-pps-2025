# Resolución tarea Módulo 5 
## Actividad 3 Identificación y Corrección de Security Misconfiguration

### Preparación del entorno

He usado docker-compose para poner en marcha el servidor apache con php.

### Identificación de la vulnerabilidad

Ejecutando el comando `curl -I http://localhost` (he publicado un archivo .php y otro .html):

![Captura 1](capturas/captura1.png)

### Corrigiendo la configuración

Se corrige la configuración de apache2:

![Captura 2](capturas/captura2.png)

![Captura 3](capturas/captura3.png)

Resultado una vez corregido el servidor apache2:

![Captura 4](capturas/captura4.png)

Se corrige la configuración de php:

![Captura 5](capturas/captura5.png)

![Captura 6](capturas/captura6.png)

Resultado una vez corregidos apache2 y php:

![Captura 7](capturas/captura7.png)

### Mitigación y mejores prácticas

Se ajusta el host virtual de apache2:

![Captura 9](capturas/captura9.png)

Resultado usando la nueva configuración:

![Captura 8](capturas/captura8.png)

### Archivos utilizados

Todos los archivos de la tarea se encuentran en este repositorio para su revisión.


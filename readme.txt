Instrucciones de instalacion:

1)Volcar todas las carpetas y archivos de la carpeta crud a la direccion y servidor donde se vaya alojar la pagina


2) crear una base datos y ejecutar los comandos SQL dentro del archivo SQLBATCH para construccion del as tablas y creacion
de datos de prueba


En los archivos volcados al servidor

3)modificar el archivo dentro de la carpeta dao. Archivo dbdatos que contiene los datos de conexion a la base de datos
la estructura de este archivo es

$dbhost="mysql.hostinger.es";
 servidor de base de datos
$dbuname="u128835160_ruiz";Usuario de acceso a la base de datos para la aplicacion

$dbpass="123456";
 Contraseña del usuario para acceso a la base de datos
$dbname="u128835160_crud"; nombre de la base de datos

Este archivo debe ser modificado con los parametros del servidor de base de datos que se usara.

4) dentro de la creacion de la base datos existen proyectos, empleados y clientes creados como ejemplo

Jefe de proyectos
Nombre Jhon Doe
usuario JhonDoe@test.com
psw Foo.Bar

Cliente
nombre OHL
Usuario ohl
psw 123456

Empleado
nombre Andres Perez
usuario andres
psw 123456



# Practica04-MiAgendaTelefónica
Práctica 4 - Programación Hipermedial

Práctica correspondiente al desarrollo de una aplicación web utilizando HTML, CSS, JavaScript, PHP y MySQL.

**PRÁCTICA DE LABORATORIO**

**CARRERA** : Computación

**ASIGNATURA** : Programación Hipermedial

**TÍTULO PRÁCTICA** : Resolución de problemas sobre PHP y MySQL.

**OBJETIVOS ALCANZADOS** :

- Diseñar adecuadamente elementos gráficos en sitios web en internet.
- Crear sitios web aplicando estándares actuales.
- Desarrollar aplicaciones web interactivas y amigables al usuario.
- Desarrollar una aplicación web que cuente con una base de datos.

**ACTIVIDADES DESARROLLADAS**

<h3><strong>1.  Generar el diagrama de E-R para la solución de la práctica. </strong></h3>

De acuerdo con los requerimientos de la práctica, se necesitan dos tablas: USUARIOS y TELEFONOS; además, como se solicita en los requerimientos propuestos en la Guía de la Práctica 04, se toma como base para crear la tabla USUARIOS la que se manejó en las sesiones de clase. Como resultado se obtiene una relación de uno a muchos desde la tabla USUARIOS hacia TELEFONOS.

A continuación, se presenta el diagrama de E-R realizado en Oracle Data Modeler.

![imagen](/images/readme_resources/g1.png)

**Nota:** Los nombres de tablas y atributos son en base a las convenciones de bases de datos.

<h3><strong>2.  Crear un repositorio en GitHub con el nombre "Practica04 - Mi Agenda Telefónica". </strong></h3>

**Usuarios de GitHub:** bryansb, czhizhpon

**Repositorio de la presente práctica:** https://github.com/czhizhpon/Practica04-MiAgendaTelefonica

<h3><strong>3.	Realizar un commit y push por cada requerimiento de los puntos antes descritos. </strong></h3>

Se fueron realizando commits de acuerdo se fue avanzando en el desarrollo de la práctica. Además, debido al desarrollo mediante ramas también se fueron realizando merges.

<h3><strong>4.	Crear el archivo README del repositorio de GitHub. </strong></h3>

**Nota:** Este archivo se lo generó en cuanto se creó el repositorio; este cuenta con la misma información presente en el informe.

<h3><strong>5.	Generar el informe de los resultados en el formato de prácticas.</strong></h3>

Para brindar una mejor explicación acerca del desarrollo del proyecto, se explicará por separado cada parte del mismo en los puntos siguientes; aun así, cabe recalcar que el proyecto fue realizado con el uso de los lenguajes HTML5, CSS3, JavaScript, PHP y SQL.

Se utilizó JavaScript para realizar la validación de formularios, además de enviar y recibir datos hacia PHP mediante AJAX para adquirir una mejor flexibilidad y experiencia de usuario.

Se utilizó PHP para poder persistir la información requerida de usuarios y teléfonos con la base de datos, además de realizar ciertas validaciones de la información antes de ser enviada para ser almacenada.

Se utilizó SQL para realizar consultas, inserciones de datos y actualizaciones en la base de datos.

<h3><strong>6.	Diseñar y crear la base de datos. </strong></h3>

<h4>6.1. Nombre de la Base de Datos:</h4> practica04

<h4>6.2. Sentencias SQL de la estructura de la base de datos:</h4>

<h4>A. Tabla TELEFONOS</h4>

![imagen](/images/readme_resources/g2.png)

**Nota:** tel_eliminado tendrá los valores N y E para no eliminado y eliminado respectivamente. Además, en tel_tipo tendrá los valores CE y CO para celular y convencional respectivamente.

![imagen](/images/readme_resources/g3.png)

<h4>B. Tabla USUARIOS</h4>

![imagen](/images/readme_resources/g4.png)

**Nota:** usu_eliminado tendrá los valores N y E para no eliminado y eliminado respectivamente. Además, en usu_tipo tendrá los valores A y U para administrador y usuario respectivamente.

![imagen](/images/readme_resources/g5.png)

<h3><strong>7.	Desarrollar funcionalidades para la parte de Usuarios con rol de Administrador. </strong></h3>

Para las funcionalidades de un administrador se ha requerido implementar el CRUD  de usuarios y su contraseña, también se decidió agregarle funcionalidades de CRUD de teléfonos. Además, la de tener acceso a sus datos para poder actualizarlos.

Debido a la cantidad de funcionalidades que posee la aplicación web para un usuario con rol de administrador, es el que contiene más páginas \*.php tanto en la vista como en el controlador.

Cabe mencionar que para realizar las acciones típicas para el CRUD se utilizan funciones escritas en JavaScript, que mediante AJAX, permite una mayor flexibilidad a la hora de acceder a la base de datos a través de PHP evitando redirecciones de páginas.

<h4>7.1.	CRUD de Usuarios:</h4>

<h4>A. Registrar Usuarios (C)</h4>

Para cumplir con esta funcionalidad se cuenta con un formulario en donde se podrán agregar los datos del usuario a crearse, además se podrá escoger el rol al que pertenecerá; todos los parámetros son validados antes de enviarse hacia la base de datos gracias a un archivo *.js como se trabajó en la práctica anterior.

<h5>Vista del formulario de registro</h5>

![imagen](/images/readme_resources/g6.png)

<h5>Función JS que envía los datos mediante AJAX</h5>

![imagen](/images/readme_resources/g7.png)

<h5>Código PHP que persiste la información en la BD</h5>

![imagen](/images/readme_resources/g8.png)

<h4>B.	Listar Usuarios (R)</h4>

Esta funcionalidad requería de obtener los registros de todos los usuarios, y de presentarlos. En este caso, se utilizó una consulta que presentaba solo los usuarios que no han sido eliminados; se agregó también una barra de búsqueda/filtrado que permitirá listar grupos específicos de usuarios
Además se les agrega un botón que permitirá redireccionar a ese usuario al panel de administración en donde se podrá modificar y actualizar los datos del mismo.

<h5>Vista de la página de visualización de usuarios</h5>

![imagen](/images/readme_resources/g9.png)

<h5>Función JS que envía los datos mediante AJAX</h5>

![imagen](/images/readme_resources/g10.png)

<h5>Código PHP que persiste la información en la BD</h5>

![imagen](/images/readme_resources/g11.png)

<h4>C.	Administrar Usuarios (RUD)</h4>

Para el cumplimiento de esta funcionalidad, se tiene una barra de búsqueda que permitirá buscar/filtrar cualquier usuario que se desee, esté o no eliminado. Esto, presentará a su vez a los datos principales de los usuarios junto con tres botones. 

El primer botón cambia el estado del usuario (Eliminar/Restaurar), el segundo permitirá recuperar los datos presentados para que se los pueda modificar, finalmente el tercer botón permite restablecer la contraseña del usuario.

En el segundo y tercer botón, se llama a funciones que hacen que aparezcan formularios que contienen los datos del usuario, o de para restablecer una contraseña, a diferencia del primer botón que realiza el cambio de estado del usuario de manera interna.

Tal como se lo visualiza en el Gráfico 12., se muestra el ejemplo de cómo se vería el formulario para restablecer una contraseña, en este caso del usuario que se creó al inicio en el Gráfico 6., igualmente, el parámetro de contraseña pasa por validaciones antes de ser enviado para la base de datos.

En esta parte se trabaja con 4 funciones principales: updateUser(mode), updatePassword(mode), deleteUser() y restoreUser(); siendo los “mode” una variable que diferencia si se edita el dato de un usuario registrado, o sí se trata del propio administrador que ha iniciado sesión.

<h5>Vista de la página que administra usuarios</h5>

![imagen](/images/readme_resources/g12.png)

<h5>Función JS que envía los datos mediante AJAX</h5>

![imagen](/images/readme_resources/g13.png)

<h5>Código PHP que persiste la información en la BD</h5>

![imagen](/images/readme_resources/g14.png)


<h4>7.2.	CRUD de Teléfonos:</h4>

<h4>A.	Registrar Teléfonos (CD)</h4>

Esta funcionalidad actúa de manera similar con la de registrar usuarios; se presenta un formulario en donde se presentan campos que llenar del teléfono, como el número, tipo operadora, un estado inicial y además la cédula del usuario al que se desee agregar dicho teléfono.

<h5>Vista de la página que registra teléfonos</h5>

![imagen](/images/readme_resources/g15.png)

Así mismo, cada uno de los campos se encuentra validado mediante funciones realizadas en JavaScript, además se cuenta con una función con AJAX en la cual se envían los datos del teléfono a la base de datos creando otro registro en la tabla TELEFONOS.

<h5>Función JS que envía los datos mediante AJAX</h5>

![imagen](/images/readme_resources/g16.png)

<h5>Código PHP que persiste la información en la BD</h5>

![imagen](/images/readme_resources/g17.png)

<h4>B.	Administrar Teléfonos (RUD)</h4>

La funcionalidad de administración de teléfonos es similar a la administración de usuarios; se cuenta con una barra de búsqueda/filtrado que permite localizar un número en específico o un grupo de números que cumplan con la condición de búsqueda. 

A su vez, se presentan en una tabla todos los teléfonos registrados en el sistema, junto con su información básica y un botón que recupera todos los datos de ese teléfono y los ingresa en un formulario para que se pueda actualizar la información.

<h5>Vista de la página que administra teléfonos</h5>

![imagen](/images/readme_resources/g18.png)

Como se pudo ver, también se puede cambiar su estado marcando una casilla; el administrador tiene una flexibilidad a la hora de realizar eliminaciones (no físicas) de la base de datos.

<h5>Función JS que envía los datos mediante AJAX</h5>

![imagen](/images/readme_resources/g19.png)

<h5>Código PHP que persiste la información en la BD</h5>

![imagen](/images/readme_resources/g20.png)

<h4>7.3.	Acceso a mi cuenta (RU):</h4>

Esta funcionalidad permite al usuario administrador modificarse así mismo, para ello se presentan dos formularios, los cuales siguen la misma lógica que los que se presentan en el Gráfico 12. la única diferencia es que se agrega otro campo de contraseña la cuál servirá para confirmar el cambio de la misma.

Ambos formularios llaman a los mismos métodos que se presentaron con anterioridad. En el Gráfico 13. se muestra la función para la contraseña, en el Gráfico 22, se mostrará la de editar los datos personales.

<h5>Vista de la página que administra los datos personales</h5>

![imagen](/images/readme_resources/g21.png)

<h5>Función JS que envía los datos mediante AJAX</h5>

![imagen](/images/readme_resources/g22.png)

<h5>Código PHP que persiste la información en la BD</h5>

![imagen](/images/readme_resources/g23.png)

<h3><strong>8.	Desarrollar funcionalidades para la parte de Usuarios con rol de Usuarios normales. </strong></h3>

Para las funcionalidades de un usuario normal, se ha propuesto que pueda realizar un CRUD de teléfonos, y su contraseña; también decidió agregarle funcionalidades de RUD de su propio usuario. Para cumplir con lo propuesto se ha dividido el CRUD en dos vistas, para poder agregar funcionalidades a la vista de los usuarios que han iniciado sesión.

Al igual que en la parte de administrador, sigue la misma lógica en cómo funcionan sus procesos, mediante funciones con AJAX para persistir la información de PHP hacia la base de datos.


<h4>8.1. CRUD de teléfonos:</h4>

<h4>A. Listar Teléfonos (CR)</h4>

Esta funcionalidad se implementa con una lista en tiempo real de los teléfonos del usuario, además de un panel con un formulario en donde se puede crear más teléfonos para ese usuario (Gráfico 24.). Se puede acceder también a la vista de administración de esos teléfonos listados mediante un botón que recupera los datos y los ingresa en un formulario en la otra página del usuario, la que se visualiza en el Gráfico 27, en donde se podría editarlos en caso de requerirlo.

<h5>Vista de la página que registra y visualiza teléfonos</h5>

![imagen](/images/readme_resources/g24.png)

<h5>Función JS que envía los datos mediante AJAX</h5>

![imagen](/images/readme_resources/g25.png)

<h5>Código PHP que persiste la información en la BD</h5>

![imagen](/images/readme_resources/g26.png)

<h4>B. Administrar Teléfonos (RUD)</h4>

Similar al punto anterior, se cuenta aquí con un buscador/filtrador de teléfonos, una lista de los mismos mediante una tabla, y un panel en donde se ingresan los datos recuperados por medio de los botones presentados también en la tabla.

Es en esta parte en donde se puede eliminar, listar/buscar o modificar uno de los teléfonos del usuario.

<h5>Vista de la página que administra los teléfonos del usuario</h5>

![imagen](/images/readme_resources/g27.png)

Como se pudo observar, cuenta con ciertas diferencias a nivel visual a comparación con la vista del usuario, como se vio en el Gráfico 18., aún así a nivel lógico trabaja igual en cuanto a la funciones JS y a las consultas/inserciones de PHP en la BD.

<h4>8.2. Acceso a mi cuenta (RUD):</h4>

En esta parte, es básicamente la misma que se presentó en el punto 7.3., solo que se agrega una funcionalidad en donde el usuario se puede eliminar a sí mismo (eliminar cuenta). Para volver a recuperarla necesitaría contactar a un administrador para poder obtenerla de regreso.

<h5>Vista de la página que administra los datos personales del usuario</h5>

![imagen](/images/readme_resources/g28.png)

<h3><strong>9.	Desarrollar funcionalidades para la parte de Usuarios Anónimos. </strong></h3>

Un usuario anónimo se refiere a aquellos “usuarios” que aún no se han registrado o no han iniciado sesión en el sistema. En este caso, los usuarios tienen funcionalidades limitadas.

<h4>9.1. Registrarse en el Sistema (C):</h4>

En esta funcionalidad, una persona que aún no se ha registrado en el sistema, mediante el index público puede acceder a un formulario en donde podrá realizar el proceso para registrarse en el sistema; al igual que todos los formularios en la aplicación web, cuenta con validaciones, en el siguiente gráfico se muestran ejemplos de ello.

<h5>Vista de la página que presenta el formulario de registro</h5>

![imagen](/images/readme_resources/g29.png)


<h4>9.2. Listar/Buscar un usuario (R):</h4>

Esta funcionalidad permite buscar un usuario dado su correo o su cédula a través de la barra de búsqueda.

<h5>Vista de la página que recupera un usuario del sistema</h5>

![imagen](/images/readme_resources/g30.png)

**Nota:** Esta funcionalidad se implementó en todos los usuarios para darle una mayor utilidad a la barra de búsqueda en cada vista.

Para realizar determinada funcionalidad, se emplea a la vez código HTML y PHP dentro de una misma página, tanto para realizar consultas como para estructurar la página; primero, obtiene el valor del input que se encuentra en la barra de búsqueda, y persiste, de ser posible la información de la base de datos.

Posteriormente, a través de dos tablas y con la ayuda del código PHP, se van insertando los datos en diferentes columnas para que así el usuario anónimo pueda visualizar la información y utilizar la misma para escribir un correo, o llamarlo desde alguna aplicación externa.

<h5>Parte del código HTML/PHP que recupera la información del usuario buscado</h5>

![imagen](/images/readme_resources/g31.png)

<h3><strong>10.	Desarrollar funciones de soporte y aplicar seguridad. </strong></h3>

<h4>10.1. Iniciar sesión</h4>

Para permitir el ingreso de usuarios previamente registrados a determinadas carpetas, se implementa la opción de inicio de sesión en donde mediante una consulta a la base de datos, se valida la existencia de dicho usuario, se determina su rol, y crea y establece una sesión.

<h5>Vista de la página en la cuál se debe iniciar sesión</h5>

![imagen](/images/readme_resources/g32.png)

<h5>Código PHP que persiste la información del usuario, y crea la sesión</h5>

![imagen](/images/readme_resources/g33.png)

<h4>10.2. Cerrar sesión</h4>

Esta funcionalidad lo que hace es que destruye la sesión actual, cerrando así el acceso de dicho usuario a todas las carpetas de la parte privada de la aplicación web. Para hacer esto, se da click en el ícono de cerrar sesión que se encuentra presente en todas las vistas de un usuario que ha iniciado sesión.

<h5>Código PHP que destruye la sesión actual</h5>

![imagen](/images/readme_resources/g34.png)

<h4>10.3. Seguridad mediante el uso de sesiones</h4>

Dentro de cada página PHP se agrega al inicio un bloque <?php ?> tanto de la parte de la Vista como en la parte del Controlador; esto valida que se cuente con una sesión existente y válida como se puede observar en el Gráfico 33., de no ser el caso se redirecciona al usuario que intentó ingresar a páginas a las cuales no tiene acceso.

<h5>Código PHP que valida la sesión de un usuario</h5>

![imagen](/images/readme_resources/g35.png)

<h5>Código PHP que valida la sesión de un administrador</h5>

![imagen](/images/readme_resources/g36.png)

**RESULTADO(S) OBTENIDO(S)**:

- Se logró entender, organizar y desarrollar de una mejor manera los sitios web.
- Se logró diseñar, de manera adecuada elementos gráficos en sitios web.
- Se logró implementar una aplicación web junto con una conexión a una base de datos para registrar instancias de usuarios, además de la información relevante de los mismos.

**CONCLUSIONES** :

- El uso de PHP junto con SQL brinda a los sitios web la posibilidad de tener mayor flexibilidad y funcionalidad, pudiendo así generar sitios web con mayor impacto y utilidad.
- Utilizar, manejar y controlar las sesiones mediante las variables “$_SESSION[‘nombreVariable’]” generan en el sitio web una mejor seguridad en cuanto al control de archivos, y administración de información.

**RECOMENDACIONES** :

- Probar el sitio web en al menos tres navegadores web: Google Chrome, Firefox y Safari.
- En caso de dudas, preguntar al docente encargado.
- Revisar la documentación de apoyo, para así tener mejor entendimiento del tema.
- Haber asistido a las clases de la asignatura.
- Revisar correctamente las configuraciones de la base de datos.

**Estudiantes:** Sarmiento Douglas Bryan Sarmiento, Zhizhpon Tacuri Cesar Tacuri

**Firmas:**

![imagen](/images/readme_resources/f1.jpg)

![imagen](/images/readme_resources/f2.png)
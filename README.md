# CSRF-phising
Parte practica del trabajo tutelado SSI. 

Consiste en enviar un formulario por correo electrónico haciéndose pasar por un correo enviado por facebook. Al hacer click en alguno de los botones del contenido del correo, redirige a una página que es un clon de la página de inicio de sesión de Facebook. El usuario pensará que debe loggearse para ver sus notificaciones, al hacer click en el botón de Iniciar sesión, se realiza un ataque CSRF a un sitio web ,en este caso será un sistema bancario simulado. 

# Descripcion de archivos

* ~~~~ login_vulnerable.html ~~~~ : 
Es una sitio web que simula una aplicación de intercambio de dinero. 
Al iniciar sesión, permite ver la cantidad de dinero que tiene el usuario, además que permite enviar dinero a otro usuario. 

* ~~~~ process_vulnerable.html ~~~~ : 
Permite procesar la información que genera ~~~~ login_vulnerable.html ~~~~

* ~~~~ facebook_mask.php ~~~~ :
Es un clon de la página de inicio de sesión de Facebook.

* ~~~~ fake_facebook.html ~~~~ : 
Es una plantilla para el contenido HTML de un correo electrónico.




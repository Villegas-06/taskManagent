# taskManagent

# Proyecto de Gestion de Tareas

Este proyecto es un aplicativo web para gestion de tareas.

## Tecnologías Utilizadas

PHP
MySQL

## Requisitos previos

Asegúrate de tener instalado Git, puedes descargarlo desde https://git-scm.com/. se recomienda instalar la opción: Standalone Installer

## Nota

Antes de continuar con los pasos de instalación espera a que git sea instalado.

## Pasos de instalación

Para ejecutar y configurar una aplicación PHP, debes seguir una serie de pasos para asegurarte de que todo esté correctamente configurado. Aquí tienes una guía paso a paso para configurar y ejecutar tu aplicación PHP:

1. **Preparar el Entorno**

    a. **Instalar un Servidor Local (XAMPP)**
        XAMPP: Descargar XAMPP e instalarlo: https://www.apachefriends.org/es/download.html.
        Estos paquetes incluyen Apache, MySQL, y PHP, necesarios para ejecutar tu aplicación.

    b. **Iniciar el Servidor**
        Abre el panel de control de XAMPP.
        Inicia los servicios de Apache y MySQL.

2. **Configurar la Base de Datos**

    a. **Crear la Base de Datos**
        Accede a phpMyAdmin: http://localhost/phpmyadmin/
        Crea una nueva base de datos con el nombre deseado.

    b. **Importar la Estructura de la Base de Datos**
        Si tienes un archivo .sql para la estructura de la base de datos, impórtalo desde phpMyAdmin en la base de datos recién creada.

3. **Clona el proyecto.**

    Abre tu terminal o línea de comandos en la ruta donde hayas instalado **XAMPP** y ejecuta el siguiente comando para clonar este repositorio en la carpeta de htdocs/xampp:

    git clone https://github.com/Villegas-06/taskManagent.git

4. **Acceder a la Aplicación**
    a. **Abrir la Aplicación en el Navegador**
        Abre tu navegador y navega a http://localhost/xampp/taskManagent/index.php?

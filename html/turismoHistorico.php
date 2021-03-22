<!DOCTYPE html>
<html lang="es">
<!--español-->
<!--carga las configuraciones necesarias para compatibilidad de navegación, pantallas y caracteres
        invoca también el CSS de bootstrap y la hoja de estilos local-->
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!--<link rel="stylesheet" href="css/normalize.css"> -->
    <link rel="stylesheet" href="../css/style.css">
    <link rel="icon" type="image/png"  href="../assets/img/turismoYopal-logo-v.png">
    <title>Dónde hospedarse en Yopal</title>
</head>

<body>
    <header>
        <!-- la etiqueta nav gestionada con bootstrap 4.0 contiene los enlace para las secciones de la página web-->
        <?php  include '../scripts/funciones.php'; 
        $historia=new funciones();
        $historia->navBar('historia');?>
        <!--ajusta el mensaje de bienvenida en la portada-->
        <div class="contenido-header-dondeAlojarse" style="background-image: url(../assets/img/turismoHistorico-portada2.jpg); background-position:center; background-attachment:fixed">
                <h1 class="centrar-texto" style="font-size:50px;">Lugares con historia en Yopal</h1>
        </div>
    </header>
    <!--limita el espacio en el que se distribuyen los elementos en la página, dándole márgenes en todo el contenido-->
    <div class="contenedor">
        <!--organiza el contenido en dos columnas en la que 
            1. muestra información de contexto, alguna guía o cualquier tipo de información que convenga para esta sección
            2. muestra una lista con los enlaces a los sitios que se están buscando. Cada ítem de esta lista contiene: nombre del lugar, dirección, texto corto, dos botones:
                2.1 enlace a información detallada del lugar
                2.2 enlace al sitio web del lugar (si tiene)-->
        <div class="dos-columnas">
            <div class="lateral mt-4"><!-- 1 -->
                <h3>Turismo con historia</h3>
                <p>Monumentos, edificios y lugares de todo tipo que puedes visitar cuando se quiere combinar el turismo con la historia del Municipio</p>
            </div>
            <div class="datos"><!-- 2 -->
            <?php 
                @$categoria = $_GET['name'];
                include '../scripts/cargador.php'; //desde funciones.php
                fetch_sites_list($categoria,'turismoHistorico'); 
                @$page = $_GET["page"];
                ?>
            </div>
        </div>
    </div>
    <?php $historia->footer(); ?>
    <!--scripts necesarios para el funcionamiento de bootstrap-->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
</body>
</html>
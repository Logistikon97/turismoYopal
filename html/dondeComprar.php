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
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@500&display=swap" rel="stylesheet">
    <!--<link rel="stylesheet" href="css/normalize.css"> -->
    <link rel="stylesheet" href="../css/style.css">
    <title>Dónde comprar en Yopal</title>
</head>

<body>
    <header>
        <!-- la etiqueta nav gestionada con bootstrap 4.0 contiene los enlace para las secciones de la página web-->
        <?php  include '../scripts/funciones.php'; navBar('comercio');?>
        <!--ajusta el mensaje de bienvenida en la portada-->
        <div class="contenido-header-compras">
                <h1 class="centrar-texto">¿Dónde comprar en Yopal?</h1>
            <p class="centrar-texto">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Aliquam illum eligendi
                voluptatum, sequi quos repellendus, hic autem expedita, facere voluptatibus eos quo? Assumenda quibusdam
            vel, nihil sunt tempore nobis. Voluptatem.</p>

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
            <div class="lateral"><!-- 1 -->
                <h3>aquí debería haber algo</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque aperiam quas quo. Temporibus, aliquam
                    laboriosam vero voluptatem veritatis odio consectetur! Ipsam, culpa! Expedita nostrum aspernatur
                    consequatur blanditiis vitae similique mollitia.</p>
            </div>
            <!--INICIO LISTA DE ESTABLECIMIENTOS-->
            <div class="datos"><!-- 2 -->
            <?php 
                @$categoria = $_GET['name'];
                include '../scripts/cargador.php';
                @$page = $_GET["page"];
                ?>
                <!--FIN LISTA DE ESTABLECIMIENTOS-->
            </div>
        </div>
    </div>
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
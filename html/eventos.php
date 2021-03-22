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
    <link rel="icon" type="image/png"  href="../assets/img/turismoYopal-logo-v.png">
    <title>Eventos</title>
</head>
<?php
        function eventosLista()
        {
            include 'scripts/conexion.php';
            $evento =new funciones();
            $consulta = 'SELECT `sitio`.`codigo` AS "codigo",`sitio`.`nombre` AS "nombreEvento",fechas_eventos.fecha_inicio FROM sitio,fechas_eventos WHERE sitio.categoria="evento" AND fechas_eventos.codigo_evento=sitio.codigo ORDER BY fechas_eventos.fecha_inicio ASC';
            $stmt = $con->prepare($consulta);
            $stmt->execute();
            $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($resultado as $row) {
                echo '<div class="contenedor-evento_item" style="background-image: url('.$evento->imagen($row['codigo'])/*desde funciones.php*/.');">
                <a href="#"  style="text-decoration: none;"><div class="item-evento">
                    <h4>' . $row['nombreEvento'] . '</h4>
                </div></a>
            </div>';
            }
        }
        ?>
<body>
    <header>
        <!-- la etiqueta nav gestionada con bootstrap 4.0 contiene los enlace para las secciones de la página web-->
        <?php  include '../scripts/funciones.php';
        $evento =new funciones();
        $evento->navBar('evento');?>
        <!--ajusta el mensaje de bienvenida en la portada-->
        <div class="contenido-header-evento">
            <div class="contenido-header__texto__dondeAlojarse restaurante-texto">
                <h1 class="centrar-texto">Conoce sobre los eventos en Yopal</h1>
            </div>
        </div>
    </header>
    <!--limita el espacio en el que se distribuyen los elementos en la página, dándole márgenes en todo el contenido-->
    <div class="contenedor">
        <!--organiza el contenido en dos columnas en la que 
            1. muestra información de contexto, alguna guía o cualquier tipo de información que convenga para esta sección
            2. muestra una lista con los enlaces a los sitios que se están buscando. Cada ítem de esta lista contiene: nombre del lugar, dirección, texto corto, dos botones:
                2.1 enlace a información detallada del lugar
                2.2 enlace al sitio web del lugar (si tiene)-->
            <div class="lateral mt-4" ><!-- 1 -->
                <h3>En Yopal se celebra la cultura llanera...</h3>
                <p>En la cuidad casanareña se realizan competencias deportivas, teniendo como protagonista el Coleo como deporte de la región; Fiestas en donde se aprecian las manifestaciones culturales, las tradiciones llaneras y las fiestas patronales entre otros eventos.</p>
            </div>
            <!--INICIO LISTA DE ESTABLECIMIENTOS-->
            <div class="datos"><!-- 2 -->
            <?php 
                @$categoria = $_GET['name'];
                include '../scripts/cargadorEventos.php';
                CargarEventos(); 
                @$page = $_GET["page"];
                ?>
                <!--FIN LISTA DE ESTABLECIMIENTOS-->
            </div>

    </div>
    <?php $evento->footer(); ?>
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
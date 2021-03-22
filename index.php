<!DOCTYPE html>
<html lang="es">
<!--español cualquiera puede modificar esto-->

<head>
    <!--carga las configuraciones necesarias para compatibilidad de navegación, pantallas y caracteres
        invoca también el CSS de bootstrap y la hoja de estilos local-->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!--<link rel="stylesheet" href="css/normalize.css"> -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" type="image/png"  href="assets/img/turismoYopal-logo-v.png">
    <script data-ad-client="ca-pub-8451117147033354" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <title>Turismo Yopal - Inicio</title>
</head>

<body>
    <header>
        <div>
            <!-- la etiqueta nav gestionada con bootstrap 4.0 contiene los enlace para las secciones de la página web-->
            <!-- agregar style = "background-color: #e90000;" para cambiar color-->
            <?php include 'scripts/funciones.php';
            $inicio= new funciones();
            $inicio-> navBar('inicio'); ?>
            <!--ajusta el mensaje de bienvenida en la portada-->
            <div class="contenido-header">
                <!-- alinea el texto al centro-->
                <div class="centrar-texto">
                    <h1 class="contenido-header__texto ">¡Vive la mejor experiencia de turismo en Yopal Casanare!</h1>
                </div>
            </div>
        </div>
    </header>
    <main>
        <!--limita el espacio en el que se distribuyen los elementos en la página, dándole márgenes en todo el contenido-->
        <div class="contenedor">
            <div class="contexto">
                <!--ajusta el texto de presentación y aplica estilos-->
                <h2 class="centrar-texto">¿Qué hacer en yopal?</h2>
                <p style="width:80%; margin-top:20px">La capital del llano, conocida por sus costumbres y tradiciones siempre tiene las puertas abiertas a los visitantes con un montón de cosas para hacer. Anímate a conocer los lugares más interesantes de la ciudad y enamórate de sus paisajes, sabores, tradiciones y de todo lo que Yopal tiene para ti.</p>
            </div>
            <div class="contenedor-form">
                <div class="form-buscar">
                    <form action="html/buscador.php" method="post">
                        <input type="text" name="search" id="search" pattern="[^'\x22]+" required placeholder="Busca aquí">
                        <input type="submit" value="Buscar" class="button-search">
                    </form>
                </div>
            </div>
            <!--gestiona la cantidad de columnas que se muestran en la pantalla-->
            <div class="cuadricula-inicio">
                <!--"cuadricula-inicio__item" aplica estilos a cada item en la cuadricula. cada item se compone de un título, imagen y texto introductorio corto.
                "hvr-float" hace la animación de flotar al hacer hover-->
                <div class="cuadricula-inicio__item hvr-float">
                    <h3>¿Donde comprar?</h3>
                    <a href="html/dondeComprar?name=comercio"><img class="img-rounded" src="assets/img/dondeComprar.jpg" alt="No se puede cargar la imagen" srcset=""></a>
                    <p class="mt-3">Si deseas comprar, encontrarás diversos centros comerciales, locales y tiendas con variedades de productos y servicios para los visitantes.</p>
                </div>
                <div class="cuadricula-inicio__item hvr-float">
                    <h3>¿Dónde comer?</h3>
                    <a href="html/dondeComer?name=restaurante"><img class="img-rounded" src="assets/img/comida.jpg" alt="No se puede cargar la imagen" srcset=""></a>
                    <p class="mt-3">Para los amantes de la gastronomía, hay una cantidad interminable de restaurantes de comida típica de la región basados  en los sabores del llano.</p>
                </div>
                <div class="cuadricula-inicio__item hvr-float">
                    <h3>¿Dónde alojarse?</h3>
                    <a href="html/dondeAlojarse?name=hotel"><img class="img-rounded" src="assets/img/dondedormir.jpg" alt="No se puede cargar la imagen" srcset=""></a>
                    <p class="mt-3" >Si de hospedarse en la ciudad se trata, hay numerosos hoteles de diferentes categorías, precios y algunos de talla internacional con las mayores comodidades para el huésped.</p>
                </div>
                <div class="cuadricula-inicio__item hvr-float">
                    <h3>Turismo histórico</h3>
                    <a href="html/turismoHistorico?name=historia"><img class="img-rounded" src="assets/img/historia.jpg" alt="No se puede cargar la imagen" srcset=""></a>
                    <p class="mt-3" >Yopal está llena de historias para contar y visitar, conoce estos lugares y entra en la memoria histórica de la ciudad</p>
                </div>
                <div class="cuadricula-inicio__item hvr-float">
                    <h3>Centros Recreacionales</h3>
                    <a href="html/recreacionales?name=recreacional">
                    <img class="img-rounded" src="assets/img/recreacion.jpg" alt="No se puede cargar la imagen" srcset=""> </a>
                    <p class="mt-3" >Pasar un rato agradable en familia y disfrutar de piscina, comida, música, estar en contacto con la naturaleza y mucho más, son cosas que se pueden hacer aquí. </p>
                </div>
                <div class="cuadricula-inicio__item hvr-float">
                    <h3>Actividades al aire libre</h3>
                    <a href="html/afuera?name=afuera"><img class="img-rounded" src="assets/img/afuera.jpg" alt="No se puede cargar la imagen" srcset=""></a>
                    <p class="mt-3" >Si te gusta más aventura al aire libre, la cuidad tiene sitios para realizar actividades como atletismo, caminatas, ciclo paseo, senderismo, fotografía y ríos para pesca y baño</p>
                </div>
            </div>
        </div>
        <?php
        /**
         * obtiene los eventos ordenados por fecha más reciente
         */
        function eventosInicio()
        {
            include 'scripts/conexion.php';
            $eventos =new funciones();
            $consulta = 'SELECT `sitio`.codigo AS "evento",`sitio`.nombre AS "nombre", `fechas_eventos`.fecha_inicio,`fechas_eventos`.fecha_fin FROM `fechas_eventos`,`sitio` WHERE `fechas_eventos`.codigo_evento=sitio.codigo ORDER BY `fechas_eventos`.fecha_inicio ASC LIMIT 0,5';
            $stmt = $con->prepare($consulta);
            $stmt->execute();
            $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($resultado as $row) {
                echo '<div class="contenedor-evento_item" style="background-image: url('.$eventos->imagen($row['evento']).');">
                <a href="#"  style="text-decoration: none;"><div class="item-evento">
                    <h4>' . $row['nombre'] .'</h4>
                </div></a>
            </div>';
            }
        }
        ?>
        <!--muestra información de eventos PENDIENTE-->
        <div class="eventos contenedor">
            <!--ajusta el texto para los mensajes que funcionen como títulos a entradas en nuevas secciones que vaya a mostrar un nuevo tema-->
            <div class="banerTexto">
                <h2>Encuentra los eventos más representativos de la ciudad</h2>
            </div>
            <div class="eventos__grid">
                <?php
                eventosInicio();
                ?>
                <div class="contenedor-evento_item" style="background-color: #ced4da; filter: unset;">
                    <a href="html/eventos?name=evento" style="text-decoration: none;">
                        <div class="item-evento ">
                            <h4 style="color: #457b9d ;">Ver más</h4>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </main>
    <?php $inicio->footer(); ?>
    <!--scripts necesarios para el funcionamiento de bootstrap-->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>

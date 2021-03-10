<!DOCTYPE html>
<html lang="es">
<!--español-->

<head>
    <!--carga las configuraciones necesarias para compatibilidad de navegación, pantallas y caracteres
        invoca también el CSS de bootstrap y la hoja de estilos local-->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!--<link rel="stylesheet" href="css/normalize.css"> -->
    <link rel="stylesheet" href="css/style.css">
    <title>Turismo Yopal - Inicio</title>
</head>

<body>
    <header>
        <div>
            <!-- la etiqueta nav gestionada con bootstrap 4.0 contiene los enlace para las secciones de la página web-->
            <!-- agregar style = "background-color: #e90000;" para cambiar color-->
            <?php include 'scripts/funciones.php'; navBar('inicio'); ?>
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
                <p style="width:80%; margin-top:20px">Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem similique ipsam dolorem! Corrupti
                    eveniet tempora accusantium rem magnam minima hic, ea obcaecati, temporibus suscipit, earum ut
                    aliquid veniam ex provident?</p>
            </div>
            <div class="contenedor-form">
                <div class="form-buscar">
                    <form action="html/buscador.php" method="post">
                        <input type="text" name="search" id="search" pattern="[A-Za-z0-9_-]{1-50}" required placeholder="Busca aquí">
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
                    <a href="html/dondeComprar?name=comercio"><img class="img-rounded" src="assets/img/dondeComprar.jpg" alt="historia" srcset=""></a>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                        Distinctio rem facilis explicabo officia at possimus voluptatem culpa veritatis nulla dicta, nam
                        in
                        omnis magnam aut alias deleniti numquam tempora recusandae?</p>
                </div>
                <div class="cuadricula-inicio__item hvr-float">
                    <h3>¿Dónde comer?</h3>
                    <a href="html/dondeComer?name=restaurante"><img class="img-rounded" src="assets/img/comida.jpg" alt="Comida" srcset=""></a>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                        Distinctio rem facilis explicabo officia at possimus voluptatem culpa veritatis nulla dicta, nam
                        in
                        omnis magnam aut alias deleniti numquam tempora recusandae?</p>
                </div>
                <div class="cuadricula-inicio__item hvr-float">
                    <h3>¿Dónde alojarse?</h3>
                    <a href="html/dondeAlojarse?name=hotel"><img class="img-rounded" src="assets/img/dondedormir.jpg" alt="dormir" srcset=""></a>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                        Distinctio rem facilis explicabo officia at possimus voluptatem culpa veritatis nulla dicta, nam
                        in
                        omnis magnam aut alias deleniti numquam tempora recusandae?</p>
                </div>
                <div class="cuadricula-inicio__item hvr-float">
                    <h3>Turismo histórico</h3>
                    <a href="html/turismoHistorico?name=historia"><img class="img-rounded" src="assets/img/historia.jpg" alt="historia" srcset=""></a>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                        Distinctio rem facilis explicabo officia at possimus voluptatem culpa veritatis nulla dicta, nam
                        in
                        omnis magnam aut alias deleniti numquam tempora recusandae?</p>
                </div>
                <div class="cuadricula-inicio__item hvr-float">
                    <h3>Centros Recreacionales</h3>
                    <a href="html/recreacionales?name=recreacional">
                    <img class="img-rounded" src="assets/img/recreacion.jpg" alt="historia" srcset=""> </a>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                        Distinctio rem facilis explicabo officia at possimus voluptatem culpa veritatis nulla dicta, nam
                        in
                        omnis magnam aut alias deleniti numquam tempora recusandae?</p>
                </div>
                <div class="cuadricula-inicio__item hvr-float">
                    <h3>Actividades al aire libre</h3>
                    <a href="html/afuera?name=afuera"><img class="img-rounded" src="assets/img/afuera.jpg" alt="historia" srcset=""></a>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                        Distinctio rem facilis explicabo officia at possimus voluptatem culpa veritatis nulla dicta, nam
                        in
                        omnis magnam aut alias deleniti numquam tempora recusandae?</p>
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
            $consulta = 'SELECT `sitio`.codigo AS "evento",`sitio`.nombre AS "nombre", `fechas_eventos`.fecha_inicio,`fechas_eventos`.fecha_fin FROM `fechas_eventos`,`sitio` WHERE `fechas_eventos`.codigo_evento=sitio.codigo ORDER BY `fechas_eventos`.fecha_inicio ASC LIMIT 0,5';
            $stmt = $con->prepare($consulta);
            $stmt->execute();
            $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($resultado as $row) {
                echo '<div class="contenedor-evento_item" style="background-image: url(assets/img/eventos/'.imagenEvento($row['evento']).'.jpg);">
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
    <footer class="footanari">
        <address class="contenedor color mb-0">
            <ul class="pt-3">
                <li class="row "><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-at" viewBox="0 0 16 16">
                        <path d="M13.106 7.222c0-2.967-2.249-5.032-5.482-5.032-3.35 0-5.646 2.318-5.646 5.702 0 3.493 2.235 5.708 5.762 5.708.862 0 1.689-.123 2.304-.335v-.862c-.43.199-1.354.328-2.29.328-2.926 0-4.813-1.88-4.813-4.798 0-2.844 1.921-4.881 4.594-4.881 2.735 0 4.608 1.688 4.608 4.156 0 1.682-.554 2.769-1.416 2.769-.492 0-.772-.28-.772-.76V5.206H8.923v.834h-.11c-.266-.595-.881-.964-1.6-.964-1.4 0-2.378 1.162-2.378 2.823 0 1.737.957 2.906 2.379 2.906.8 0 1.415-.39 1.709-1.087h.11c.081.67.703 1.148 1.503 1.148 1.572 0 2.57-1.415 2.57-3.643zm-7.177.704c0-1.197.54-1.907 1.456-1.907.93 0 1.524.738 1.524 1.907S8.308 9.84 7.371 9.84c-.895 0-1.442-.725-1.442-1.914z" />
                    </svg>
                    <a href="mailto:contacto@turismoyopal.xyz" style="margin-left: 10px; margin-bottom:10px;">contacto@turismoyopal.xyz</a>
                </li>
                <li class="row">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-telephone" viewBox="0 0 16 16">
                        <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z" />
                    </svg>
                    <p style="margin-left: 10px;"> (+57) 312 5290375</p>
                </li>
                <li class="row">
                    <div class="btn-group mb-3">
                        <button type="button" class="btn btn-outline-primary">
                            <a href="https://www.facebook.com/turismosYOPAL" class="text-decoration-none" target="_blank">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                                    <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"></path>
                                </svg>
                            </a>
                            <span class="visually-hidden"></span>
                        </button>
                        <button type="button" class="btn btn-outline-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16">
                                <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z"></path>
                            </svg>
                            <span class="visually-hidden"></span>
                        </button>
                    </div>
                </li>
            </ul>
        </address>
    </footer>
    <!--scripts necesarios para el funcionamiento de bootstrap-->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>
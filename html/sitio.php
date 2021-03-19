<!DOCTYPE html>
<html lang="es">
<!--español-->
<?php include '../scripts/conexion.php';
include '../scripts/funciones.php';
        $sitio = new funciones();
        $entrada = $_GET['siteName'];
        $stmt = $con->prepare('SELECT nombre_imagen AS "imagen" FROM images WHERE images.codigo_sitio_img='.$entrada.' LIMIT 1');
        $stmt->execute();
        $img = $stmt->fetch(PDO::FETCH_ASSOC);
        //consulta datos del sitio
        $consulta = 'SELECT * FROM `sitio` WHERE sitio.codigo = "' . $entrada . '"';
        $stmt = $con->prepare($consulta);
        $stmt->execute();
        $DatosSitio = $stmt->fetch(PDO::FETCH_ASSOC); /*datos del sitio*/
        //verifica qué redes sociales tiene
        function sociales($entrada){
            include '../scripts/conexion.php';
            $consulta = 'SELECT * FROM red_sociales WHERE red_sociales.codigo_sitio='.$entrada;
            $stmt = $con->prepare($consulta);
            $stmt->execute();
            $social = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($social['facebook'] != null) {
                echo '<a href="' . $social['facebook'] . '" target="_blank"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="relleno" ;transform:;-ms-filter:">
                        <path d="M13.397,20.997v-8.196h2.765l0.411-3.209h-3.176V7.548c0-0.926,0.258-1.56,1.587-1.56h1.684V3.127 C15.849,3.039,15.025,2.997,14.201,3c-2.444,0-4.122,1.492-4.122,4.231v2.355H7.332v3.209h2.753v8.202H13.397z">
                        </path>
                    </svg></a>';
            }
            if ($social['instagram'] != null) {
                echo '<a href="' . $social['instagram'] . '" target="_blank"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill:rgba(0, 0, 0, 1);transform:;-ms-filter:">
                        <path d="M20.947,8.305c-0.011-0.757-0.151-1.508-0.419-2.216c-0.469-1.209-1.424-2.165-2.633-2.633 c-0.699-0.263-1.438-0.404-2.186-0.42C14.747,2.993,14.442,2.981,12,2.981s-2.755,0-3.71,0.055 c-0.747,0.016-1.486,0.157-2.185,0.42C4.896,3.924,3.94,4.88,3.472,6.089C3.209,6.788,3.067,7.527,3.053,8.274 c-0.043,0.963-0.056,1.268-0.056,3.71s0,2.754,0.056,3.71c0.015,0.748,0.156,1.486,0.419,2.187 c0.469,1.208,1.424,2.164,2.634,2.632c0.696,0.272,1.435,0.426,2.185,0.45c0.963,0.043,1.268,0.056,3.71,0.056s2.755,0,3.71-0.056 c0.747-0.015,1.486-0.156,2.186-0.419c1.209-0.469,2.164-1.425,2.633-2.633c0.263-0.7,0.404-1.438,0.419-2.187 c0.043-0.962,0.056-1.267,0.056-3.71C21.003,9.572,21.003,9.262,20.947,8.305z M11.994,16.602c-2.554,0-4.623-2.069-4.623-4.623 s2.069-4.623,4.623-4.623c2.552,0,4.623,2.069,4.623,4.623S14.546,16.602,11.994,16.602z M16.801,8.263 c-0.597,0-1.078-0.482-1.078-1.078s0.481-1.078,1.078-1.078c0.595,0,1.077,0.482,1.077,1.078S17.396,8.263,16.801,8.263z">
                        </path>
                        <circle cx="11.994" cy="11.979" r="3.003"></circle>
                    </svg></a>';
            }
            if ($social['youtube'] != null) {
                echo '<a href="' . $social['youtube'] . '" target="_blank"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill:rgba(0, 0, 0, 1);transform:;-ms-filter:">
                        <path d="M21.593,7.203c-0.23-0.858-0.905-1.535-1.762-1.766C18.265,5.007,12,5,12,5S5.736,4.993,4.169,5.404 c-0.84,0.229-1.534,0.921-1.766,1.778c-0.413,1.566-0.417,4.814-0.417,4.814s-0.004,3.264,0.406,4.814 c0.23,0.857,0.905,1.534,1.763,1.765c1.582,0.43,7.83,0.437,7.83,0.437s6.265,0.007,7.831-0.403c0.856-0.23,1.534-0.906,1.767-1.763 C21.997,15.281,22,12.034,22,12.034S22.02,8.769,21.593,7.203z M9.996,15.005l0.005-6l5.207,3.005L9.996,15.005z">
                        </path>
                    </svg></a>';
            }
        }
        ?>
<head>
    <!--carga las configuraciones necesarias para compatibilidad de navegación, pantallas y caracteres
        invoca también el CSS de bootstrap y la hoja de estilos local-->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!--<link rel="stylesheet" href="css/normalize.css"> -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
    <title><?php echo $DatosSitio["nombre"]?></title>
</head>

<body>
    <header>
        <!-- la etiqueta nav gestionada con bootstrap 4.0 contiene los enlace para las secciones de la página web-->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="../index">TurismoYopal</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="dondeComer?name=restaurante">¿Dónde comer?<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="turismoHistorico?name=historia">Turismo histórico</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="dondeComprar?name=comercio">¿Dónde comprar?</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="dondeAlojarse?name=hotel">¿Dónde alojarse?</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="eventos?name=evento">Eventos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">¿Qué hacer en Yopal?</a>
                    </li>

                </ul>
            </div>
        </nav>
        <!--ajusta el mensaje de bienvenida en la portada-->
        

        <div class="contenedor-header_restaurante " style="background-image: url(<?php echo $img['imagen'];?>)">

        </div>
    </header>
    <main>
        <!--limita el espacio en el que se distribuyen los elementos en la página, dándole márgenes en todo el contenido-->
        <div class="contenedor">
            <!--organiza el contenido en dos columnas de forma que en una se encuentre el contenido principal ("datos") y la otra ("lateral") es un sidebar con enlaces relacionados -->
            <div class="dos-columnas__hotel">
                <!--"datos" contiene toda la información relacionada al lugar. todo lo que sea necesario insertar está dentro de este contenedor-->
                <div class="datos">
                    <?php echo '<span style="color:green;">DATO QUE ENTRA: '.$entrada.'</span>';?>
                    <h2><?php echo $DatosSitio['nombre']; ?></h2>
                    <p><?php echo $DatosSitio['descripcion']; ?>
                    </p>

                    <!--"card-datos" es una tarjeta que contiene información sobre contacto: teléfono, correo, horarios de atención etc.-->
                    <div class="card-datos">
                        <!--organiza la información en listas y agrega íconos de vectores gráficos escalables (.svg)-->
                        <ul class="datos__lista">
                            <li class="prueba"><span class="indicador"> Dirección: </span> <?php echo " " . $DatosSitio['direccion']; ?></li>
                            <li class="prueba"><span class="indicador">Teléfono: </span> <?php echo " " . $DatosSitio['telefono']; ?></li>
                            <li><span class="indicador"> Celular:</span><?php echo " " . $DatosSitio['celular']; ?></li>
                            <li><span class="indicador">Horario de atención: </span> <?php if(strtolower($DatosSitio['horarioAtencion']) =='siempre abierto'){echo "<span style='color:green'> " . $DatosSitio['horarioAtencion']."</span>";}else{echo " " . $DatosSitio['horarioAtencion'];} ?></li>
                            <li class="prueba">
                                <?php sociales($entrada); ?>
                            </li>
                        </ul>

                    </div>
                    <div>

                        <!--CAROUSSEL-->
                        <div id="carouselExampleControls" class="carousel slide mb-4" data-ride="carousel" style="max-width: 500px; margin:auto; ">
                            <div class="carousel-inner">
                                <?php
                                $img = $con->query('SELECT images.nombre_imagen AS "imagen" FROM `images` WHERE images.codigo_sitio_img ='.$entrada);
                                echo '<div class="carousel-item active">
                            <div class="carousel_img">
                                <img class="d-block w-100" src="../assets/img/desliza.jpg" alt="Second slide">
                            </div>
                        </div>';
                                while ($row = $img->fetch(PDO::FETCH_ASSOC)) {
                                    echo '<div class="carousel-item">
                                <div class="carousel_img">
                                    <img class="d-block w-100" src="' . $row['imagen'] . '" alt="Second slide">
                                </div>
                            </div>';
                                }
                                ?>
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                        <!--FIN CAROUSSEL-->
                    </div>
                    <!--invoca el mapa de google con la ubicación del lugar-->
                    <div>
                    <?php
                        if($DatosSitio["mapa"]!=null){
                            echo($DatosSitio["mapa"]);
                        }else{
                            echo '<span style="color: red;">no hay mapa de google</span>';
                        }
                    ?>
                    </div>
                </div>
                <!--muestra enlaces relacionados como cuadros con una imagen de fondo y texto sobrepuesto en cada item que envía al usuario a la dirección indicada-->
                
                <aside class="lateral">
                    <h3>Sigue explorando...</h3>
                    <div class="contenido-lateral">
                    <?php $sitio->fetchRecommendSide($DatosSitio["categoria"],$entrada)//desde funciones.php ?>
                    </div>
                </aside>
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
    <!--muestra información para complementar la búsqueda, por ejemplo, actividades u otro tipo de establecimientos-->
    <!--scripts necesarios para el funcionamiento de bootstrap-->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>
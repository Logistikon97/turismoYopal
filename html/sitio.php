<!DOCTYPE html>
<html lang="es">
<!--español-->
<?php
/**
 * Carga la información completa referente al sitio.
 */
include '../scripts/conexion.php';
include '../scripts/funciones.php';
        //instancia un objeto para usar sus métodos
        $sitio = new funciones();
        //obtiene el código del sitio
        $entrada = $_GET['siteName'];
        //realiza la consulta sobre los datos completos del lugar
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
        function atencion($arg){
            if(strtolower($arg) =='siempre abierto')
            {
                echo '<li><span class="indicador">Horario de atención: </span> <span style="color:green"> '. $arg.'</span> </li>';
            }else if($arg!=null && strtolower($arg) !='siempre abierto'){echo '<li><span class="indicador">Horario de atención:</span> '. $arg.' </li>';}
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
    <link rel="icon" type="image/png"  href="../assets/img/turismoYopal-logo-v.png">
    <title><?php echo $DatosSitio["nombre"]?></title>
</head>

<body>
    <header>
        <!-- la etiqueta nav gestionada con bootstrap 4.0 contiene los enlace para las secciones de la página web-->
        <?php $sitio =new funciones(); $sitio->navBar($DatosSitio["categoria"]) ?>
        <!--ajusta el mensaje de bienvenida en la portada-->
        <div class="contenedor-header_restaurante " style="background-image: url(<?php echo $sitio->imagen($DatosSitio['codigo'])?>)">

        </div>
    </header>
    <main>
        <!--limita el espacio en el que se distribuyen los elementos en la página, dándole márgenes en todo el contenido-->
        <div class="contenedor">
            <!--organiza el contenido en dos columnas de forma que en una se encuentre el contenido principal ("datos") y la otra ("lateral") es un sidebar con enlaces relacionados -->
            <div class="dos-columnas__hotel">
                <!--"datos" contiene toda la información relacionada al lugar. todo lo que sea necesario insertar está dentro de este contenedor-->
                <div class="datos">
                    <h2><?php echo $DatosSitio['nombre']; ?></h2>
                    <p><?php echo $DatosSitio['descripcion']; ?>
                    </p>

                    <!--"card-datos" es una tarjeta que contiene información sobre contacto: teléfono, correo, horarios de atención etc.-->
                    <div class="card-datos">
                        <!--organiza la información en listas y agrega íconos de vectores gráficos escalables (.svg)-->
                        <ul class="datos__lista">
                            <?php if($DatosSitio['direccion']!=null){echo '<li class="prueba"><span class="indicador"> Dirección: </span> '.$DatosSitio['direccion'].'</li>';}
                                    if($DatosSitio['telefono']!=null){echo '<li class="prueba"><span class="indicador">Teléfono: </span>'.$DatosSitio['telefono'].'</li>';}
                                    if($DatosSitio['celular']!=null){echo '<li><span class="indicador"> Celular: </span>'.$DatosSitio['celular'].'</li>';}
                                    if($DatosSitio['horarioAtencion']!=null){echo '';}
                            ?>
                            <li><?php atencion($DatosSitio['horarioAtencion']); ?></li>
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
                                /* imprime las imagens en el slider */
                                $img = $con->query('SELECT images.nombre_imagen AS "imagen" FROM `images` WHERE images.codigo_sitio_img ='.$entrada);
                                echo '<div class="carousel-item active">
                            <div class="carousel_img">
                                <img class="d-block w-100" src="../assets/img/desliza.jpg" alt="Second slide">
                            </div>
                        </div>';
                        $cont=0;
                        //verifica que contador sea mayor a 1 para que no muestre la primer imagen que corresponde a la portada
                                while ($row = $img->fetch(PDO::FETCH_ASSOC)) {
                                    if($cont>=1){
                                        echo '<div class="carousel-item">
                                <div class="carousel_img">
                                    <img class="d-block w-100" src="' . $row['imagen'] . '" alt="Second slide">
                                </div>
                            </div>';
                                    }$cont++;
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
                    //si hay mapa lo imprime, de lo contrario no lo hace
                        if($DatosSitio["mapa"]!=null){
                            echo('<h2 class="mt-4 mb-4">Como llegar</h2>'. $DatosSitio["mapa"]);
                        }else{
                            
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
    <?php $sitio->footer(); ?>
    <!--muestra información para complementar la búsqueda, por ejemplo, actividades u otro tipo de establecimientos-->
    <!--scripts necesarios para el funcionamiento de bootstrap-->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>
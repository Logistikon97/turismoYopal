<?php
//======================================================================
// FUNCIONES
//======================================================================

//-----------------------------------------------------
// Contiene Funciones Que Cumplen Diferentes Propósitos.
//-----------------------------------------------------
/*
 * Modifica el nombre de la carpeta en la que se encuentra
 * la imagen y escribe el nombre de la imagen en el documento
 */
class funciones

{
    //si el sitio tiene página web propia, se mostrará el botón para ir allá
    function url($dato)
    {
        if ($dato != null) {
            return '<a href="' . $dato . '" class="button button_2" target="_blank">Web Site</a><!-- 2.2 -->';
        }
    }
    /*
    * devuelve el nombre de la imagen relacionada a ese sitio, por defecto, 
    * la primer imagen que esté almacenada, será que salga de portada, 
    * es decir imagen1 siempre será la portada
*/
    function imagen($dato)
    {
        require('conexion.php');
        $consulta = 'SELECT images.nombre_imagen AS "imagen" FROM images WHERE images.codigo_sitio_img = ' . $dato;
        $stmt = $con->prepare($consulta);
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        return $resultado["imagen"];
    }

    function buscador()
    {
        require('conexion.php');
        //se saca el número de items que hay en la base de datos----------
        $NUM_ITEMS_BY_PAGE = 6;
        //recoje el dato de la variable de entrada
        @$entrada  = $_POST['search'];

        /* 
        * comprueba si el dato ingresado desde la caja de texto existe, de lo contrario, al no existir y seguir haciendo
        * referencia a ese dato, significa entonces que está usando los botones de paginación y ya que la consulta se hace 
        * en base a $entrada, entonces se iguala al valor que envía desde los botones de paginación. de este modo la consulta
        * se mantiene con la misma petición. De otro modo $entrada se hace null y la consulta simplemente arroja todo el 
        * contenido disponible
        */
        if (isset($entrada)) {
            //echo '<p style="color:green"> se presionó el botón</p>';
        } else {
            //echo '<p style="color:red"> no se presionó el botón</p>';
            @$entrada = $_GET["entrada"];
        }
        if ($entrada != null) {
           // echo '<p style="color:green"> Buscó "' . $entrada . '"</p>';
        } else {
            //echo '<p style="color:green"> Mostrando todo</p>';
            @$entrada = $_GET["entrada"];
        }
        //se hace la consulta a la base de datos  para recibir la cantidad de elementos que arroja la consulta
        //$consultar = "SELECT COUNT(*) AS 'total' FROM `turismo_yopal`.`sitio` WHERE (CONVERT(`nombre` USING utf8) LIKE '%" . $entrada . "%' OR CONVERT(`descripcion` USING utf8) LIKE '%" . $entrada . "%' OR CONVERT(`direccion` USING utf8) LIKE '%" . $entrada . "%' OR CONVERT(`telefono` USING utf8) LIKE '%" . $entrada . "%' OR CONVERT(`celular` USING utf8) LIKE '%" . $entrada . "%' OR CONVERT(`horarioAtencion` USING utf8) LIKE '%" . $entrada . "%' OR CONVERT(`redesSociales` USING utf8) LIKE '%" . $entrada . "%' OR CONVERT(`sitioWeb` USING utf8) LIKE '%" . $entrada . "%' OR CONVERT(`categoria` USING utf8) LIKE '%" . $entrada . "%')";
        $consultar = 'SELECT COUNT(*) AS "total" FROM `turismo_yopal`.`sitio` WHERE (CONVERT(`nombre` USING utf8) LIKE "%' . $entrada . '%" 
        OR CONVERT(`descripcion` USING utf8) LIKE "%' . $entrada . '%"
         OR CONVERT(`direccion` USING utf8) LIKE "%' . $entrada . '%" 
         OR CONVERT(`telefono` USING utf8) LIKE "%' . $entrada . '%" 
         OR CONVERT(`celular` USING utf8) LIKE "%' . $entrada . '%" 
         OR CONVERT(`horarioAtencion` USING utf8) LIKE "%' . $entrada . '%" 
         OR CONVERT(`sitioWeb` USING utf8) LIKE "%' . $entrada . '%" 
         OR CONVERT(`categoria` USING utf8) LIKE "%' . $entrada . '%")';
        $stmt = $con->query($consultar);
        //$numItem almacena el número de elementos
        $numItem = $stmt->fetch(PDO::FETCH_ASSOC);
        //-----------------------------------------------------------------
        //debe tener uno o más datos para mostrar paginación
        if ($numItem > 0) {
            $page = false;
            //examina la pagina a mostrar y el inicio del registro a mostrar
            if (isset($_GET["page"])) {
                $page = $_GET["page"];
            }
            if (!$page) {
                $start = 0;
                $page = 1;
            } else {
                $start = ($page - 1) * $NUM_ITEMS_BY_PAGE;
            }
            //calculo el total de paginas
            $total_pages = ceil($numItem["total"] / $NUM_ITEMS_BY_PAGE);

            //se hace la consulta a la BD usando LIMIT de forma que muestra la cantidad de items indicado por $NUM_ITEMS_BY_PAGE
            $consulta = 'SELECT * FROM `turismo_yopal`.`sitio` WHERE (CONVERT(`nombre` USING utf8) LIKE "%' . $entrada . '%" 
            OR CONVERT(`descripcion` USING utf8) LIKE "%' . $entrada . '%"
             OR CONVERT(`direccion` USING utf8) LIKE "%' . $entrada . '%" 
             OR CONVERT(`telefono` USING utf8) LIKE "%' . $entrada . '%" 
             OR CONVERT(`celular` USING utf8) LIKE "%' . $entrada . '%" 
             OR CONVERT(`horarioAtencion` USING utf8) LIKE "%' . $entrada . '%" 
             OR CONVERT(`sitioWeb` USING utf8) LIKE "%' . $entrada . '%" 
             OR CONVERT(`categoria` USING utf8) LIKE "%' . $entrada . '%") LIMIT ' . $start . ',' . $NUM_ITEMS_BY_PAGE;
            //realiza la consulta y empieza a ordenar los resultados y a escribirlos en el documento

            echo '<ul class="row items " style="margin-right:15px">';
            if($this->consulta($consulta)==null){
                echo '<span style="color:red" >no se encontró nada</span>'; 
            }
            foreach ($this->consulta($consulta) as $row) {
                echo '<div class="item ">
                            <div class="item__img resultado__img">
                                <a href="sitio?siteName=' . $row['codigo'] . '"><img class ="img-rounded" src="' . $this->imagen($row["codigo"]) .'" alt="no se ha podido cargar la imagen" srcset="" title="clic aquí para saber más"></a>
                            </div>
                             <div class="item__info">
                                <h3>' . $row["nombre"] . '</h3><h4>' . $row["direccion"] . '</h4><p>' . substr($row["descripcion"], 0, 120) . '....</p><a href="sitio?siteName=' . $row['codigo'] . '" class="button ">Más información</a><!-- 2.1 -->
                            </div>
                        </div>';
            }
            echo '</ul>';
            echo '<nav>';
            echo '<ul class="pagination">';
            //Organiza los índices del paginador
            if ($total_pages > 1) {
                if ($page != 1) {
                    echo '<li class="page-item"><a class="page-link" href="buscador?page=' . ($page - 1) . '&entrada=' . $entrada . '"><span aria-hidden="true">&laquo;</span></a></li>';
                }
                //mustra todos los indices necesarios
                for ($i = 1; $i <= $total_pages; $i++) {
                    if ($page == $i) {
                        echo '<li class="page-item active"><a class="page-link" href="#">' . $page . '</a></li>';
                    } else {
                        echo '<li class="page-item"><a title="esta es" class="page-link" href="buscador?page=' . $i . '&entrada=' . $entrada . '">' . $i . '</a></li>';
                    }
                }

                if ($page != $total_pages) {
                    echo '<li class="page-item"><a class="page-link" href="buscador?page=' . ($page + 1) . '&entrada=' . $entrada . '"><span aria-hidden="true">&raquo;</span></a></li>';
                }
            }
            echo '</ul>';
            echo '</nav>';
        }
    }
    /**
     * carga 3 sitios recomendados de forma aleatoria que tengan que ver con el mismo tipo de sitio
     */
    function fetchRecommendSide($categoria, $codigo)
    {
        require('../scripts/conexion.php');
        $consulta = 'SELECT * FROM `sitio` WHERE categoria="' . $categoria . '"  AND `sitio`.`codigo`!="' . $codigo . '"  ORDER BY rand() LIMIT 4';
        foreach ($this->consulta($consulta) as $row) {
            echo '<div class="card border-0"> 
                    <div style=" overflow: hidden;" >
                    <img class="card-img-top" style=" border-radius: 5px; " src="' . $this->imagen($row["codigo"]) . '" alt="no se puede cargar">
                    </div>
    <div class="card_body">
        <h5 class="card-title">' . $row["nombre"] . '</h5>
        <a href="sitio.php?siteName=' . $row["codigo"] . '" class="btn btn-primary">Clic para ir</a>
    </div>
    </div>';
            //echo '<p>'. var_dump($row).'</p>';
        }
    }

    /**
     * hace una consulta y devuelve un vector, de preferencia usarlo cuando se sabe que hay pocos resultados
     */
    function consulta($consulta)
    {
        include '../scripts/conexion.php';
        $stmt = $con->prepare($consulta);
        $stmt->execute();
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }

    /* imprime la barra de navegación superior dependiendo de en que sección se encuentre */
    function navBar($ubicacion)
    {
        switch ($ubicacion) {
                //los nombres de carpeta deben coincidir en los archivos del proyecto
            case 'hotel':
                echo '<nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="../index"><img src="../assets/img/turismoYopal-logo.png" width="180"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="dondeAlojarse?name=hotel">¿Dónde alojarse?<span
                                class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="dondeComer?name=restaurante">¿Dónde comer?</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="dondeComprar?name=comercio">¿Dónde comprar?</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="turismoHistorico?name=historia">Turismo histórico</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="eventos?name=evento">Eventos</a>
                    </li>
                    <li class="nav-item">
                                    <a class="nav-link" href="afuera?name=afuera">Actividades al aire libre</a>
                            </li>
                </ul>
            </div>
        </nav>';
                break;
            case 'historia':
                echo '<nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="../index"><img src="../assets/img/turismoYopal-logo.png" width="180"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="turismoHistorico?name=historia">Turismo Histórico<span
                                class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="dondeAlojarse?name=hotel">¿Dónde alojarse?</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="dondeComer?name=restaurante">¿Dónde comer?</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="dondeComprar?name=comercio">¿Dónde comprar?</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="eventos?name=evento">Eventos</a>
                    </li>
                    <li class="nav-item">
                                    <a class="nav-link" href="afuera?name=afuera">Actividades al aire libre</a>
                            </li>
                </ul>
            </div>
        </nav>';
                break;
            case 'recreacional':
                echo '<nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="../index"><img src="../assets/img/turismoYopal-logo.png" width="180"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="dondeAlojarse?name=hotel">¿Dónde alojarse?</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="dondeComer?name=restaurante">¿Dónde comer?</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="dondeComprar?name=comercio">¿Dónde comprar?</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="turismoHistorico?name=historia">Turismo Histórico<span
                                    class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="eventos?name=evento">Eventos</a>
                        </li>
                        <li class="nav-item">
                                    <a class="nav-link" href="afuera?name=afuera">Actividades al aire libre</a>
                            </li>
                    </ul>
                </div>
            </nav>';
                break;
            case 'restaurante':
                $color = '';
                echo '<nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="../index"><img src="../assets/img/turismoYopal-logo.png" width="180"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link active " href="dondeComer?name=restaurante">¿Dónde comer?<span
                                class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="dondeAlojarse?name=hotel"' . $color . '>¿Dónde alojarse?</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="dondeComprar?name=comercio"' . $color . '>¿Dónde comprar?</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="turismoHistorico?name=historia"' . $color . '>Turismo Histórico</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="eventos?name=evento"' . $color . '>Eventos</a>
                    </li>
                    <li class="nav-item">
                                    <a class="nav-link" href="afuera?name=afuera">Actividades al aire libre</a>
                            </li>
                </ul>
            </div>
        </nav>';
                break;
            case 'inicio':
                echo ' <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="index"><img src="assets/img/turismoYopal-logo.png" width="180"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="true" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link active" href="html/dondeComprar?name=comercio">¿Dónde Comprar? <span
                                    class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="html/dondeComer?name=restaurante">¿Dónde Comer?</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="html/dondeAlojarse?name=hotel">¿Dónde Alojarse?</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="html/turismoHistorico?name=historia">Turismo Histórico</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="html/eventos">Eventos</a>
                        </li>
                        <li class="nav-item">
                                    <a class="nav-link" href="afuera?name=afuera">Actividades al aire libre</a>
                            </li>
                    </ul>
                </div>
            </div>
        </nav>';
                break;
            case 'comercio':
                echo ' <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="../index"><img src="../assets/img/turismoYopal-logo.png" width="180"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="true" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link active" href="dondeComprar?name=comercio">¿Dónde Comprar? <span
                                    class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="dondeComer?name=restaurante">¿Dónde Comer?</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="dondeAlojarse?name=hotel">¿Dónde Alojarse?</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="turismoHistorico?name=historia">Turismo Histórico</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="eventos?name=evento">Eventos</a>
                        </li>
                        <li class="nav-item">
                                    <a class="nav-link" href="afuera?name=afuera">Actividades al aire libre</a>
                            </li>
                    </ul>
                </div>
            </div>
        </nav>';
                break;
            case 'evento':
                echo ' <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <a class="navbar-brand" href="../index"><img src="../assets/img/turismoYopal-logo.png" width="180"></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="true" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <a class="nav-link active" href="eventos?name=evento">Eventos<span
                                        class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="dondeComer?name=restaurante">¿Dónde Comer?</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="dondeAlojarse?name=hotel">¿Dónde Alojarse?</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="dondeComprar?name=comercio">¿Dónde Comprar?</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="turismoHistorico?name=historia">Turismo Histórico</a>
                            </li>
                            <li class="nav-item">
                                    <a class="nav-link" href="afuera?name=afuera">Actividades al aire libre</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>';
                break;
                case 'afuera':
                    echo ' <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="../index"><img src="../assets/img/turismoYopal-logo.png" width="180"></a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="true" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ml-auto">
                                <li class="nav-item">
                                    <a class="nav-link active" href="afuera?name=afuera">Actividades al aire libre<span
                                            class="sr-only">(current)</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="dondeComer?name=restaurante">¿Dónde Comer?</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="dondeAlojarse?name=hotel">¿Dónde Alojarse?</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="dondeComprar?name=comercio">¿Dónde Comprar?</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="turismoHistorico?name=historia">Turismo Histórico</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="eventos?name=evento">Eventos</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>';
                    break;
        }
    }
    function footer(){
        echo '<footer class="footanari">
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
    </footer>';
    }
}

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
            echo '<p style="color:green"> se presionó el botón</p>';
        } else {
            echo '<p style="color:red"> no se presionó el botón</p>';
            @$entrada = $_GET["entrada"];
        }
        if ($entrada != null) {
            echo '<p style="color:green"> Buscó "' . $entrada . '"</p>';
        } else {
            echo '<p style="color:green"> Mostrando todo</p>';
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
        var_dump($numItem);
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
                        <a class="nav-link" href="#">¿Qué hacer en Yopal?</a>
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
                        <a class="nav-link active" href="turismoHistorico">Turismo Histórico<span
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
                        <a class="nav-link" href="#">¿Qué hacer en Yopal?</a>
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
                            <a class="nav-link" href="turismoHistorico">Turismo Histórico<span
                                    class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="eventos?name=evento">Eventos</a>
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
                        <a class="nav-link" href="turismoHistorico"' . $color . '>Turismo Histórico</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="eventos?name=evento"' . $color . '>Eventos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"' . $color . '>¿Qué hacer en Yopal?</a>
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
                            <a class="nav-link" href="html/turismoHistorico">Turismo Histórico</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="html/eventos">Eventos</a>
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
                            <a class="nav-link" href="turismoHistorico">Turismo Histórico</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="eventos?name=evento">Eventos</a>
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
                                <a class="nav-link" href="turismoHistorico">Turismo Histórico</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">¿Qué hacer en Yopal?</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>';
                break;
        }
    }
}

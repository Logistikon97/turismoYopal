<?php
require('conexion.php');
/**
 * Consulta toda la información sobre los sitios y los ajusta de 6 en 6 mostrándolos en lista con paginación
 * @param type $dato String con la categoría para cargar todos los sitios de este tipo
 * @param type $nombrePagina String con el nombre de la página en la que se encuentra con el fin de no perder
 * el hilo de los datos que se muestran al cambiar de página con el paginador
 * @return void imprime todos los sitios de esta categoría.
 */
function fetch_sites_list ($dato,$nombrePagina)
{
    $cargardor =new funciones();
    require('conexion.php');
    //número de items por página
    $NUM_ITEMS_BY_PAGE = 6;
    if(isset($dato)){
    }else{
        @$dato=$_GET["dato"];
    }
    if($dato != null){
    }else{
        @$dato=$_GET["dato"];
    }
    //se saca el número de items que hay en la base de datos----------
    $consulta = 'SELECT COUNT(*) as "total" FROM sitio WHERE sitio.categoria ="' . $dato . '"';
    $stmt = $con->query($consulta);
    $numItem = $stmt->fetch(PDO::FETCH_ASSOC);
    //-----------------------------------------------------------------
    if ($numItem > 0) {
        $page = false;
        //examino la pagina a mostrar y el inicio del registro a mostrar
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
        
        //Se hace la consulta para traer todos los elementos y se empieza a recorren en bucle todos los datos para mostrarlos en la lista
        $result = $con->query('SELECT * FROM `sitio` WHERE sitio.categoria ="' . $dato . '" LIMIT ' . $start . ',' . $NUM_ITEMS_BY_PAGE);
        echo '<ul class="row items " style="margin-right:15px">';
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo '<div class="item ">
        <div class="item__img resultado__img"><a href="sitio?siteName='.$row['codigo'].'"><img class ="img-rounded" src="'. $cargardor->imagen($row["codigo"])/*desde funciones.php */.'" alt="no se puede cargar o no hay imagen disponible" srcset=""
                    title="más información"></a>
        </div>
        <div class="item__info">
            <h3>' . $row["nombre"] . '</h3>
            <h4>' . $row["direccion"] . '</h4>
            <p>' . substr($row["descripcion"], 0, 120) . '...</p>
            <a href="sitio?siteName='.$row['codigo'].'" class="button ">Más información</a><!-- 2.1 -->
            ' . $cargardor->url($row["sitioWeb"]) . '
        </div>
    </div>';
        }
        echo '</ul>';
        echo '<nav>';
        echo '<ul class="pagination">';
        //Organiza los índices del paginador
        if ($total_pages > 1) {
            if ($page != 1) {
                echo '<li class="page-item"><a class="page-link" href="'.$nombrePagina.'.php?page=' . ($page - 1) . '&dato='.$dato.'"><span aria-hidden="true">&laquo;</span></a></li>';
            }
            //mustra todos los indices necesarios
            for ($i = 1; $i <= $total_pages; $i++) {
                if ($page == $i) {
                    echo '<li class="page-item active"><a class="page-link" href="#">' . $page . '</a></li>';
                } else {
                    echo '<li class="page-item"><a class="page-link" href="'.$nombrePagina.'.php?page=' . $i . '&dato='.$dato.'">' . $i . '</a></li>';
                }
            }
            if ($page != $total_pages) {
                echo '<li class="page-item"><a class="page-link" href="'.$nombrePagina.'.php?page=' . ($page + 1) . '&dato='.$dato.'"><span aria-hidden="true">&raquo;</span></a></li>';
            }
        }
        echo '</ul>';
        echo '</nav>'; 
    }
}
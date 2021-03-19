<?php
require('conexion.php');
//consulta toda la información sobre los sitios y los ajusta de 6 en 6 mostrándolos en lista con paginación
function fetch_sites_list ($dato,$nombrePagina)
{
    $cargardor =new funciones();
    require('conexion.php');
    //número de items por página
    $NUM_ITEMS_BY_PAGE = 6;
    // asegura el dato de categoría, es decir, en qué sección se encuentra
    if(isset($dato)){
        echo '<p style="color:green"> se presionó el botón</p>';
    }else{
        echo '<p style="color:red"> no se presionó el botón</p>';
        @$dato=$_GET["dato"];
    }
    if($dato != null){
        echo '<p style="color:green"> Buscó "'.$dato.'"</p>';
    }else{
        echo '<p style="color:green"> Mostrando todo</p>';
        @$dato=$_GET["dato"];
    }
    //se saca el número de items que hay en la base de datos----------
    $consulta = 'SELECT COUNT(*) as "total" FROM sitio WHERE sitio.categoria ="' . $dato . '"';
    $stmt = $con->query($consulta);
    $numItem = $stmt->fetch(PDO::FETCH_ASSOC);
    echo '<p style="color:yellow; background-color:red">verificar si funcionan bien los botones de paginación</p>';
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
        /*
        pongo el número de registros total, el tamaño de página y la página que se muestra
        echo '<h3>Numero de articulos: '.$numItem["total"].'</h3>';
        echo '<h3>Mostrando la pagina '.$page.' de ' .$total_pages.' paginas.</h3>'; */

        //Se hace la consulta para traer todos los elementos y se empieza a recorren en bucle todos los datos para mostrarlos en la lista
        $result = $con->query('SELECT * FROM `sitio` WHERE sitio.categoria ="' . $dato . '" LIMIT ' . $start . ',' . $NUM_ITEMS_BY_PAGE);
        echo '<ul class="row items " style="margin-right:15px">';
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo '<div class="item ">
        <div class="item__img resultado__img"><a href="sitio?siteName='.$row['codigo'].'"><img class ="img-rounded" src="'. $cargardor->imagen($row["codigo"])/*desde funciones.php */.'" alt="nada" srcset=""
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
<?php
require('conexion.php');
//consulta toda la información sobre los eventos y los ajusta de 6 en 6 mostrándolos en lista con paginación
function CargarEventos()
{
    require('conexion.php');
    //se saca el número de items que hay en la base de datos----------
    $NUM_ITEMS_BY_PAGE = 9;
    $consulta = 'SELECT COUNT(*) as "total" FROM `sitio` WHERE `sitio`.`categoria` ="evento"';
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
        $result = $con->query('SELECT * FROM `sitio`  WHERE `sitio`.`categoria` ="evento" LIMIT ' . $start . ',' . $NUM_ITEMS_BY_PAGE);
        echo '<ul class="row items " style="margin-right:20px">';
        echo '<div class="eventos__grid_main">';
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo '<div class="contenedor-evento_item" style="background-image: url(../assets/img/eventos/'.imagenEvento($row['codigo']).'.jpg);">
            <a href="#"  style="text-decoration: none;"><div class="item-evento">
                <h4>' . $row['nombre'] . '</h4>
            </div></a>
        </div>';
        }echo '</div>';
        echo '</ul>';
        echo '<nav>';
        echo '<ul class="pagination">';
        //Organiza los índices del paginador
        if ($total_pages > 1) {
            if ($page != 1) {
                echo '<li class="page-item"><a class="page-link" href="eventos?page=' . ($page - 1) .'"><span aria-hidden="true">&laquo;</span></a></li>';
            }
            //mustra todos los indices necesarios
            for ($i = 1; $i <= $total_pages; $i++) {
                if ($page == $i) {
                    echo '<li class="page-item active"><a class="page-link" href="#">' . $page . '</a></li>';
                } else {
                    echo '<li class="page-item"><a title="esta es" class="page-link" href="eventos?page=' . $i .'">' . $i . '</a></li>';
                }
            }

            if ($page != $total_pages) {
                echo '<li class="page-item"><a class="page-link" href="eventos?page=' . ($page + 1). '"><span aria-hidden="true">&raquo;</span></a></li>';
            }
        }
        echo '</ul>';
        echo '</nav>';
    }
}

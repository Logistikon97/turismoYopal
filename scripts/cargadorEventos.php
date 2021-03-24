<?php
/**
 * Consulta toda la información sobre los eventos y los ajusta de 6 en 6 mostrándolos en lista con paginación.
 * Diferencia de cargador.php en cómo se muestra la información y también en cómo la consulta
 * @return void imprime los eventos encontrados.
 */
function CargarEventos()
{
    require('conexion.php');
    $NUM_ITEMS_BY_PAGE = 9;
    $consulta = 'SELECT COUNT(*) as "total" FROM `sitio` WHERE `sitio`.`categoria` ="evento"';
    $stmt = $con->query($consulta);
    //se saca el número de items que hay en la base de datos
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
        $result = $con->query('SELECT * FROM `sitio`  WHERE `sitio`.`categoria` ="evento" LIMIT ' . $start . ',' . $NUM_ITEMS_BY_PAGE);
        echo '<ul class="row items " style="margin-right:20px">';
        echo '<div class="eventos__grid_main">';
        //instancia un objeto de funciones() para usar el método imagen() y traer las imágenes.
        $fecthEvent = new funciones();
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo '<div class="contenedor-evento_item" style="background-image: url('.$fecthEvent->imagen($row['codigo']).');">
            <a href="sitio?siteName='.$row["codigo"].'"  style="text-decoration: none;"><div class="item-evento">
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

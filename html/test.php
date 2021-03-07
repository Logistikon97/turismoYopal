<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <input type="text" name="search" id="search">
        <input type="submit" value="Buscar" class="button-search">
    </form>
    <?php
    /*include '../scripts/conexion.php';
    $consulta='SELECT sitio.nombre, sitio.descripcion, sitio.direccion FROM `sitio`';
    $stmt = $con->prepare($consulta);
    $stmt->execute();
    $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);*/
    $consultaSitio = 'SELECT sitio.nombre as "nombre", sitio.descripcion as "descripcion", sitio.direccion as "direccion" FROM `sitio`';
    $consultaEvento = 'SELECT eventos.nombreEvento as "nombre", eventos.descripcionEvento as "descripcion", eventos.direccion as "direccion" FROM `eventos`';
    $resultado = array_merge(consulta($consultaSitio), consulta($consultaEvento));
    $cont = 0;

    //strpos($cadena_de_texto, $cadena_buscada);
    /**
     *         if(array_search($clave,$row,false)){
     *       echo '<span style="color: green;  background-color:red;">ENCONTRADO: </span>';
     *  }else{
     *       echo '<span style="color: RED;  background-color:YELLOW;">NO ENCONTRADO: </span>';
     *  }
     */
    $match = false;
    $match2 = false;
    $match3 = false;
    $clave = $_POST['search'];
    foreach ($resultado as $row) {
        $cont++;
        if (strpos(strtolower($row['nombre']), $clave)) {
            //echo '<span style="color: green; background-color:yellow;">ENCONTRADO: </span>';
            $match = true;
        } else {
            $match = false;
        }
        if (strpos(strtolower($row['descripcion']), $clave)) {
            //echo '<span style="color: green; background-color:yellow;">ENCONTRADO: </span>';
            $match2 = true;
        } else {
            $match2 = false;
        }
        if (strpos(strtolower($row['direccion']), $clave)) {
            //echo '<span style="color: green; background-color:yellow;">ENCONTRADO: </span>';
            $match3 = true;
        } else {
            $match3 = false;
        }
        if ($match or $match2 or $match3) {
            echo '<span style="color: yellow; background-color:green;">ENCONTRADO: </span>';
            echo var_dump($row) . '<br><br>';
        } else {
            echo '<span style="color: yellow; background-color:red;">NO ENCONTRADO: </span>';
            echo var_dump($row) . '<br><br>';
        }
    }
    echo '<p style="color: green; background-color:blue; width:15px">' . $cont . '</p>';



    function consulta($consulta)
    {
        include '../scripts/conexion.php';
        $stmt = $con->prepare($consulta);
        $stmt->execute();
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }
    ?>
</body>

</html>
<?php
include '../scripts/conexion.php';
include '../scripts/funciones.php';

$obj = new funciones();

$consulta = 'SELECT * FROM `images` ORDER BY nombre_imagen';
foreach ($obj->consulta($consulta) as $row) {
    echo '<span> UPDATE `images` SET `nombre_imagen` = "</span></br>';
}
foreach ($obj->consulta($consulta) as $row) {
echo '" WHERE images.nombre_imagen = "'.$row["nombre_imagen"].'";</span></br>';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <img src="https://i.imgur.com/4kAh6KS.jpg
" alt="">
</body>

</html>
<?php
include 'test.php';
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
    <?php
    $codigo= '30';

    $prueba =new funciones();
    echo ' <img src="../../assets/img/'.$prueba -> dirImg('recreacional',$codigo).'.jpg" alt="">';
    echo $prueba ->url($codigo);
    ?>
</body>
</html>
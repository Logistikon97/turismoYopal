<?php
$database ="turismo_yopal";
$user = "root";
$password = "";
try{
    $con= new PDO('mysql:host=localhost;dbname='.$database,$user,$password);
    //echo "<p style='color:green'>base de datos en línea</p>";
}
catch(PDOException $e){
    echo "Error no se ha conectado";
}
?>
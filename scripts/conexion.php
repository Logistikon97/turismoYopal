<?php
/**
 * Contiene los datos de inicio de sesión en la base de datos y se conecta.
 */
$database ="u125286094_turismo_yopal";
$user = "u125286094_logistikon";
$password = "tur1sm0Y0p4l";
try{
    $con= new PDO('mysql:host=localhost;dbname='.$database,$user,$password);
    //echo "<p style='color:green'>base de datos en línea</p>";
}
catch(PDOException $e){
    echo "Error no se ha conectado";
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@500&display=swap" rel="stylesheet">
    <!--<link rel="stylesheet" href="css/normalize.css"> -->
    <link rel="stylesheet" href="../css/style.css">
    <title>Buscador</title>
</head>

<body>
    <header>
        <!--BARRA DE NAVEGACIÓN SUPERIOR-->
        <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #1d3557">
            <div class="container-fluid">
            <a class="navbar-brand" href="../index"><img src="../assets/img/turismoYopal-logo.png" width="180"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="true" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="turismoHistorico?name=historia" style="color: white;">Turismo histórico</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="dondeComprar?name=comercio" style="color: white;">¿Dónde comprar? <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="dondeComer?name=restaurante" style="color: white;">¿Dónde comer?</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="dondeAlojarse?name=hotel" style="color: white;">¿Dónde alojarse?</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="eventos?name=evento" style="color: white;">Eventos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="#" style="color: white;">buscar</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!--FIN BARRA DE NAVEGACIÓN SUPERIOR-->
        <!--titulo de la página en el body -->
        <div class="contenido-header-buscador">
            <h1>Buscar</h1>
        </div>
    </header>
    <!---->
    <!-- formulario que contiene el input de tipo texto  donde se ingresará la búsqueda, esta consulta se realiza desde el mismo archivo-->
    <div class="contenedor-form">
        <div class="form-buscar">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <input type="text" name="search" pattern="[^'\x22]+" required placeholder="Busca aquí">
                <input type="submit" value="Buscar" class="button-search" name="boton">
            </form>
        </div>
    </div>
    <!-- contenedor de los resultados de búsqueda -->
    <div class="contenedor-resultado">
        <?php
        //invoca la función creada en funciones.php
        include '../scripts/funciones.php';
        $buscador=new funciones();
        $buscador->buscador();//desde funciones.php
        ?>
        <div class="no-result">
        <h3>No se encontraron resultados</h3>
        <p>No se encontró o aún no existe, prueba escribiendo de diferente forma o escríbenos a<a href="mailto:contacto@turismoyopal.xyz">contacto@turismoyopal.xyz</a> para agregarlo si sabes que existe.</p>
        </div>
    </div>
    <?php $buscador->footer(); ?>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
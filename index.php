<?php

require("config/config.php");

?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Recetario PHP</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, user-scalable=no">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
</head>

<body class="bg-dark text-light">

    <div class="container">
        <div class="row mt-2 mb-2 text-center">
            <div class="col">
                <p class="h4 mt-2 mb-2">Listado de Recetas</p>

                <?php

                    // Para generar la lista de recetas y así ver todas las existentes

                    $nombreCarpeta = ("recetas");

                    $escaneoRecetas = scandir($nombreCarpeta);

                    $chauPuntitos = array_diff($escaneoRecetas, array('..', '.'));

                    $romper = implode("_", $chauPuntitos);

                    foreach($chauPuntitos as $displayRecetas):

                    $limpiame = str_replace([".php",".html","entrada","plato principal","snack","postre","pasteleria","bebidas","novegano","vegano"],"",$displayRecetas);
                    $limpiate = str_replace("_"," ",$limpiame);
                    $limpiezamundial = ucfirst($limpiate);

                    ?>

                <a href="recetas/<?= $displayRecetas; ?>" class="btn btn-warning border"><?= $limpiezamundial; ?></a>

                <?php      

                    endforeach;

                    ?>

            </div>
        </div>
    </div>

    <hr>

    <div class="container text-center">
        <div class="row">
            <div class="col">

                <p class="h3">¿Qué buscas hacer?</p>
                <button class="btn btn-link bg-info text-dark" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                    Buscar receta
                </button>

                <button class="btn btn-link bg-info text-dark" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    Crear receta
                </button>

            </div>
        </div>
    </div>


    <div id="accordion">
        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
            <div class="container mt-2">
                <div class="row">
                    <div class="col">
                        <p class="h4 text-center">¡Filtrá las recetas que ya tenés!</p>
                        <form action="acciones/busqueda.php" method="post" enctype="multipart/form-data" class="m-3 border rounded p-2 bg-dark">
                            <div class="form-group">
                                <label class="h5" for="tipoplato">¿Qué tipo de plato(s) cumple?</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="busqueda[]" id="entradaquery" value="Entrada">
                                    <label class="form-check-label" for="entradaquery">Entrada</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="busqueda[]" id="platoprincipalquery" value="Plato principal">
                                    <label class="form-check-label" for="platoprincipalquery">Plato principal</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="busqueda[]" id="snackquery" value="Snack">
                                    <label class="form-check-label" for="snackquery">Snack</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="busqueda[]" id="postrequery" value="Postre">
                                    <label class="form-check-label" for="postrequery">Postre</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="busqueda[]" id="pasteleriaquery" value="Pasteleria">
                                    <label class="form-check-label" for="pasteleriaquery">Pasteleria</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="busqueda[]" id="bebidasquery" value="Bebidas">
                                    <label class="form-check-label" for="bebidasquery">Bebidas</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="h5" for="tipodieta">¿Qué tipo de dieta cumple?</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="busqueda[]" id="vegetarianoquery" value="vegetariano">
                                    <label class="form-check-label" for="vegetarianoquery">Vegetariano</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="busqueda[]" id="noveganoquery" value="No vegano">
                                    <label class="form-check-label" for="noveganoquery">No vegano</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="busqueda[]" id="veganoquery" value="Vegano">
                                    <label class="form-check-label" for="veganoquery">Vegano</label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Buscar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
            <div class="container mt-2">
                <div class="row">
                    <div class="col">
                        <p class="h2 text-center">Para agregar tu receta al listado rellena el formulario de acá abajo:</p>

                        <form action="php/procesar_receta.php" method="post" enctype="multipart/form-data" class="m-3 border rounded p-2 bg-dark">
                            <div class="form-group">
                                <label class="h5" for="nombre">Nombre</label>
                                <input type="text" class="form-control col-md-4" name="nombre" id="nombre" placeholder="Ej: 'Empanadas de JyQ'">
                                <small>¡No hace falta especificar el tipo de plato o dieta en el nombre!</small>
                            </div>
                            <div class="form-group">
                                <label class="h5" for="tipoplato">¿Qué tipo de plato(s) cumple?</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="tipoplato[]" id="entrada" value="Entrada">
                                    <label class="form-check-label" for="entrada">Entrada</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="tipoplato[]" id="platoprincipal" value="Plato principal">
                                    <label class="form-check-label" for="platoprincipal">Plato principal</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="tipoplato[]" id="snack" value="Snack">
                                    <label class="form-check-label" for="snack">Snack</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="tipoplato[]" id="postre" value="Postre">
                                    <label class="form-check-label" for="postre">Postre</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="tipoplato[]" id="pasteleria" value="Pasteleria">
                                    <label class="form-check-label" for="pasteleria">Pasteleria</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="tipoplato[]" id="bebidas" value="Bebidas">
                                    <label class="form-check-label" for="bebidas">Bebidas</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="h5" for="tipodieta">¿Qué tipo de dieta cumple?</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="tipodieta[]" id="vegetariano" value="vegetariano">
                                    <label class="form-check-label" for="Vegetariano">Vegetariano</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="tipodieta[]" id="novegano" value="novegano">
                                    <label class="form-check-label" for="No vegano">No vegano</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="tipodieta[]" id="vegano" value="vegano">
                                    <label class="form-check-label" for="Vegano">Vegano</label>
                                </div>
                            </div>
                            <!-- <div class="form-group">
                        <label class="h5" for="imagen">Imagen para acompañar</label>
                        <input type="file" class="form-control-file" name="imagen[]" id="imagen">
                    </div> -->
                            <div class="form-group">
                                <label class="h5" for="descripcion">Descripción</label>
                                <textarea class="form-control" name="descripcion" id="descripcion" rows="2" placeholder="La descripción de tu receta..."></textarea>
                            </div>
                            <div class="form-group">
                                <label class="h5" for="ingredientes">Ingredientes</label>
                                <textarea class="form-control" name="ingredientes" id="ingredientes" rows="3" placeholder="¿Qué ingredientes se necesitan?"></textarea>
                            </div>
                            <div class="form-group">
                                <label class="h5" for="recetoide">Receta</label>
                                <textarea class="form-control" name="receta" id="receta" rows="6" placeholder="¿Cómo se debe hacer? ¡Deja una linea de espacio entre cada paso!"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Crear receta</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--     
    pagina privada de recetas. solamente uso propio, no publico.

    index contiene formulario con lo siguiente para rellenar

    titulo o nombre:()
    categoria:(
    "Tipo de plato" [Entrada, Plato principal, Snack, Postre, Pasteleria, Bebidas]
    "Tipo de dieta" [Vegano, No vegano, ])
    imagen:()
    descripcion:()
    ingredientes:()
    pasos a seguir:()

     -->

    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
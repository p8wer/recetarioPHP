<?php

require("../config/config.php");

echo "<pre>";
print_r($_POST);
echo "</pre>";

$nombrePost = $_POST["nombre"];
$limpiezaNombre = trim(preg_replace("/\s+/", " ", $nombrePost));
$underscoreNombre = str_replace(" ", "_", $limpiezaNombre);
$nombreFinal = strtolower($underscoreNombre);

$platoPost = $_POST["tipoplato"];
$explotarPlato = implode("_", $platoPost);
$underscorePlato = str_replace(" ", "_", $explotarPlato);
$platoFinal = strtolower($underscorePlato);

$dietaPost = $_POST["tipodieta"];
$explotarDieta = implode("", $dietaPost);
$dietaFinal = strtolower($explotarDieta);

$descripcionPost = $_POST["descripcion"];
$limpiezaDescripcion = nl2br(trim(str_replace('  ', ' ', $descripcionPost)));
    
$ingredientesPost = $_POST["ingredientes"];
$limpiezaIngredientes = nl2br(trim(str_replace('  ', ' ', $ingredientesPost)));

$recetaPost = $_POST["receta"];
$limpiezaReceta = nl2br(trim(str_replace('  ', ' ', $recetaPost)));

$nombreCaminoArchivo = ("../recetas/{$nombreFinal}_{$platoFinal}_{$dietaFinal}.html");

$crearArchivo = fopen($nombreCaminoArchivo,"w");

//Parseos extras para lo que si va en el .htlm y se vea lindo

$nombreHtml = ucfirst($nombreFinal);
$nombreHtml2 = str_replace("_"," ",$nombreHtml);

$platoHtml = ucwords($explotarPlato);
$platoHtml2 = str_replace("_",", ",$platoHtml);

$dietaHtml = ucfirst($explotarDieta);
$dietaHtml2 = str_replace("_"," ",$dietaHtml);
$dietaHtml3 = str_replace("Novegano", "No vegano", $dietaHtml2);

// Básicamente el contenido que se va a poner en la página creada

$contenidoFinal = "

<!DOCTYPE html>
<html lang='es'>
<head>
    <meta charset='UTF-8'>
    <title>$nombreHtml2</title>
    <link rel='stylesheet' href='../css/bootstrap.min.css' crossorigin='anonymous'>
    <meta name='viewport' content='width=device-width, user-scalable=no'>
    <link rel='shortcut icon' href='../favicon.ico' type='image/x-icon'>
    <link rel='icon' href='../favicon.ico' type='image/x-icon'>
</head>
<body class='bg-dark text-light'>

    <div class='container mt-3'>
        <div class='row'>
            <div class='col'>
                <h1 class='text-center'>$nombreHtml2</h1>

                <p>
                Tipo(s) de plato: <b>$platoHtml2</b>
                <br>
                Tipo de dieta: <b>$dietaHtml3</b>
                </p>

                <p class='h3'>Descripción:</p>
                <p class='my-3 mx-1 bg-secondary border p-1'>
                    $limpiezaDescripcion
                </p>


                <p class='h3'>Ingredientes:</p>
                <p class='my-3 mx-1 bg-secondary border p-1'>
                    $limpiezaIngredientes
                </p>



                <p class='h3'>¡Manos a la obra!</p>
                <p class='my-3 mx-1 bg-secondary border p-1'>
                    $limpiezaReceta
                </p>

            </div>
        </div>
    </div>

    <script src='../js/jquery-3.4.1.min.js'></script>
    <script src='../js/popper.min.js'></script>
    <script src='../js/bootstrap.min.js'></script>

</body>
</html>

";

// Good fucking luck, dude.

file_put_contents ($nombreCaminoArchivo, $contenidoFinal);

/*

1) crear directamente la pagina a partir del formulario
2) que el nombre de pagina sea nombre_categoria_categoria_tipo ?¿
3) para surtir las paginas que sea que se busque el string correspondiente ej: "vegano" en los nombres de los archivos y ahi muestra los que lo contienen


para los nombres, quitar todos los caracteres especiales, cambiar todos los espacios por 1 espacio, y reemplazar el espacio restante por un "_"
---

    <?php

        // Para leer el contenido de una carpeta primero tenemos que abrirla

        $rutaCarpeta = "contenido";
        $carpeta = opendir($rutaCarpeta);

        // Para leer el contenido de esa carpeta usamos la función readdir()


        echo "<ul>";
        while($archivo = readdir($carpeta)):
            
            if($archivo == "." || $archivo == ".."):
                continue;
            endif;
            
            echo "<li>" . $archivo . "</li>";

            echo "<li>" . dirname("$rutaCarpeta/$archivo") . "</li>";
            
        endwhile;
        
        echo "</ul>";

        echo "<hr>";

        echo "<h1>" . __FILE__ . "</h1>";
        echo "<h1>" . __DIR__ . "</h1>";

        // cierro el recurso que estaba usando
        closedir($carpeta);

        if(is_dir("contenido"))
            rmdir("contenido");

        mkdir("contenido");

        echo "<pre>";
            print_r(glob("$rutaCarpeta/*a*"));
        echo "</pre>";

    ?>



*/

?>

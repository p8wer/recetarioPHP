<?php 

    include('../php/0_pag.php');
    
    echo "<pre class='text-light'>";
    print_r ($_POST['busqueda']);
    echo "</pre>";

    $nombreCarpeta = ("../recetas");
    
    $escaneoRecetas = scandir($nombreCarpeta);
    
    $chauPuntitos = array_diff($escaneoRecetas, array('..', '.'));

    $procesamientoQuery = array_diff($chauPuntitos,($_POST['busqueda']));
    
    echo "<pre class='text-light'>";
    print_r($procesamientoQuery);
    echo "</pre>";

?>
    
<p>
    
    <?php

    
    ?>
    
</p>

<?php include('../php/1_pag.php') ?>
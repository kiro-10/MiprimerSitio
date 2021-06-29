 <?php 
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    require('../class/comunaModel.php');
    require('../class/rutas.php');

    //creamos un objetivo o instancia de la clase regionModel
    $comunas= new comunaModel;
    //disponibilizacion de las regiones
    $comunas = $comunas->getComunas();

    //echo '<pre>';
    //print_r($regiones);exit;
    //echo '</pre>';
?>
<!--Estructura del DOM (Document Objetc Model)--->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comunas</title>
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/estilos.css">
</head>
<body>
    <header>  
        <?php  include('../partials/menu.php'); ?>
    </header>

    <section>
        <div class = "formulario">
            <?php if (isset($_GET['m']) && $_GET['m'] == 'ok'): ?>
                <p class= "alert-success">La comuna se ha registrado correctamente</p>
            <?php endif;?>
            <h1>Comunas</h1>
            <table class ="table"> 
                <thead>
                    <tr>

                        <th>Comuna</th>
                        <th>Región</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($comunas as $comuna):?>
                        <tr>
                            <td>
                                <a href="show.php?id=<?php echo $comuna ['id']; ?>"> 
                                    <?php echo $comuna ['nombre']; ?>
                                </a> 
                            </td>
                            <td>
                                <?php echo $comuna['region'];?>
                            </td>
                        </tr>
                    <?php endforeach;?>
                </tbody>
            </table> 
        
            <p class="enlace"> 
                <a href="add.php" class="btn btn-primary">Nueva Comuna</a>
            </p>
        </div> 
    </section>
    <footer>
        <?php  include('../partials/footer.php'); ?>
    </footer>
</body>
</html>
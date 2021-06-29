<?php 
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    require('../class/regionModel.php');
    require('../class/rutas.php');

    //creamos un objetivo o instancia de la clase regionModel
    $regiones= new regionModel;
    //disponibilizacion de las regiones
    $regiones = $regiones->getRegiones();

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
    <title>Regiónes</title>
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/estilos.css">
</head>
<body>
    <header>  
        <?php  include('../partials/menu.php'); ?>
    </header>

    <!-- cuerpo y central de la pagina web -->
    <section>
        <div class = "formulario">
            <?php if (isset($_GET['m']) && $_GET['m'] == 'ok'): ?>
                <p class= "alert-success">La región se ha registrado correctamente</p>
            <?php endif;?>

            <?php if (isset($_GET['e']) && $_GET['e'] == 'ok'): ?>
                <p class= "alert-success">La región se ha sido eliminado correctamente</p>
            <?php endif;?>


            <h1>Regiónes</h1>
            <table class ="table"> 
                <thead>
                    <tr>

                        <th>Id</th>
                        <th>Región</th>

                    </tr>
                </thead>
                <tbody>
                    <?php foreach($regiones as $region):?>
                        <tr>
                            <td><?php echo $region ['id']; ?></td>

                            <td>
                                <a href="show.php?id=<?php echo $region ['id']; ?>"> 
                                    <?php echo $region ['nombre']; ?>
                                </a> 
                            </td>
                        </tr>
                    <?php endforeach;?>
                </tbody>
            </table> 
            <p class="enlace"> 
                <a href="add.php" class="btn btn-primary">Nueva región</a>
            </p>
        </div>      
    </section>
    <footer>
        <?php  include('../partials/footer.php'); ?>
    </footer> 
</body>
</html>
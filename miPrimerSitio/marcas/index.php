<?php 
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    require('../class/marcaModel.php');
    require('../class/rutas.php');
    $marcas= new marcaModel;
    $marcas = $marcas->getMarcas();
    //echo '<pre>';
    //print_r($marcas);exit;
    //echo '</pre>';
?>

<!--Estructura del DOM (Document Objetc Model)--->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marcas</title>
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
                <p class= "alert-success">La marca se ha registrado correctamente</p>
            <?php endif;?>

            <?php if (isset($_GET['e']) && $_GET['e'] == 'ok'): ?>
                <p class= "alert-success">La marca se ha sido eliminado correctamente</p>
            <?php endif;?>


            <h1>Marcas</h1>
            <table class ="table"> 
                <thead>
                    <tr>

                        <th>Id</th>
                        <th>Marca</th>

                    </tr>
                </thead>
                <tbody>
                        <tr>
                            <?php foreach($marcas as $marca):?>

                            <td><?php echo $marca ['id']; ?></td>

            
                            <td>
                                <a href="show.php?id=<?php echo $marca ['id']; ?>"> 
                                    <?php echo $marca ['nombre']; ?>
                                </a> 
                            </td>
                        </tr>
                    <?php endforeach;?>
                </tbody>
            </table> 
            <p class="enlace"> 
                <a href="add.php" class="btn btn-primary">Nueva Marca</a>
            </p>
        </div>
    </section>
    <footer>
        <?php  include('../partials/footer.php'); ?>
    </footer> 
</body>
</html>
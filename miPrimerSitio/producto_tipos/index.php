<?php

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    require('../class/productoTipoModel.php');
    require('../class/rutas.php');

    $productoTipos = new productoTipoModel;

    $productoTipos = $productoTipos->getProductoTipos();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Producto Tipos</title>
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/estilos.css">
</head>
<body>
    <header>
        <?php include('../partials/menu.php');?>
    </header>

    <section>
        <div class="formulario">
            <?php if (isset($_GET['m']) && $_GET ['m'] == 'ok'):   ?>  
                <p class="alert-success">El tipo de producto se ha registrado correctamente</p>
            <?php endif; ?>
            
            <h1>Tipos de Productos</h1>
            <table class="table">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Tipos de Productos</th>
                    </tr>
                </thead>
                <tbody>
                    
                    <?php foreach ($productoTipos as $productoTipo):?>
                        <tr>
                            <td><?php echo $productoTipo['id'];?></td>

                            <td>
                                <a href="show.php?id=<?php echo $productoTipo['id'];?>">
                                    <?php echo $productoTipo['nombre'];?>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <p class="enlace">
                <a href="add.php" class="btn btn-primary">Nuevo tipo de producto</a>
            </p>
        </div>
    </section>
    <footer>
        <?php include('../partials/footer.php') ?>
    </footer>
</body>
</html>
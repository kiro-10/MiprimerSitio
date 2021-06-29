<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    
    require('../class/productoTipoModel.php');
    require('../class/rutas.php');
    
    if(isset($_GET['id'])){

        $id = (int) $_GET['id'];

        $productoTipos = new productoTipoModel;
        $productoTipo = $productoTipos->getProductoTipoId($id); 

    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tipos de Productos</title>
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/estilos.css">
</head>
<body>

    <header>
    <?php include('../partials/menu.php') ?>
    </header>

    <section>
        <div class="formulario">
            <?php if(isset($_GET['m']) && $_GET['m'] == 'ok'): ?>
                <p class="alert-success">El tipo de producto sea modificado correctamente</p>
            <?php endif;?>
        

            <h1>Tipos de Productos</h1>
            
            <?php if($productoTipo):?>
                <table class="table">
                    <tr>
                        <th>Id:</th>
                        <td><?php echo $productoTipo['id'];?></td>
                    </tr>
                    <tr>
                        <th>Tipo de producto</th>
                        <th><?php echo $productoTipo['nombre']; ?></th>
                    </tr>
                </table>
                <p class="enlace">
                    <a href="edit.php?id=<?php echo $id;?>" class="btn btn-primary">Editar</a>
                    <a href="index.php" class="btn btn-link">Volver</a>
                </p>
                <?php else: ?>
                    <p class="text-info">El dato no existe</p>
                <?php endif; ?>
        </div> 





    </section>






    <footer>
        <?php include('../partials/footer.php') ?>
    </footer>
</body>
</html>
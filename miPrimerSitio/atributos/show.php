<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    require('../class/atributoModel.php');
    require('../class/rutas.php');

    if (isset($_GET['id'])){
        $id = (int) $_GET['id'];

        $atributos = new atributoModel;
        $atributo = $atributos->getAtributoId($id);

        

    }

      
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atributos</title>
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/estilos.css">
</head>
<body>
<header>    
    <?php include('../partials/menu.php');?>
</header>

<section>
    <div class = "formulario"> 
        <?php if (isset($_GET['m']) && $_GET['m'] == 'ok'):?>
            <p class = "alert-success">El atributo se ha modificado correctamente</p>
        <?php endif;?>

     
        
        <h1>Atributos</h1>
        <?php if($atributo):?>
            <table class ="table">
                <tr>
                    <th>Id:</th>
                    <td><?php echo $atributo['id'];?></td>
            
                </tr>
                <tr>

                        <th>Atributo:</th>
                        <td><?php echo $atributo['nombre'];?></td>
            
                </tr>


            </table>
            <p class ="enlace">
                <a href="edit.php?id=<?php echo $id; ?>" class = "btn btn-primary">Editar</a>
                <a href="index.php" class ="btn btn-link">Volver</a>
            </p>
        <?php else:?>
            <p class="text-info">El dato no existe</p>
        <?php endif;?>
    </div>
</section>
<footer>
    <?php include('../partials/footer.php');?>
</footer>

</body>
</html>
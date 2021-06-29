<?php 
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
 

    require('../class/atributoModel.php');
    require('../class/rutas.php');

    $atributos = new atributoModel;

    $atributos = $atributos->getAtributos();

    //comprobar si se  esta mostranto los datos de la tabla
    //echo '<pre>';
    //print_r($atributos);exit;
    //echo '/<pre>';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/estilos.css">
    <title>Atributos</title>
</head>
<body>
    
<header>
    <?php include('../partials/menu.php'); ?>
</header>


<section>
    <div class = "formulario">
        <?php if (isset($_GET['m']) && $_GET['m'] == 'ok'):?>
            <p class ="alert-success">El atributo se ha registrado correctamente</p>
        <?php endif;?>

  

        <h1>Atributos</h1>
        <table class = "table">
            <thead>
                <tr>

                    <th>Id</th>
                    <th>Atributo</th>
        

                </tr>
            </thead>
            <tbody>
                    <?php foreach ($atributos as $atributo):?>
                    <tr>
                        <td><?php echo $atributo ['id']; ?></td>
                        
                        <td>
                            <a href="show.php?id=<?php echo $atributo ['id'];?>">
                                <?php echo $atributo ['nombre']; ?>
                            </a>
                        </td>
                    </tr>
                <?php endforeach;?>
            </tbody>
        </table>
        <p class = "enlace">
            <a href="add.php" class = "btn btn-primary">Nuevo Atributo</a>
        </p>
 </div>

</section>
<footer>
    <?php include('../partials/footer.php');?>
</footer>
</body>
</html>
<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require('../class/rolModel.php');
require('../class/rutas.php');

//creamos un objetivo o instancia de la clase rolModel
$roles= new rolModel;
//disponibilizacion de todos roles
$roles = $roles->getRoles();

//echo '<pre>';
//print_r($roles);exit;
//echo '</pre>';

?>
<!--Estructura del DOM (Document Objetc Model)--->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Roles</title>
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/estilos.css">
    


</head>
<body>
    <!--Aqui se ve todo el codigo por el usuario----> 



    <!----cabercera de sitio del y menu de navegacion---->

    <header>  
        <?php  include('../partials/menu.php'); ?>  <!-- Navegador principal del sitio -->
    </header>

    <!-- cuerpo y central de la pagina web -->
    <section>
        <div class = "formulario">
            <?php if (isset($_GET['m']) && $_GET['m'] == 'ok'): ?>
                <p class= "alert-success">El rol se ha registrado correctamente</p>
            <?php endif;?>

            <?php if (isset($_GET['e']) && $_GET['e'] == 'ok'): ?>
                <p class= "alert-success">El rol se ha sido eliminado correctamente</p>
            <?php endif;?>


            <h1>Roles</h1>
            <table class ="table"> 
                <thead>
                    <tr>

                        <th>Id</th>
                        <th>Rol</th>

                    </tr>
                </thead>
                <body>
                    <tr>
                        <?php foreach($roles as $rol):?>

                        <td><?php echo $rol ['id']; ?></td>

            
                        <td>
                            <a href="show.php?id=<?php echo $rol ['id']; ?>"> 
                                <?php echo $rol ['nombre']; ?>
                            </a> 
                        </td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table> 
                <p class="enlace"> 
                    <a href="add.php" class="btn btn-primary">Nuevo Rol</a>
                </p>
        </div>
        <!-- lado derecho de la pagina -->    
        <!-- lado izquierdo de la pagina -->
        <!-- pie de pagina sitio -->

    </section>
    <footer>
        <?php  include('../partials/footer.php'); ?>
    </footer> 
</body>
</html>
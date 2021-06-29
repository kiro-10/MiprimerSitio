<?php 
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    require('../class/PersonaModel.php');
    require('../class/rutas.php');
    require('../class/session.php');

    

    //creamos un objetivo o instancia de la clase regionModel
    $session = new Session;
    $personas= new PersonaModel;
    //disponibilizacion de las regiones
    $personas = $personas->getPersonas();

    //echo '<pre>';
    //print_r($personas);exit;
    //echo '</pre>';
?>

<!--Estructura del DOM (Document Objetc Model)--->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personas</title>
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
        <?php include('../partials/mensajes.php');?>

            <h1>Personas</h1>
            <table class ="table"> 
                <thead>
                    <tr>

                        <th>Nombre</th>
                        <th>Comuna</th>
                        <th>Rol</th>
                       

                    </tr>
                </thead>
                <tbody>
                    <?php foreach($personas as $persona):?>
                        <tr>
                            <td>
                                <a href="show.php?id=<?php echo $persona ['id']; ?>"> 
                                    <?php echo $persona ['nombre']; ?>
                                </a> 
                            </td>
                            <td><?php echo $persona ['comuna']; ?></td>
                            <td><?php echo $persona ['rol']; ?></td>
                        </tr>
                    <?php endforeach;?>
                </tbody>
            </table> 
            <p class="enlace"> 
                <a href="add.php" class="btn btn-primary">Nueva Persona</a>
            </p>
        </div>      
    </section>
    <footer>
        <?php  include('../partials/footer.php'); ?>
    </footer> 
</body>
</html>
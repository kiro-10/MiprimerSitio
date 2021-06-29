<?php 
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);   
    require('../class/marcaModel.php');
    require('../class/rutas.php');

    if(isset($_GET['id'])){

        $id = (int) $_GET['id']; 

        $marcas = new marcaModel;
        $marca = $marcas->getMarcaId($id);

   
        //print_r($id);exit;
    }
?>

<!--Estructura del DOM (Document Objetc Model)--->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marca</title>
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/estilos.css">
    
    


</head>
<body>

    <header>  
        <?php  include('../partials/menu.php'); ?>
    </header>


    <section>       
        <div class= "formulario">
            <?php if (isset($_GET['m']) && $_GET['m'] == 'ok'): ?>
                <p class= "alert-success">La marca se ha modificado correctamente</p>
            <?php endif;?> 
     
            <h1>Marcas</h1> 

            <?php if($marca): ?>
                <table class="table">
                    <tr>
                        <th>Id:</th>
                        <td><?php echo $marca['id'];?></td>
                    </tr>
                    <tr>
                        <th>Marca:</th>
                        <td><?php echo $marca['nombre'];?></td>
                    </tr>
                    <tr>
                        <th>Creado</th>
                        <td>    
                            <?php
                                //creamos una instancia de la fecha mysql en php con la clase Datetime
                                $created = new DateTime($marca['created_at']);
                                echo $created->format('d-m-Y H:i:s');
                            ?>
                        </td>
                    <tr>
                            <th>Actualizado:</th>
                        <td>
                            <?php
                                $created = new DateTime($marca['updated_at']);
                                echo $created->format('d-m-Y H:i:s');
                            ?>
                        </td>
                    </tr>
                </table>
        
                <p class ="enlace">
                    <a href="edit.php?id=<?php echo $id; ?>" class = "btn btn-primary">Editar</a>
                    <a href="index.php" class="btn btn-link">Volver</a>
                </p>

                <form action="delete.php" method="post">
                    <input type ="hidden" name = "confirm" value = "1">
                    <input type="hidden" name ="id" value="<?php  echo $id ?>">
                    <button type="submit" class ="btn btn-warning">Eliminar</button>
                </form>
                <?php else: ?>
                    <p class ="text-info">El dato no existe</p>
            <?php endif;?>
        </div>
    </section>
    <footer>
        <?php  include('../partials/footer.php'); ?>
    </footer>  
</body>
</html>



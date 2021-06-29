<?php
    //LADO DEL SERVIDOR
    //Establecer conexion con la base de datos
    require('../class/marcaModel.php');
    require('../class/rutas.php');
    //Creamos un objeto o instancia de la clase marcaModel
    $marcas = new marcaModel;

    //verificar la variable id de la marca exista 
    if(isset($_GET['id'])){

        $id =(int) $_GET['id'];
        $marca = $marcas->getMarcaId($id);


        if(isset($_POST['confirm']) && $_POST['confirm']== 1){
 
            $nombre = trim(strip_tags($_POST['nombre']));
    
            if(!$nombre){
                $msg='Ingrese el nombre de la marca';
            }else{
                //procedemos a modificar la marca solicitado
                $row = $marcas->updateMarca($id,$nombre);

                if($row){
                    $msg ='ok';
                    header('Location: show.php?id='.$id.'&m='.$msg);
                }     
    
            }
                  
        } 

    }   


   
?>

<!--LADO DEL CLIENTE--->


<!--Estructura del DOM (Document Objetc Model)--->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Marca</title>
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/estilos.css">
    


  
</head>
<body>  
    <header>  

        <?php  include('../partials/menu.php'); ?>
    </header>
    <section>
        <div class="formulario"> 
            <?php if(!empty($marca)): ?>
                <form action="" method="post">
                    <div class="form-group">
                        <label for="marca">Marca</label>
                        <input type="text" name="nombre" value="<?php echo $marca['nombre']; ?>" 
                        class="form-control" placeholder="Ingrese el nombre de la marca">
                        <?php if(isset($msg)): ?>
                            <p class="text-danger">
                                <?php echo $msg; ?>
                            </p>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="confirm" value="1">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <a href="show.php?id=<?php echo $id; ?>" class="btn btn-link">Volver</a>
                    </div>
                </form>
            <?php else: ?>
                <p class="text-info">El dato no existe</p>
            <?php endif; ?>
        </div>
    </section>
    <footer>
        <?php include('../partials/footer.php')?>
    </footer>
</body>
</html>

<!-- Get => enviar datos al servidor a traves de la URL
POST => enviar datos al servidor de manera interna -->




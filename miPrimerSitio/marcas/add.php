<?php
    //Establecer conexion con la base de datos
    require('../class/marcaModel.php');
    require('../class/rutas.php');
    //Creamos un objeto o instancia de la clase regionModel
    $marcas = new marcaModel;

    if(isset($_POST['confirm']) && $_POST['confirm']== 1){
 
      
        $nombre = trim(strip_tags($_POST['nombre'])); 
        if (!$nombre) {
            $msg = 'Debe ingresar el nombre de la marca';
        }else{
          
            $row = $marcas->getMarcaNombre($nombre);
            if($row){
                $msg = 'La marca ingresado ya exite... intento con otro';
            }else{
                $row = $marcas->setMarcas($nombre);
                if($row){
                   
                    $msg = 'ok';
                   
                    header('Location: index.php?m='. $msg);
                }
            }
       
        } 

        
    }
    //print_r($row);exit;
    //la funcion print_r permite imprimir datos a manera de prueba
    //print_r($nombre);exit;
?>

<!--Estructura del DOM (Document Objetc Model)--->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva Marca</title>
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/estilos.css">
    <!-- <script src ="js/formulario.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script> -->

 


  
</head>
<body>
    
    <header>
        <?php  include('../partials/menu.php'); ?>
    </header>

    <section>
        <h1>Nueva Marca</h1>
        <div class="formulario">
            <form action="" method="post">
                <div class="form-group">
                        <label for="marca">Marca</label>
                        <input type="text" name="nombre" class="form-control" placeholder="Ingrese el nombre del la marca">
                    
                        <?php if(isset($msg)): ?>
                            <p class="text-danger">
                                <?php echo $msg; ?>
                             </p>
                        <?php endif; ?>
                </div>
                <div class="form-group">
                    <input type="hidden" name="confirm" value="1">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <a href="index.php" class="btn btn-link">Volver</a>
                </div>
            </form>
        </div>
    </section>
    <footer>
        <?php include('../partials/footer.php') ?>
    </footer>


</body>
</html>


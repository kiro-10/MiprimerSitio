<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);

    require('../class/comunaModel.php');
    require('../class/regionModel.php');
    require('../class/rutas.php');
    //Creamos un objeto o instancia de la clase comunaModel y regionModel

    $comunas = new comunaModel;
    $regiones = new regionModel;        
    $regiones = $regiones->getRegiones();


    if(isset($_POST['confirm']) && $_POST['confirm']== 1)   {
 

        $nombre = trim(strip_tags($_POST['nombre'])); 
        $region = (int) $_POST ['region'];

        if (strlen($nombre) < 3){
            $msg = ' Ingrese el nombre del la comuna';

        }elseif($region <= 0)  {
            $msg = 'Seleccione una región';
        }else{
            #verificar que el dato no este registrado en tabla de regiones
            $row = $comunas->getComunaNombre($nombre);

            if($row){
                $msg = 'La comuna ingresado ya exite... intento con otro';
            }else{

                $row = $comunas->setComunas($nombre,$region);

                if($row){
                    $msg = 'ok';
                    header('Location: index.php?m='. $msg);
                }
            }     
                
        }     
    }               
?>

<!--Estructura del DOM (Document Objetc Model)--->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comuna</title>
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
        <h1>Nueva Comuna</h1>
        <div class="formulario">
            <?php if(isset($msg)): ?>
                        <p class="alert-danger">
                            <?php echo $msg; ?>
                        </p>
                    <?php endif; ?>

            <form action="" method="post">
                <div class="form-group">
                    <label for="comuna">Comuna</label>
                    <input type="text" name="nombre" 
                    value ="<?php if(isset($_POST['nombre']))  echo $_POST['nombre']; ?>"
                    class="form-control" 
                    placeholder="Ingrese el nombre de la comuna">
                    
                    
                </div>
                <div class ="form-group">   
                    <label for="region">Región</label>
                    <select name="region" class ="form-control">
                        <option value="">Seleccione...</option>
                        
                       <!--  mostrar la lista de regiones  -->
                       <?php foreach($regiones as $region): ?>
                        <option value="<?php echo $region['id'];?>">
                            <?php echo $region ['nombre']; ?>
                        </option>
                       <?php endforeach;?>

                    </select>

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
        <?php include('../partials/footer.php');?>
    </footer>
</body>
</html>


<!-- Get => enviar datos al servidor a traves de la URL
POST => enviar datos al servidor de manera interna -->
<?php
    //Establecer conexion con la base de datos
    require('../class/regionModel.php');
    require('../class/comunaModel.php');
    require('../class/rutas.php');
    //Creamos un objeto o instancia de la clase regionModel
    $regiones = new regionModel;
    $comunas = new comunaModel;

    //verificar la variable id del comuna exista 
    if(isset($_GET['id'])){

        $id = (int) $_GET['id'];
        $comuna =$comunas->getComunaId($id);

      
        $regiones = $regiones->getRegiones();
    
    
        if(isset($_POST['confirm']) && $_POST['confirm']== 1){

    //print_r($_POST);exit;
            $nombre = trim(strip_tags($_POST['nombre']));//recuperamos la variable post  de comuna
            $region = (int) $_POST['region']; //recuperamos post  region=> id de region
  
              
            if(!$nombre){
                $msg='Ingrese el nombre de la comuna';
            }elseif($region <= 0){
                $msg ='Seleccione la region';
            
            }else{
                //procedemos a modificar el rol solicitado
                $row = $comunas->updateComuna($id,$nombre,$region);
                    
                if($row) {
                    $msg ='ok';
                    header('Location: show.php?id='.$id.'&m='.$msg);
        
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
    <title>Regiónes</title>
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/estilos.css">
</head>
<body>


    <header>  <!-- opcion 1 Generar estilo de linea para cada elemento -->
        <?php  include('../partials/menu.php'); ?>
    </header>

    <!-- cuerpo y central de la pagina web -->
    <section>
        <h1>Editar Comuna</h1>
        <div class="formulario"> 
                <?php if(isset($msg)): ?>
                    <p class="alert-danger">
                        <?php echo $msg; ?>
                    </p>
                <?php endif; ?>
                
                <?php if(!empty($comuna)): ?>
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="comuna">Comuna</label>
                            <input type="text" name="nombre" value="<?php echo $comuna['nombre']; ?>" class="form-control" placeholder=
                            "Ingrese el nombre de la comuna">
                        </div>

                        <div class ="form-group">   
                                <label for="region">Region</label>
                            <select name="region" class ="form-control">
                                <option value="<?php echo $comuna['region_id'];?>"
                                ><?php echo $comuna['region'];?></option>
                        
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
                            <a href="show.php?id=<?php echo $id; ?>" class="btn btn-link">Volver</a>
                        </div>
                    </form>
                <?php else: ?>
                    <p class="text-info">El dato no existe</p>
                <?php endif; ?>
        </div>
    </section>

    <!-- pie de pagina sitio -->
    <footer>
        <?php include('../partials/footer.php');?>
    </footer>


    
</body>
</html>

<!-- Get => enviar datos al servidor a traves de la URL
POST => enviar datos al servidor de manera interna -->




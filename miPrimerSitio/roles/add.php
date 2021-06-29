<?php
    //Establecer conexion con la base de datos
    require('../class/rolModel.php');
    require('../class/rutas.php');
    //Creamos un objeto o instancia de la clase rolModel
    $roles = new rolModel;


    //validamos que el formulario sea enviado via POST
    if(isset($_POST['confirm']) && $_POST['confirm']== 1){
 
            //guardaremos el nombre del rol en una variable nombre
            $nombre = trim(strip_tags($_POST['nombre'])); //sanitizar la variable nombre

            //validar  que la variable no este vacia

            if (!$nombre) {
                $msg = 'Debe ingresar el nombre del rol';
        }else{
            #verificar que el dato no este registrado en tabla roles
            $row = $roles->getRolNombre($nombre);
            if($row){
                $msg = 'El rol  ingresado ya exite... intento con otro';

            }else {
                    $row = $roles->setRoles($nombre);

                    if($row){
                    //crear una variable de exito
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
    <title>Nuevo Rol</title>
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/estilos.css">
    <!--<script src ="js/formulario.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script> -->
</head>
<body>
    <header>
        <?php  include('../partials/menu.php'); ?>
    </header>

    <!-- cuerpo y central de la pagina web -->
    <section>
        <h1>Nuevo Rol</h1>

        <!-- POST => envia datos a traves del navegador (URI) al servidor -->
        <!--  GET => Envia datos a traves de la url del navegador (URI) -->

        <!-- Formulario-->

        <div class="formulario">
            <!--  GET => envia datos a traves de la url del navegador (URI) al servidor
             POST => envia datos de manera interna al servidor -->
            
                <form action="" method="post">
                    <div class="form-group">
                        <label for="rol">Rol</label>
                        <input type="text" name="nombre" class="form-control" placeholder="Ingrese el nombre del rol">
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


    <!-- pie de pagina sitio -->
    <footer>
    <?php include('../partials/footer.php'); ?>
    </footer>

</body>
</html>


<!-- Get => enviar datos al servidor a traves de la URL
POST => enviar datos al servidor de manera interna -->
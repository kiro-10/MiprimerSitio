<?php
    //Establecer llamada con los archivos 
    require('../class/usuarioModel.php');
    require('../class/rutas.php');
    require('../class/session.php');
    //Creamos un objeto o instancia de la clase PersonaModel,rolModel y comunaModel
    $session = new Session;
    $usuario = new UsuarioModel;
    $roles = new rolModel;
    $comunas = new comunaModel;

    //verificar la variable id del rol exista 
    if(isset($_GET['id'])){

        $id = (int) $_GET['id'];
        $usuario =  $usuario->getUsuarioId($id);
   
    
        if(isset($_POST['confirm']) &&  $_POST['confirm'] == 1){
            //recepcionar los datos que vienen del formulario
            $nombre = trim(strip_tags($_POST['nombre']));
            $rut = trim(strip_tags($_POST['rut']));
            $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
            $direccion = trim(strip_tags($_POST['direccion']));
            $comuna = filter_var($_POST['comuna'], FILTER_VALIDATE_INT);
            $fecha_nac = trim(strip_tags($_POST['fecha_nac']));
            $telefono = filter_var($_POST['telefono'], FILTER_VALIDATE_INT);
            $rol = filter_var($_POST['rol'], FILTER_VALIDATE_INT);

            if (strlen($nombre) < 5) {
                $msg = 'Ingrese el nombre de al menos 5 caracteres';
            }elseif (strlen($rut) < 8) {
                $msg = 'Ingrese un rut de al menos 8 caracteres';
            }elseif (!$email) {
                $msg = 'Ingrese un correo electrónico válido';
            }elseif (strlen($direccion) < 8) {
                $msg = 'La dirección debe contener al menos 8 caracteres';
            }elseif (!$comuna) {
                $msg = 'Seleccione una comuna';
            }elseif (!$fecha_nac) {
                $msg = 'Ingrese la fecha de nacimiento';
            }elseif (strlen($telefono) < 9) {
                $msg = 'El número de teléfono debe contener al menos 9 dígitos';
            }elseif (!$rol) {
                $msg = 'Seleccione un rol';
            }else{
                //actualizamos el registro de las persona segun el id
                
                $row = $personas->updatePersona($id, $nombre, $rut, $email, $direccion, $fecha_nac, $telefono, $rol, $comuna);
 
                if($row){
                $_SESSION['success'] = 'La persona se ha modificado correctamente';
                header('Location: show.php?id='.$id);

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
    <title>Personas</title>
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/estilos.css">
</head>
<body>


    <header>  <!-- opcion 1 Generar estilo de linea para cada elemento -->
        <?php  include('../partials/menu.php'); ?>
    </header>

    <!-- cuerpo y central de la pagina web -->
    <section>
        <h1>Editar Persona</h1>
        <div class="formulario"> 
                <?php if(!empty($persona)): ?>
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="nombre">Nombre<span class ="text-danger">*</span> </label>
                            <input type="text" name="nombre" class="form-control" 
                            placeholder="Ingrese el nombre del la persona" value ="<?php
                             echo $persona ['nombre']; ?>">
                        </div>
                <div class="form-group">
                    <label for="rut">RUT</label>
                    <input type="text" name="rut" class="form-control" 
                    placeholder="Ingrese el nombre el rut de la persona" value ="<?php
                     echo $persona['rut']; ?>">
                </div>
                <div class="form-group">
                    <label for="email">Email<span class ="text-danger">*</span> </label>
                    <input type="text" name="email" class="form-control" 
                    placeholder="Ingrese  el email de la persona" value ="<?php
                     echo $persona['email']; ?>">
                </div>
                <div class="form-group">
                    <label for="direccion">Dirección (calle y nombre)<span class ="text-danger">*</span> </label>
                    <input type="text" name="direccion" class="form-control" 
                    placeholder="Ingrese la direccion de la persona" value ="<?php
                    echo $persona['direccion']; ?>">
                </div>
                <div class ="form-group">   
                    <label for="comuna">Comuna<span class ="text-danger">*</span> </label>
                    <select name="comuna" class ="form-control">
                        <option value="<?php echo $persona ['comuna_id'];?>">
                        <?php echo $persona ['comuna'];?>
                        </option>
                        
                       <!--  mostrar la lista de comunas  -->
                       <?php foreach($comunas as $comuna): ?>
                        <option value="<?php echo $comuna['id'];?>">
                            <?php echo $comuna ['nombre']; ?>
                        </option>
                       <?php endforeach;?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="telefono">Teléfono<span class ="text-danger">*</span> </label>
                    <input type="number" name="telefono" class="form-control" 
                    placeholder="Ingrese el  teléfono de la persona" value ="<?php
                     echo $persona['telefono']; ?>">
                </div> 
                <div class="form-group">
                    <label for="fecha_nac">Fecha de nacimiento<span class ="text-danger">*</span> </label>
                    <input type="date" name="fecha_nac" class="form-control" 
                    placeholder="Ingrese la fecha de nacimiento de la persona" value ="<?php
                    echo $persona['fecha_nac']; ?>">
                </div>  
                <div class ="form-group">   
                    <label for="rol">Rol<span class ="text-danger">*</span> </label>
                    <select name="rol" class ="form-control">
                        <option value="<?php  echo $persona['rol_id']; ?>">
                            <?php echo $persona['rol']; ?>
                        </option>

                       <!--  mostrar la lista de roles  -->
                       <?php foreach($roles as $rol): ?>
                        <option value="<?php echo $rol ['id'];?>">
                            <?php echo $rol ['nombre'];?>
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




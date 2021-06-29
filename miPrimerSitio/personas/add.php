<?php
    //debugger basico de php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
  
    //Establecer la llamada que los archivos que de las clases necesitamos
    require('../class/personaModel.php');
    require('../class/rolModel.php');
    require('../class/comunaModel.php');
    require('../class/rutas.php');
    require('../class/session.php');

    
    //Creamos objetos de las clases que se necesitan para registrar personas
    $session = new Session;
    $personas = new PersonaModel;
    $roles = new rolModel;
    $comunas = new comunaModel;

    //lista de roles
    $roles = $roles->getRoles();
    //lista de comunas
    $comunas = $comunas->getComunas();

     //validamos que el formulario sea enviado via post
    if (isset($_POST['confirm']) && $_POST['confirm'] == 1) {
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
            //preguntar si la persona ingresada existe en la tabla personas
            $persona = $personas->getPersonaEmail($email);

            if($persona){
                $msg = 'Esta persona ya está registrada... Intente con otra';
            }else{
                //registrar la persona en la base de datos
                $row = $personas->setPersona($nombre, $rut, $email, $direccion, $fecha_nac, $telefono, $rol, $comuna);

                if ($row) {
                    $_SESSION['success'] = 'La persona se ha registrado correctamente';
                    header('Location: index.php');
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
    <title>Persona</title>
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

    <!-- cuerpo y central de la pagina web -->
    <section>
        <h1>Nueva Persona</h1>

        <!-- POST => envia datos a traves del navegador (URI) al servidor -->
        <!--  GET => Envia datos a traves de la url del navegador (URI) -->

        <!-- Formulario-->

        <div class="formulario">
            <!--  GET => envia datos a traves de la url del navegador (URI) al servidor
            POST => envia datos de manera interna al servidor -->
            <?php if(isset($msg)): ?>
                <p class="text-danger">
                     <?php echo $msg; ?>
                </p>
            <?php endif; ?>

                <h4 class="text-danger">Campos obligatorios</h4>
            <form action="" method="post">
                <div class="form-group">
                    <label for="nombre">Nombre<span class ="text-danger">*</span> </label>
                    <input type="text" name="nombre" class="form-control" 
                    placeholder="Ingrese el nombre del la persona" value ="<?php
                    if(isset($_POST['nombre'])) echo $_POST['nombre']; ?>">
                </div>
                <div class="form-group">
                    <label for="rut">RUT</label>
                    <input type="text" name="rut" class="form-control" 
                    placeholder="Ingrese el nombre el rut de la persona" value ="<?php
                    if(isset($_POST['rut'])) echo $_POST['rut']; ?>">
                </div>
                <div class="form-group">
                    <label for="email">Email<span class ="text-danger">*</span> </label>
                    <input type="text" name="email" class="form-control" 
                    placeholder="Ingrese  el email de la persona" value ="<?php
                    if(isset($_POST['email'])) echo $_POST['email']; ?>">
                </div>
                <div class="form-group">
                    <label for="direccion">Dirección (calle y nombre)<span class ="text-danger">*</span> </label>
                    <input type="text" name="direccion" class="form-control" 
                    placeholder="Ingrese la direccion de la persona" value ="<?php
                    if(isset($_POST['direccion'])) echo $_POST['direccion']; ?>">
                </div>
                <div class ="form-group">   
                    <label for="comuna">Comuna<span class ="text-danger">*</span> </label>
                    <select name="comuna" class ="form-control">
                        <option value="">Seleccione...</option>
                        
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
                    if(isset($_POST['telefono'])) echo $_POST['telefono']; ?>">
                </div> 
                <div class="form-group">
                    <label for="fecha_nac">Fecha de nacimiento<span class ="text-danger">*</span> </label>
                    <input type="date" name="fecha_nac" class="form-control" 
                    placeholder="Ingrese la fecha de nacimiento de la persona" value ="<?php
                    if(isset($_POST['fecha_nac'])) echo $_POST['fecha_nac']; ?>">
                </div>  
                <div class ="form-group">   
                    <label for="rol">Rol<span class ="text-danger">*</span> </label>
                    <select name="rol" class ="form-control">
                        <option value="">Seleccione...</option>
                        
                       <!--  mostrar la lista de roles  -->
                       <?php foreach($roles as $rol): ?>
                        <option value="<?php echo $rol['id'];?>">
                            <?php echo $rol ['nombre']; ?>
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


    <!-- pie de pagina sitio -->
    <footer>
        <?php include('../partials/footer.php'); ?>
    </footer>
</body>
</html>


<!-- Get => enviar datos al servidor a traves de la URL
POST => enviar datos al servidor de manera interna -->
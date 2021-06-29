<?php
    //Establecer conexion con la base de datos
    require('../class/usuarioModel.php');
    require('../class/rutas.php');
    require('../class/session.php');
  
    //Creamos un objeto o instancia de la clase usuarioModel
    $usuarios = new UsuarioModel;
    $session = new Session;
    if(isset($_POST['confirm']) && $_POST ['confirm'] == 1 ){

        $email = filter_var($_POST['email'],FILTER_VALIDATE_EMAIL);
        $clave = trim(strip_tags($_POST['clave']));

        if(!$email){
            $msg ='Ingrese un email valido';

        }elseif(!$clave){
            $msg='Ingrese su password';
        }else{
            //preguntamos por el usuario y clave registrados
            $row = $usuarios->getUsuarioLogin($email,$clave);
            
            if(!$row){
                $msg='El email o la password ingresado no exiten';
            }else{
                //creamos el login usando variables de sesion
               $id_usuario = $row['id'];
               $nom_usuario = $row['nombre'];
               $rol = $row['rol'];

                $session->login($id_usuario,$nom_usuario,$rol);

                header('Location:'.BASE_URL);


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
    <title>Login</title>
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
        <h1>Login</h1>

        <!-- POST => envia datos a traves del navegador (URI) al servidor -->
        <!--  GET => Envia datos a traves de la url del navegador (URI) -->

        <!-- Formulario-->

        <div class="formulario">
            <!--  GET => envia datos a traves de la url del navegador (URI) al servidor
            POST => envia datos de manera interna al servidor --> 
            <?php if(isset($msg)): ?>
                <p class="alert-danger">
                    <?php echo $msg; ?>
                </p>
            <?php endif; ?>
            <form action="" method="post">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name = "email" class="form-control" 
                    placeholder="Ingrese su correo electrónico">

                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="clave" class="form-control" 
                    placeholder="Ingrese su password de la cuenta">

                </div>

                
                <div class="form-group">
                    <input type="hidden" name="confirm" value="1">
                    <button type="submit" class="btn btn-primary">Iniciar sesión</button>
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
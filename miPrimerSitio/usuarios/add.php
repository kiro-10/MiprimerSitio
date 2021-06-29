<?php
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);


    //Establecer conexion con la base de datos
    require('../class/usuarioModel.php');
    require('../class/rutas.php');
    require('../class/session.php');
    //Creamos un objeto o instancia de la clase regionModel
    $session = new Session;
    $usuarios = new UsuarioModel;
    
    if (isset($_GET['id_persona'])) {
        $id_persona = (int) $_GET['id_persona'];

        //validamos que el formulario sea enviado via post
        if (isset($_POST['confirm']) && $_POST['confirm'] == 1) {

          
            $clave = trim(strip_tags($_POST['clave'])); //sanitizar la variable nombre
            $reclave = trim(strip_tags($_POST['reclave']));

            //validar que la variable no este vacia
            if (strlen($clave) < 8) {
                $msg = 'Debe ingresar un password de al menos 8 caracteres';
            }elseif ($reclave != $clave) {
                $msg = 'Los passwords ingresados no coinciden';
            }else {
                #verificar que laa persona ingresada no tenga una cuenta
                $row = $usuarios->getUsuarioPersona($id_persona);

                if ($row) {
                    $msg = 'error';
                    header('Location: ../personas/show.php?id=' . $id_persona . '&e=' . $msg);
                }else{
                    #registrar una cuenta de usuario
                    $row = $usuarios->setUsuario($clave, $id_persona);

                    if ($row) {
                        $_SESSION['success'] = 'La cuenta de usuario se ha creado correctamente';
                        header('Location: ../personas/show.php?id=' . $id_persona);
                    }
                }
            }

            //la funcion print_r permite imprimir datos a manera de prueba
            //print_r($nombre);exit;
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
    <title>Usuario</title>
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
        <h1>Nueva cuenta de usuario</h1>

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
                    <label for="password">Password</label>
                    <input type="password" name="clave" class="form-control" 
                    placeholder="Ingrese el password de la cuenta">

                </div>
                <div class="form-group">
                    <label for="repassword">Confirmar Password</label>
                    <input type="password" name="reclave" class="form-control" 
                    placeholder="Ingrese nuevamente el password de la cuenta">

                </div>

                
                <div class="form-group">
                    <input type="hidden" name="confirm" value="1">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <a href="../personas/show.php?id=<?php echo $id_persona; ?>" class="btn btn-link">Volver</a>
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
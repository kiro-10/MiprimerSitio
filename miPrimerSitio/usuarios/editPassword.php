<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    //establecer la conexion con la base de datos
    require('../class/usuarioModel.php');
    require('../class/session.php');
    require('../class/rutas.php');

    //creamos un objeto o instancia de la clase regionModel
    $usuarios = new UsuarioModel;
    $session = new Session;

    if (isset($_GET['id'])) {
        $id = (int) $_GET['id'];

        $usuario = $usuarios->getUsuarioId($id);
        //print_r($usuario);exit;

        //validamos que el formulario sea enviado via post
        if (isset($_POST['confirm']) && $_POST['confirm'] == 1) {

            //guardaremos el nombre de la region en la variable nombre
            $clave = trim(strip_tags($_POST['clave'])); //sanitizar la variable nombre
            $reclave = trim(strip_tags($_POST['reclave']));

            //validar que la variable no este vacia
            if (strlen($clave) < 8) {
                $msg = 'Debe ingresar un password de al menos 8 caracteres';
            }elseif ($reclave != $clave) {
                $msg = 'Los passwords ingresados no coinciden';
            }else {
                //actualizamos password
                $row = $usuarios->updatePassword($id, $clave);

                if($row){
                    $_SESSION ['success'] = 'El password se ha modificado correctamente';
                    header('Location: ' . PERSONAS . 'show.php?id=' . $usuario['persona_id']);
                }
            }

            //la funcion print_r permite imprimir datos a manera de prueba
            //print_r($nombre);exit;
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
        <h1>Editar Password</h1>
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
                    <label for="repassword">Nueva Password</label>
                    <input type="password" name="reclave" class="form-control" 
                    placeholder="Ingrese nuevamente el password de la cuenta">

                </div>

                
                <div class="form-group">
                    <input type="hidden" name="confirm" value="1">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <a href="../personas/show.php?id=<?php echo $usuario['persona_id']; ?>" class="btn btn-link">Volver</a>
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



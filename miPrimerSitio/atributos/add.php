<?php

    // LADO DE SERVIDOR

    require("../class/atributoModel.php");
    require("../class/rutas.php");

    $atributos = new atributoModel;

    if(isset($_POST['confirm']) && $_POST ['confirm']== 1){

            $nombre = trim(strip_tags($_POST['nombre']));

        if(!$nombre){
                $msg = 'Debe ingresar el nombre del atributo';
            }else{
                $row = $atributos->getAtributoNombre($nombre);
                if($row){
                    $msg = 'El atributo ingresado ya exite... intento con otro';
                }else{
                $row = $atributos->setAtributos($nombre);

                if($row){
                    $msg = 'ok'; 
                    header('Location: index.php?m='.$msg);
                }
            }
        }

            
    }
?>


<!-- LADO DEL CLIENTE -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Atributo</title>
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/estilos.css">
    <?php include('../partials/menu.php');?>

</head>
<body>
<section>
    <h1>Nuevo Atributo</h1>
    <div class = "formulario">
            <form action=""method = "post">
                <div class = "form-group">
                    <label for="atributo">Atributo</label>
                    <input type="text" name ="nombre" class = "form-control" 
                    placeholder = "Ingrese el nombre del atributo">

                    <?php if(isset($msg)):?>
                        <p class ="text-danger">
                            <?php echo $msg;?>
                        </p>
                    <?php endif;?> 
                </div>
                <div class = "form-group">
                    <input type ="hidden" name = "confirm" value ="1">
                    <button type ="submit" class = "btn btn-primary">Guardar</button>
                    <a href="index.php" class ="btn btn-link">Volver</a>
                </div>
            </form>
    </div>

</section>

<footer>
    <?php include('../partials/footer.php'); ?>
</footer> 

</body>
</html>
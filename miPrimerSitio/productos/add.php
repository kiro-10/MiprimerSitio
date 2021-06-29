<?php
    
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
  

    require('../class/productoModel.php');
    require('../class/marcaModel.php');
    require('../class/productoTipoModel.php');
    require('../class/rutas.php');
    
    
    $productos = new ProductoModel;
    $marcas = new marcaModel;
    $productoTipos = new productoTipoModel;

    //lista de marcas
    $marcas = $marcas->getMarcas();
    //lista de productoTipo
    $productoTipos = $productoTipos->getProductoTipos();

     //validamos que el formulario sea enviado via post
    if (isset($_POST['confirm']) && $_POST['confirm'] == 1) {
        $sku = trim(strip_tags($_POST['sku']));
        $nombre = trim(strip_tags($_POST['nombre']));
        $precio = filter_var($_POST['precio'], FILTER_VALIDATE_INT);
        $marca = filter_var($_POST['marca'], FILTER_VALIDATE_INT);
        $productoTipo = filter_var($_POST['productoTipo'], FILTER_VALIDATE_INT);


        if (strlen($sku) < 8) {
            $msg = 'Ingrese el sku de 8 caracteres';
        }elseif (strlen($nombre) < 4) {
            $msg = 'Ingrese un nombre de al menos 4 caracteres';
        }elseif (!$precio) {
            $msg = 'Ingrese el precio';
        }elseif (!$marca) {
            $msg = 'Seleccione una marca';
        }elseif (!$productoTipo) {
            $msg = 'Seleccione un Tipo De Producto';
        }else{

            $row = $productos->getProductoNombre($nombre);

            if($row){
                $msg = 'El nombre del producto ya se encuentra registrado... Intente con otro';

            }
            
    
            else{
                //registrar los productos ingresados en el formulario
                $row = $productos->setProducto($sku,$nombre,$precio,$marca,$productoTipo);

                if ($row) {
                    $msg = 'ok';
                    header('Location: index.php?m=' . $msg);
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
    <title>Producto</title>
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
        <h1>Nuevo Producto</h1>

    
       
        <!-- FORMULARIO -->

        <div class="formulario">
          
            <?php if(isset($msg)): ?>
                <p class="text-danger">
                     <?php echo $msg; ?>
                </p>
            <?php endif; ?>

            <form action="" method="post">
                <div class="form-group">
                    <label for="sku">Sku</label>
                    <input type="text" name="sku" class="form-control" 
                    placeholder="Ingrese el Sku del producto" value ="<?php
                    if(isset($_POST['sku'])) echo $_POST['sku']; ?>">
                </div>

                <div>
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" class="form-control" 
                    placeholder="Ingrese el nombre del producto" value ="<?php
                    if(isset($_POST['nombre'])) echo $_POST['nombre']; ?>">
                </div>

                <div class="form-group">
                    <label for="precio">Precio $</label>
                    <input type="number" name="precio" class="form-control" 
                    placeholder="Ingrese el precio del producto" value ="<?php
                    if(isset($_POST['precio'])) echo $_POST['precio']; ?>">
                </div>
                
                <div class ="form-group">   
                    <label for="marca">Marca</label>
                    <select name="marca" class ="form-control">
                        <option value="">Seleccione...</option>
                        
                       <!--  mostrar la lista de marcas  -->
                       <?php foreach($marcas as $marca): ?>
                        <option value="<?php echo $marca['id'];?>">
                            <?php echo $marca ['nombre']; ?>
                        </option>
                       <?php endforeach;?>
                    </select>
                </div>
                <div class ="form-group">   
                    <label for="productoTipo">Tipo de Producto</label>
                    <select name="productoTipo" class ="form-control">
                        <option value="">Seleccione...</option>
                        
                       <!--  mostrar la lista de productosTipo  -->
                       <?php foreach($productoTipos as $productoTipo): ?>
                        <option value="<?php echo $productoTipo['id'];?>">
                            <?php echo $productoTipo ['nombre']; ?>
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
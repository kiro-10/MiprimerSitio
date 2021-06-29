<?php
  require('class/rutas.php');

  require('class/session.php');
  
  $session = new Session;

?>

<!--Estructura del DOM (Document Objetc Model)--->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Primera Página</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/estilos.css">
    

</head>
<body>
    <!--Aqui se ve todo el codigo por el usuario----> 


  <!----cabercera de sitio del y menu de navegacion---->

<header>  <!-- opcion 1 Generar estilo de linea para cada elemento -->
 
       <!-- Navegador principal del sitio -->
  <?php include("partials/menu.php");?>

</header>

<!-- cuerpo y central de la pagina web -->
<section>
  <h1>Nuestra Historia</h1> 
  <h4> Este es un Subtítulo</h4>
  contenido principal
  <p style="font-size:24px">Lorem ipsum, 
    dolor sit amet consectetur adipisicing elit. 
    Temporibus impedit blanditiis iste ipsa, 
    assumenda quibusdam possimus perferendis, 
    accusantium nihil eligendi, earum totam 
    beatae fuga corrupti hic accusamus 
    similique facere commodi.


    <a href="">Ver Más</a>
  </p>
</section>


<!-- pie de pagina sitio -->
<footer>
  <?php include('partials/footer.php')?>
</footer>
</body>
</html>
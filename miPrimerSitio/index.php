<?php
  require('class/rutas.php');
  require('class/session.php');
  
  $session = new Session;

  
  //echo uniqid();exit;



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

  <?php  include('partials/menu.php'); ?>

  <!----cabercera de sitio del y menu de navegacion---->

 <header>  
   
       <!-- Navegador principal del sitio -->
    

 </header>

<!-- cuerpo y central de la pagina web -->
<section>

  <?php include('../partials/mensajes.php') ?>

  <?php if (isset($_SESSION['autenticado'])):?>
    <h4>Bievenido@<?php echo $_SESSION['usuario_nombre'];?></h4>
  <?php endif;?>
  <h1>Nuestra Empresa</h1> 
  <!-- lado derecho de la pagina -->
  <article class ="derecho">
    <img src="img/zeke.jpeg.jpg" alt="Imagen zeke" >
  </article>
 <!-- lado izquierdo de la pagina -->
  <article class ="izquierdo"> 
    <div class="texto">
      lado izquierdo
      <h3>Bienvenido</h3> 
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusantium modi reprehenderit deleniti in quod. Odit repellendus quae, officia exercitationem beatae neque reprehenderit modi consequatur? Voluptatibus voluptate repudiandae quasi blanditiis recusandae?</p>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Non nesciunt obcaecati sit voluptatibus! Non nisi, commodi repudiandae reprehenderit numquam illo ut! Rerum distinctio quidem aliquid, velit vitae quaerat. Laboriosam, vitae.</p>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro quod totam quasi corporis iure, vero tenetur nisi pariatur odio, animi distinctio vitae ex sint laborum earum veniam quo voluptate eligendi.</p>
    </div>
    <div class="video">
      <iframe width="640" height="360" src="https://www.youtube.com/embed/OpaD2g6uUGI" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </div>
     
  </article>
<!-- pie de pagina sitio -->
</section>

<footer>
  <?php  include('partials/footer.php'); ?>
</footer>
</body>
</html>




<?php if (isset($_GET['m']) && $_GET['m'] == 'ok'): ?>
    <p class= "alet-success">El rol sea registrado correctamente</p>
  <?php endif;?>








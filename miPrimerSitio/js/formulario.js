$(document).ready(function() {
  $("#formulario").validate();
  rules: {
    nombre :{
    required:true
    }
    messages:{
      nombre:{
      required: "Debe ingresar el nombre del rol "
      }
    }
  }
});






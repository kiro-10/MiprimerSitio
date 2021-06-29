<?php
require_once('modelo.php');
class marcaModel extends Modelo
{

    
   public function __construct()
   {
    //utilizar el concstructor de la clase Modelo
    parent::__construct();

   }
//metodo que muestra  todos las marcas de la tabla marcas
public function getMarcas()
{
    $marcas = $this->_db->query("SELECT id,nombre FROM marcas ORDER BY nombre");
    
    return $marcas->fetchall();
}
//metodo que consulta de la table marcas por una marca usando el id
public function getMarcaId($id)
{
    $id = (int) $id;

    $marca = $this->_db->prepare("SELECT id,nombre,created_at,updated_at FROM marcas WHERE id = ?");
    $marca->bindParam(1,$id);
    $marca->execute();
    

    return $marca->fetch();
    
}


//metodo que consulta a la tabla marcas por una marca ingresado (existente)

public function getMarcaNombre($nombre)
{
    $marca = $this->_db->prepare("SELECT id From marcas Where nombre = ?");
    $marca->bindParam(1,$nombre);
    $marca->execute();

    return $marca->fetch(); //vamos recuperar una marca (1 filas)

   
}

//crear un metodo que inserte marcas en la tabla marcas
public function setMarcas($nombre)
{
//consulta para insertar datos
//el metodo prepare sirve para crear una sala de espera sanitizacion de datos antes de ingresar DB
$marca =$this->_db->prepare("INSERT INTO marcas Values(null,?,now(),now() )");
//se realiza operacion de sanitizacion
$marca->bindParam(1,$nombre);
//ejecutamos la consulta y se envian los datos a la tabla marca
$marca->execute();
//consultamos si los datos fueron ingresados,consultados el numero de filas que se ha ingresado

$row = $marca->rowCount(); //nos devolvera el numero de filas insertadas
 
return $row; //disponiblizamos la informacion solicitada para quien la consulte

}

    //Metodo que permite editar una marca
    public function updateMarca($id,$nombre)
    {
        $id = (int) $id;

        $marca=$this->_db->prepare("UPDATE marcas SET nombre =?,updated_at = now() WHERE id = ? ");
        $marca->bindParam(1,$nombre);
        $marca->bindParam(2,$id);
        $marca->execute();

        $row = $marca->rowCount();

        return $row;

    }

    //Metodo que permite  eleminar una marca
    public function deleteMarca($id){

    $id = (int) $id;

    $marca = $this->_db->prepare("DELETE FROM marcas WHERE id= ?");
    $marca->bindParam(1,$id);
    $marca->execute();

    $row = $marca->rowCount();

    return $row;
    }

}
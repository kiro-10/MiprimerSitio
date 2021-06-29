<?php
require_once('modelo.php');
class regionModel extends Modelo
{

   public function __construct()
   {
    //utilizar el concstructor de la clase Modelo
    parent::__construct();

   }
//metodo que muestra  todos las regiones de la tabla regiones
public function getRegiones()
{
    $regiones = $this->_db->query("SELECT id,nombre FROM regiones ORDER BY nombre");
    
    return $regiones->fetchall();
}
//metodo que consulta de la table regiones por una region usando el id
public function getRegionId($id)
{
    $id = (int) $id;

    $region = $this->_db->prepare("SELECT id,nombre,created_at,updated_at FROM regiones WHERE id = ?");
    $region->bindParam(1,$id);
    $region->execute();
    

    return $region->fetch();
    
}


//metodo que consulta a la tabla regiones por una region ingresado (exitente)

public function getRegionNombre($nombre)
{
    $region = $this->_db->prepare("SELECT id From regiones Where nombre = ?");
    $region->bindParam(1,$nombre);
    $region->execute();

    return $region->fetch(); //vamos recuperar un rol (1 filas)

   
}

//crear un metodo que inserte regiones en la tabla regiones
public function setRegiones($nombre)
{
    //consulta para insertar datos
    //el metodo prepare sirve para crear una sala de espera sanitizacion de datos antes de ingresar DB
    $region =$this->_db->prepare("INSERT INTO regiones Values(null,?,now(),now() )");
    //se realiza operacion de sanitizacion
    $region->bindParam(1,$nombre);
    //ejecutamos la consulta y se envian los datos a la tabla region
    $region->execute();
    //consultamos si los datos fueron ingresados,consultados el numero de filas que se ha ingresado

    $row = $region->rowCount(); //nos devolvera el numero de filas insertadas
 
    return $row; //disponiblizamos la informacion solicitada para quien la consulte

}

    //Metodo que edita una region
    public function updateRegion($id,$nombre)
    {
        $id = (int) $id;

        $region=$this->_db->prepare("UPDATE regiones SET nombre =?,updated_at = now() WHERE id = ? ");
        $region->bindParam(1,$nombre);
        $region->bindParam(2,$id);
        $region->execute();

        $row = $region->rowCount();

        return $row;

    }

    //metodo para eleminar una region
    public function deleteRegion($id){

    $id = (int) $id;

    $region = $this->_db->prepare("DELETE FROM regiones WHERE id= ?");
    $region->bindParam(1,$id);
    $region->execute();

    $row = $region->rowCount();

    return $row;
    }

}
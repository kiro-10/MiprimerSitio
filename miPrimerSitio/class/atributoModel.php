<?php
    require_once('modelo.php');

class atributoModel extends Modelo
{
    public function __construct()
    {

        parent::__construct();
    }

    public function getAtributos()
    {

        $atributos = $this->_db->query("SELECT id,nombre FROM atributos ORDER BY nombre");
        
        return $atributos->fetchall();

    }

    public function getAtributoId($id)
    {
        $id = (int) $id;
        $atributo = $this->_db->prepare("SELECT id,nombre FROM atributos WHERE id = ?");
        $atributo->bindParam(1,$id);
        $atributo->execute();

        return $atributo->fetch();

    }

    public function getAtributoNombre($nombre)
    {
        $atributo = $this->_db->prepare("SELECT id FROM atributos WHERE nombre = ?");
        $atributo->bindParam(1,$nombre);
        $atributo->execute();

        return $atributo->fetch();

    }

    public function setAtributos($nombre)
    {
        $atributo = $this->_db->prepare("INSERT INTO atributos VALUES (null,?)");
        $atributo->bindParam(1,$nombre);

        $atributo->execute();

        $row = $atributo->rowCount();

        return $row;
    }

    public function updateAtributo($id,$nombre)
    {
        $id = (int) $id;

        $atributo =$this->_db->prepare("UPDATE atributos SET nombre = ? Where id = ? ");

        $atributo->bindParam(1,$nombre);
        $atributo->bindParam(2,$id);
        $atributo->execute();

        $row = $atributo->rowCount();

        return $row;
    }




    /* public function deleteAtributo($id)
    {

        $id = (int) $id;
        $atributo =  $this->_db->prepare("DELETE FROM atributos WHERE id = ?");
        $atributo->bindParam(1,$id);
        $atributo->execute();

        $row = $atributo->rowCount();

        return $row;
    }   */
}
<?php
    require_once('modelo.php');
    class rolModel extends Modelo
    {   

    public function __construct()
    {
        //utilizar el concstructor de la clase Modelo
        parent::__construct();

    }
    //metodo que muestra  todos los roles de la tabla roles
    public function getRoles()
    {
        $roles = $this->_db->query("SELECT id,nombre FROM roles ORDER BY nombre");
    
        return $roles->fetchall();
    }
    //metodo que consulta a la table roles por un rol usando el id
    public function getRolId($id)
    {
        $id = (int) $id;

        $rol = $this->_db->prepare("SELECT id,nombre,created_at,updated_at FROM roles WHERE id = ?");
        $rol->bindParam(1,$id);
        $rol->execute();
    

        return $rol->fetch();
    
    }


    //metodo que consulta a la tabla roles por un rol ingresado (exitente)

    public function getRolNombre($nombre)
    {
        $rol = $this->_db->prepare("SELECT id From roles Where nombre = ?");
        $rol->bindParam(1,$nombre);
        $rol->execute();

        return $rol->fetch(); //vamos recuperar un rol (1 filas)

   
    }

    //crear un metodo que inserte roles en la tabla roles
    public function setRoles($nombre)
    {
        //consulta para insertar datos
        //el metodo prepare sirve para crear una sala de espera sanitizacion de datos antes de ingresar DB
        $rol =$this->_db->prepare("INSERT INTO roles Values(null,?,now(),now() )");
        //se realiza operacion de sanitizacion
        $rol->bindParam(1,$nombre);
        //ejecutamos la consulta y se envian los datos a la tabla roles
        $rol->execute();
        //consultamos si los datos fueron ingresados,consultados el numero de filas que se ha ingresado

        $row = $rol->rowCount(); //nos devolvera el numero de filas insertadas
 
        return $row; //disponiblizamos la informacion solicitada para quien la consulte
    }

    //Metodo que edita un rol
    public function updateRol($id,$nombre)
    {
        $id = (int) $id;

        $rol=$this->_db->prepare("UPDATE roles SET nombre =?,updated_at = now() WHERE id = ? ");
        $rol->bindParam(1,$nombre);
        $rol->bindParam(2,$id);
        $rol->execute();

        $row = $rol->rowCount();

        return $row;

    }

    //metodo para eleminar roles
    public function deleteRol($id)
    {

        $id = (int) $id;

        $rol = $this->_db->prepare("DELETE FROM roles WHERE id= ?");
        $rol->bindParam(1,$id);
        $rol->execute();

        $row = $rol->rowCount();

        return $row;
    }

}
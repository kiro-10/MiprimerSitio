<?php
    require_once('modelo.php');

    class productoTipoModel extends Modelo 
    {
        public function __construct()
        {
            parent::__construct();
        }

        public function getProductoTipos()
        {
            $productoTipos = $this->_db->query("SELECT id,nombre FROM producto_tipos ORDER BY nombre");
        
            return $productoTipos->fetchall();
        }
        
        public function getProductoTipoId($id)
        {
            $id = (int) $id;
            $productoTipo = $this->_db->prepare("SELECT id,nombre FROM producto_tipos WHERE id = ?");
            $productoTipo->bindParam(1,$id);
            $productoTipo->execute();

            return $productoTipo->fetch();

        }
        public function getProductoTipoNombre($nombre)
        {
            $productoTipo = $this->_db->prepare("SELECT id,nombre FROM producto_tipos WHERE nombre = ?");
            $productoTipo->bindParam(1,$nombre);
            $productoTipo->execute();

            return $productoTipo->fetch();
        }

        public function setProductoTipo($nombre)
        {
            $productoTipo = $this->_db->prepare("INSERT INTO producto_tipos VALUES (null,?)");
            $productoTipo->bindParam(1,$nombre);
            $productoTipo->execute();

            $row = $productoTipo->rowCount();
            return $row;

        }

        public function updateProductoTipo($id,$nombre)
        {
            $id = (int) $id;

            $productoTipo = $this->_db->prepare("UPDATE producto_tipos SET nombre = ? Where id = ? ");
            $productoTipo->bindParam(1,$nombre);
            $productoTipo->bindParam(2,$id);

            $productoTipo->execute();


            $row = $productoTipo->rowCount();

            return $row;


        }
        /*
        public function deleteProductoTipo($id)
        {
            $id = (int) $id;

            $productoTipo = $this->_db->prepare("DELETE FROM producto_tipos WHERE id = ? ");
            $productoTipo->bindParam(1,$id);

            $productoTipo->execute();

            $row = $productoTipo->rowCount();

            return $row;

        
        }
        */
    }
?>
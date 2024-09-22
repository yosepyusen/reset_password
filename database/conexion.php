
<?php 

    class Conexion{

        //propiedades de conexion
        private string $server="localhost";

        private string $db="reseteo_password";

        private string $user="root";

        private string $password="";

        public string $sql;
        
        public $pps=null; 

        private $Conector = null;

        public function getConection(){

            $this->Conector = new PDO(
                "mysql:host=".$this->server.";dbname=".$this->db,
                $this->user,
                $this->password,
            );

            $this->Conector->exec("SET NAMES utf8");

            return $this->Conector;
        }

        public function closeDB(){
            
            if($this->pps != null){
                
                $this->pps = null;
            }
            if($this->Conector != null){
                
                $this->Conector = null;
            }
        }

    }

    $conexion = new Conexion();

    if ($conexion->getConection()) {
        
        echo "Conectado";
    } else {
        
        echo "No conectado";
    }
    

?>
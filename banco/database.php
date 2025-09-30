
<?php

Class Database {

    private $host = '127.0.0.1';

    private $banco = "shifnode";

    private $usuario = "root";

    private $senha = "";

    public $con;

    public function conectar(){
        $this->con = null;

        try {
            $this->con = new PDO("mysql:host=$this->bacnp;dbname=$this->banco", $this->usuario, $this->senha);
        } catch (PDOException $e) {

            echo "Erro ao Conectar: " . $e->getMessage();

        }

        return $this->con;

    }

}

?>


<?php
class Database {
    private $host = 'localhost';
    private $port = '3316'; 
    private $banco = "shift_node";
    private $usuario = "root";
    private $senha = "123456";
    public $con;

    public function conectar(){
        $this->con = null;
        try {
           
            $dsn = "mysql:host=$this->host;port=$this->port;dbname=$this->banco";
            $this->con = new PDO($dsn, $this->usuario, $this->senha);
            $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
           
            return $this->con;
        } catch (PDOException $e) {
            echo "❌ Erro: " . $e->getMessage();
            return null;
        }
    }
}

$db = new Database();
$conn = $db->conectar();
?>

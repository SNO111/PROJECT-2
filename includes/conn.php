<?php 
class Database {
    private $server = "mysql:host=localhost;dbname=project2-ecomm";
    private $username = "root";
    private $password = "";
    private $options = array(
                                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
                                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                            );
    protected $comm;

    public function open() {
        try {
            $this->comm = new PDO($this->server, $this->username, $this->password, $this->options);
            return $this->comm;

        } catch (PDOException $e) {
            echo "There is some problem in connection" .  $e->getMessage();
        }
    }

    public function close() {
        $this->comm = null;
    }
}

$pdo = new Database();

?>
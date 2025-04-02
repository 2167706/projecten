
<?php

class DB {
    private $dbh;
    protected $stmt;
    public function __construct($db, $host = "localhost", $user = "root", $pass = "")
    {
        try {
            $this->dbh = new PDO("mysql: host=$host; dbname=$db;", $user, $pass);
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connection error: " . $e->getMessage());
        }
    }
    public function execute($sql, $placeholders = null) {
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute($placeholders);
        return $stmt;
    }

}
$myDb = new DB('eindopdracht');


?>
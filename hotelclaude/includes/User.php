<?php
// includes/User.php
class User {
    private $conn;
    private $table_name = "Users";
    
    // Object properties
    public $userID;
    public $username;
    public $password;
    public $fullName;
    public $role;
    
    // Constructor with database connection
    public function __construct($db) {
        $this->conn = $db;
    }
    
    // User login
    public function login() {
        $query = "SELECT UserID, Username, Password, FullName, Role 
                FROM " . $this->table_name . " 
                WHERE Username = ?";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->username);
        $stmt->execute();
        
        $num = $stmt->rowCount();
        
        if($num > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->userID = $row['UserID'];
            $this->fullName = $row['FullName'];
            $this->role = $row['Role'];
            
            // Verify password
            if(password_verify($this->password, $row['Password'])) {
                return true;
            }
        }
        
        return false;
    }
}
?>
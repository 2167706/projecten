<?php
// includes/Customer.php
class Customer {
    private $conn;
    private $table_name = "Customers";
    
    // Object properties
    public $customerID;
    public $firstName;
    public $lastName;
    public $email;
    public $phone;
    public $address;
    
    // Constructor with database connection
    public function __construct($db) {
        $this->conn = $db;
    }
    
    // Create customer
    public function createCustomer() {
        // Check if customer already exists
        $check_query = "SELECT CustomerID FROM " . $this->table_name . " WHERE Email = ?";
        $check_stmt = $this->conn->prepare($check_query);
        $check_stmt->bindParam(1, $this->email);
        $check_stmt->execute();
        
        if($check_stmt->rowCount() > 0) {
            $row = $check_stmt->fetch(PDO::FETCH_ASSOC);
            $this->customerID = $row['CustomerID'];
            return true;
        }
        
        // Create new customer if not exists
        $query = "INSERT INTO " . $this->table_name . "
                (FirstName, LastName, Email, Phone, Address)
                VALUES (?, ?, ?, ?, ?)";
        
        $stmt = $this->conn->prepare($query);
        
        // Sanitize input
        $this->firstName = htmlspecialchars(strip_tags($this->firstName));
        $this->lastName = htmlspecialchars(strip_tags($this->lastName));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->phone = htmlspecialchars(strip_tags($this->phone));
        $this->address = htmlspecialchars(strip_tags($this->address));
        
        // Bind parameters
        $stmt->bindParam(1, $this->firstName);
        $stmt->bindParam(2, $this->lastName);
        $stmt->bindParam(3, $this->email);
        $stmt->bindParam(4, $this->phone);
        $stmt->bindParam(5, $this->address);
        
        if($stmt->execute()) {
            $this->customerID = $this->conn->lastInsertId();
            return true;
        }
        
        return false;
    }
    
    // Get customer by ID
    public function getCustomerById($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE CustomerID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        $this->customerID = $row['CustomerID'];
        $this->firstName = $row['FirstName'];
        $this->lastName = $row['LastName'];
        $this->email = $row['Email'];
        $this->phone = $row['Phone'];
        $this->address = $row['Address'];
        
        return $stmt;
    }
}
?>
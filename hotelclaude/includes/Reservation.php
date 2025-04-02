<?php
// includes/Reservation.php
class Reservation {
    private $conn;
    private $table_name = "Reservations";
    private $details_table = "ReservationDetails";
    
    // Object properties
    public $reservationID;
    public $customerID;
    public $checkInDate;
    public $checkOutDate;
    public $totalPrice;
    public $reservationDate;
    public $status;
    
    // Constructor with database connection
    public function __construct($db) {
        $this->conn = $db;
    }
    
    // Create reservation
    public function createReservation($customerID, $checkInDate, $checkOutDate, $totalPrice, $roomIDs) {
        // Start transaction
        $this->conn->beginTransaction();
        
        try {
            // Insert into Reservations table
            $query = "INSERT INTO " . $this->table_name . "
                    (CustomerID, CheckInDate, CheckOutDate, TotalPrice, ReservationDate, Status)
                    VALUES (?, ?, ?, ?, NOW(), 'Confirmed')";
            
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $customerID);
            $stmt->bindParam(2, $checkInDate);
            $stmt->bindParam(3, $checkOutDate);
            $stmt->bindParam(4, $totalPrice);
            
            if(!$stmt->execute()) {
                throw new Exception("Error creating reservation");
            }
            
            $this->reservationID = $this->conn->lastInsertId();
            
            // Insert into ReservationDetails table
            // For each day in the date range and for each room
            $current_date = new DateTime($checkInDate);
            $end_date = new DateTime($checkOutDate);
            
            while($current_date < $end_date) {
                $date_str = $current_date->format('Y-m-d');
                
                foreach($roomIDs as $roomID) {
                    $detail_query = "INSERT INTO " . $this->details_table . "
                                    (ReservationID, RoomID, Date)
                                    VALUES (?, ?, ?)";
                    
                    $detail_stmt = $this->conn->prepare($detail_query);
                    $detail_stmt->bindParam(1, $this->reservationID);
                    $detail_stmt->bindParam(2, $roomID);
                    $detail_stmt->bindParam(3, $date_str);
                    
                    if(!$detail_stmt->execute()) {
                        throw new Exception("Error creating reservation details");
                    }
                }
                
                $current_date->modify('+1 day');
            }
            
            // Commit the transaction
            $this->conn->commit();
            return true;
            
        } catch(Exception $e) {
            // Roll back the transaction if something failed
            $this->conn->rollback();
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    
    // Get all reservations
    public function getAllReservations() {
        $query = "SELECT r.*, c.FirstName, c.LastName
                FROM " . $this->table_name . " r
                JOIN Customers c ON r.CustomerID = c.CustomerID
                ORDER BY r.CheckInDate DESC";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        
        return $stmt;
    }
    
    // Get reservation by ID
    public function getReservationById($id) {
        $query = "SELECT r.*, c.FirstName, c.LastName, c.Email, c.Phone
                FROM " . $this->table_name . " r
                JOIN Customers c ON r.CustomerID = c.CustomerID
                WHERE r.ReservationID = ?";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        
        return $stmt;
    }
    
    // Get rooms for a reservation
    public function getReservationRooms($id) {
        $query = "SELECT r.RoomNumber, r.RoomType, r.Description, r.PricePerNight, rd.Date
                FROM " . $this->details_table . " rd
                JOIN Rooms r ON rd.RoomID = r.RoomID
                WHERE rd.ReservationID = ?
                ORDER BY rd.Date, r.RoomNumber";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        
        return $stmt;
    }
    
    // Update reservation status
    public function updateStatus($id, $status) {
        $query = "UPDATE " . $this->table_name . "
                SET Status = ?
                WHERE ReservationID = ?";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $status);
        $stmt->bindParam(2, $id);
        
        if($stmt->execute()) {
            return true;
        }
        
        return false;
    }
    
    // Delete reservation
    public function deleteReservation($id) {
        // Start transaction
        $this->conn->beginTransaction();
        
        try {
            // Delete from ReservationDetails table first (due to foreign key)
            $detail_query = "DELETE FROM " . $this->details_table . " WHERE ReservationID = ?";
            $detail_stmt = $this->conn->prepare($detail_query);
            $detail_stmt->bindParam(1, $id);
            
            if(!$detail_stmt->execute()) {
                throw new Exception("Error deleting reservation details");
            }
            
            // Delete from Reservations table
            $query = "DELETE FROM " . $this->table_name . " WHERE ReservationID = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $id);
            
            if(!$stmt->execute()) {
                throw new Exception("Error deleting reservation");
            }
            
            // Commit the transaction
            $this->conn->commit();
            return true;
            
        } catch(Exception $e) {
            // Roll back the transaction if something failed
            $this->conn->rollback();
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}
?>
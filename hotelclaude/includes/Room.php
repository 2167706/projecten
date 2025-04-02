<?php
// includes/Room.php
class Room {
    private $conn;
    private $table_name = "Rooms";
    
    // Object properties
    public $roomID;
    public $roomNumber;
    public $roomType;
    public $description;
    public $pricePerNight;
    
    // Constructor with database connection
    public function __construct($db) {
        $this->conn = $db;
    }
    
    // Get all rooms
    public function getAllRooms() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        
        return $stmt;
    }
    
    // Get room by ID
    public function getRoomById($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE RoomID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        $this->roomID = $row['RoomID'];
        $this->roomNumber = $row['RoomNumber'];
        $this->roomType = $row['RoomType'];
        $this->description = $row['Description'];
        $this->pricePerNight = $row['PricePerNight'];
        
        return $stmt;
    }
    
    // Check room availability for a specific date range
    public function checkAvailability($checkInDate, $checkOutDate) {
        $query = "SELECT r.RoomID, r.RoomNumber, r.RoomType, r.Description, r.PricePerNight
                 FROM " . $this->table_name . " r
                 WHERE r.RoomID NOT IN (
                     SELECT rd.RoomID 
                     FROM ReservationDetails rd
                     JOIN Reservations res ON rd.ReservationID = res.ReservationID
                     WHERE (rd.Date BETWEEN ? AND ?) 
                     AND res.Status = 'Confirmed'
                 )
                 ORDER BY r.RoomNumber";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $checkInDate);
        $stmt->bindParam(2, $checkOutDate);
        $stmt->execute();
        
        return $stmt;
    }
    
    // Count available rooms for a specific date
    public function countAvailableRooms($date) {
        $query = "SELECT COUNT(*) as available_count
                 FROM " . $this->table_name . " r
                 WHERE r.RoomID NOT IN (
                     SELECT rd.RoomID 
                     FROM ReservationDetails rd
                     JOIN Reservations res ON rd.ReservationID = res.ReservationID
                     WHERE rd.Date = ? 
                     AND res.Status = 'Confirmed'
                 )";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $date);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['available_count'];
    }
}
?>
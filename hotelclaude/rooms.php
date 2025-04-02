<?php
// rooms.php
include_once 'includes/header.php';

$room = new Room($db);
$stmt = $room->getAllRooms();
?>

<div class="container py-5">
    <h1 class="mb-4">Onze Kamers</h1>
    
    <div class="row">
        <?php while($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
            <div class="col-md-4 mb-4">
                <div class="card room-card">
                    <img src="assets/img/room-<?php echo $row['RoomID']; ?>.jpg" class="card-img-top" alt="<?php echo $row['RoomType']; ?> Room" onerror="this.src='assets/img/room-default.jpg'">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $row['RoomType']; ?> Kamer</h5>
                        <p class="card-text"><?php echo $row['Description']; ?></p>
                        <p class="price">€<?php echo number_format($row['PricePerNight'], 2); ?> per nacht</p>
                        <a href="reservation.php?room=<?php echo $row['RoomID']; ?>" class="btn btn-primary">Reserveer Nu</a>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
    
    <div class="card mt-5">
        <div class="card-body">
            <h5 class="card-title">Faciliteiten in alle kamers</h5>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><i class="fas fa-wifi me-2"></i> Gratis WiFi</li>
                <li class="list-group-item"><i class="fas fa-tv me-2"></i> Flatscreen TV</li>
                <li class="list-group-item"><i class="fas fa-shower me-2"></i> Eigen badkamer met douche</li>
                <li class="list-group-item"><i class="fas fa-coffee me-2"></i> Koffie- en theefaciliteiten</li>
                <li class="list-group-item"><i class="fas fa-snowflake me-2"></i> Airconditioning</li>
                <li class="list-group-item"><i class="fas fa-phone me-2"></i> Telefoon</li>
            </ul>
        </div>
    </div>
</div>

<?php include_once 'includes/footer.php'; ?>
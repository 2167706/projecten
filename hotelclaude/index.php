<?php
// index.php (continued)
include_once 'includes/header.php';
?>

<section class="hero">
    <div class="container">
        <h1>Welkom bij Hotel Ter Duin</h1>
        <p>Geniet van een onvergetelijk verblijf aan de Nederlandse kust</p>
        <a href="reservation.php" class="btn btn-primary btn-lg">Reserveer Nu</a>
    </div>
</section>

<section class="features">
    <div class="container">
        <h2 class="text-center mb-4">Onze Voorzieningen</h2>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-wifi fa-3x mb-3 text-primary"></i>
                        <h5 class="card-title">Gratis WiFi</h5>
                        <p class="card-text">Blijf verbonden met snel en betrouwbaar internet in het hele hotel.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-utensils fa-3x mb-3 text-primary"></i>
                        <h5 class="card-title">Restaurant</h5>
                        <p class="card-text">Geniet van heerlijke maaltijden in ons restaurant met uitzicht op zee.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-swimming-pool fa-3x mb-3 text-primary"></i>
                        <h5 class="card-title">Zwembad</h5>
                        <p class="card-text">Ontspan in ons binnenzwembad met sauna en stoombad.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="featured-rooms">
    <div class="container">
        <h2 class="text-center mb-4">Populaire Kamers</h2>
        <div class="row">
            <?php
            $room = new Room($db);
            $stmt = $room->getAllRooms();
            
            $count = 0;
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                if($count >= 3) break; // Only show 3 rooms on homepage
                
                echo '<div class="col-md-4 mb-4">
                        <div class="card room-card">
                            <img src="assets/img/room-' . $row['RoomID'] . '.jpg" class="card-img-top" alt="' . $row['RoomType'] . ' Room" onerror="this.src=\'assets/img/room-default.jpg\'">
                            <div class="card-body">
                                <h5 class="card-title">' . $row['RoomType'] . ' Kamer</h5>
                                <p class="card-text">' . $row['Description'] . '</p>
                                <p class="price">€' . number_format($row['PricePerNight'], 2) . ' per nacht</p>
                                <a href="rooms.php" class="btn btn-primary">Meer Informatie</a>
                            </div>
                        </div>
                    </div>';
                
                $count++;
            }
            ?>
        </div>
        <div class="text-center mt-4">
            <a href="rooms.php" class="btn btn-outline-primary">Bekijk Alle Kamers</a>
        </div>
    </div>
</section>

<section class="testimonials bg-light py-5 mt-5">
    <div class="container">
        <h2 class="text-center mb-4">Wat Onze Gasten Zeggen</h2>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="mb-3 text-warning">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p class="card-text">"Geweldig hotel met prachtig uitzicht op zee. Het personeel is zeer vriendelijk en behulpzaam. Zeker een aanrader!"</p>
                        <p class="card-subtitle text-end text-muted">- Sanne van Dijk</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="mb-3 text-warning">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                        <p class="card-text">"De kamers zijn ruim en schoon, het ontbijt was heerlijk en gevarieerd. We komen zeker terug!"</p>
                        <p class="card-subtitle text-end text-muted">- Mark Jansen</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="mb-3 text-warning">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p class="card-text">"Perfect gelegen dichtbij het strand. De service was uitstekend en het personeel deed er alles aan om ons verblijf aangenaam te maken."</p>
                        <p class="card-subtitle text-end text-muted">- Lisa de Vries</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include_once 'includes/footer.php'; ?>
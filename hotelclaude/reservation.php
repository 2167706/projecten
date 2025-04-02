<?php
// reservation.php
include_once 'includes/header.php';

// Check for selected room ID from rooms page
$selected_room = isset($_GET['room']) ? intval($_GET['room']) : null;

$room = new Room($db);
$all_rooms = $room->getAllRooms();

// Default check-in and check-out dates (today + 1 day, and today + 2 days)
$default_checkin = date('Y-m-d', strtotime('+1 day'));
$default_checkout = date('Y-m-d', strtotime('+2 days'));

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Form processing will be implemented in Phase 3
    // This will include:
    // 1. Validating input
    // 2. Checking room availability
    // 3. Creating customer record
    // 4. Creating reservation
    // 5. Redirecting to confirmation page
}
?>

<div class="container py-5">
    <h1 class="mb-4">Reserveer een Kamer</h1>
    
    <?php
    // Check room availability for today
    $today = date('Y-m-d');
    $available_count = $room->countAvailableRooms($today);
    
    // Show warning if only 2 rooms left
    if ($available_count <= 2) {
        echo '<div class="alert alert-warning mb-4">
                <i class="fas fa-exclamation-triangle me-2"></i> 
                Let op: Er zijn nog maar ' . $available_count . ' kamers beschikbaar voor vandaag!
              </div>';
    }
    ?>
    
    <div class="row">
        <div class="col-md-8">
            <div class="card reservation-form">
                <div class="card-body">
                    <h5 class="card-title mb-4">Reserveringsformulier</h5>
                    
                    <form method="post" action="reservation_process.php">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="checkin" class="form-label">Inchecken</label>
                                <input type="date" class="form-control" id="checkin" name="checkin" min="<?php echo date('Y-m-d'); ?>" value="<?php echo $default_checkin; ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label for="checkout" class="form-label">Uitchecken</label>
                                <input type="date" class="form-control" id="checkout" name="checkout" min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>" value="<?php echo $default_checkout; ?>" required>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="room" class="form-label">Kamertype</label>
                            <select class="form-select" id="room" name="room_id" required>
                                <option value="">Selecteer een kamer</option>
                                <?php 
                                $all_rooms->execute();
                                while($row = $all_rooms->fetch(PDO::FETCH_ASSOC)): 
                                    $selected = ($row['RoomID'] == $selected_room) ? 'selected' : '';
                                ?>
                                    <option value="<?php echo $row['RoomID']; ?>" <?php echo $selected; ?>>
                                        <?php echo $row['RoomType']; ?> Kamer - €<?php echo number_format($row['PricePerNight'], 2); ?> per nacht
                                    </option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        
                        <hr class="my-4">
                        
                        <h5 class="mb-3">Persoonlijke gegevens</h5>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="first_name" class="form-label">Voornaam</label>
                                <input type="text" class="form-control" id="first_name" name="first_name" required>
                            </div>
                            <div class="col-md-6">
                                <label for="last_name" class="form-label">Achternaam</label>
                                <input type="text" class="form-control" id="last_name" name="last_name" required>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="email" class="form-label">E-mail</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="phone" class="form-label">Telefoonnummer</label>
                            <input type="tel" class="form-control" id="phone" name="phone" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="address" class="form-label">Adres</label>
                            <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
                        </div>
                        
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="terms" required>
                            <label class="form-check-label" for="terms">Ik ga akkoord met de algemene voorwaarden</label>
                        </div>
                        
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary btn-lg flex-grow-1">Reserveren</button>
                            <button type="button" class="btn btn-secondary btn-lg" onclick="window.print();">
                                <i class="fas fa-print"></i> Afdrukken
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Reserveringsinformatie</h5>
                    <p>Reserveren kan eenvoudig via dit formulier. Vul alle verplichte velden in en klik op 'Reserveren'.</p>
                    <hr>
                    <h6>Betalingsinformatie</h6>
                    <p>De betaling geschiedt bij aankomst in het hotel. We accepteren contant geld, pinpas en creditcard.</p>
                    <hr>
                    <h6>Annuleringsvoorwaarden</h6>
                    <p>Annuleren kan tot 24 uur voor aankomst zonder kosten. Bij latere annulering wordt één nacht in rekening gebracht.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Simple client-side validation for reservation form
document.addEventListener('DOMContentLoaded', function() {
    const checkinInput = document.getElementById('checkin');
    const checkoutInput = document.getElementById('checkout');
    
    // Ensure checkout date is after checkin date
    checkinInput.addEventListener('change', function() {
        const checkinDate = new Date(this.value);
        const checkoutDate = new Date(checkoutInput.value);
        
        // Add one day to checkin date for minimum checkout
        const minCheckoutDate = new Date(checkinDate);
        minCheckoutDate.setDate(minCheckoutDate.getDate() + 1);
        
        // Set minimum checkout date
        checkoutInput.min = minCheckoutDate.toISOString().split('T')[0];
        
        // If current checkout date is before new checkin date, update it
        if (checkoutDate <= checkinDate) {
            checkoutInput.value = minCheckoutDate.toISOString().split('T')[0];
        }
    });
});
</script>

<?php include_once 'includes/footer.php'; ?>
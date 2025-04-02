<?php
// contact.php
include_once 'includes/header.php';
?>

<div class="container py-5">
    <h1 class="mb-4">Contact</h1>
    
    <div class="row">
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Adresgegevens</h5>
                    <address>
                        <strong>Hotel Ter Duin</strong><br>
                        Duinweg 145<br>
                        2585 JV Den Haag<br>
                        Nederland<br><br>
                        <i class="fas fa-phone"></i> +31 70 123 4567<br>
                        <i class="fas fa-envelope"></i> <a href="mailto:info@hotelterduin.nl">info@hotelterduin.nl</a>
                    </address>
                </div>
            </div>
            
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Openingstijden Receptie</h5>
                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <td>Maandag - Vrijdag:</td>
                                <td>07:00 - 23:00</td>
                            </tr>
                            <tr>
                                <td>Zaterdag - Zondag:</td>
                                <td>08:00 - 22:00</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Stuur ons een bericht</h5>
                    <form>
                        <div class="mb-3">
                            <label for="name" class="form-label">Naam</label>
                            <input type="text" class="form-control" id="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">E-mail</label>
                            <input type="email" class="form-control" id="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="subject" class="form-label">Onderwerp</label>
                            <input type="text" class="form-control" id="subject" required>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Bericht</label>
                            <textarea class="form-control" id="message" rows="5" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Versturen</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <div class="mt-5">
        <h5>Locatie</h5>
        <div class="ratio ratio-16x9">
            <!-- Placeholder for a map (in a real application, include a Google Maps embed or similar) -->
            <div class="bg-light d-flex align-items-center justify-content-center">
                <p class="text-muted">Hier zou een kaart met de locatie van Hotel Ter Duin worden weergegeven.</p>
            </div>
        </div>
        <p class="mt-3">
            <i class="fas fa-car"></i> <strong>Met de auto:</strong> Vanaf de A12, neem afslag 8 richting Scheveningen. Volg de borden naar Duinweg.<br>
            <i class="fas fa-train"></i> <strong>Met het openbaar vervoer:</strong> Vanaf Den Haag Centraal Station, neem tram 1 richting Scheveningen en stap uit bij halte Duinweg.
        </p>
    </div>
</div>

<?php include_once 'includes/footer.php'; ?>
<?php
require_once '../model/VenueModel.php';

if (!isset($_GET['q'])) {
    die();
}

$query = trim($_GET['q']);

$venueModel = new VenueModel();
$venues = $venueModel->searchVenuesByName($query);

if (!empty($venues)) {
    foreach ($venues as $venue) {
        echo "<p onclick='selectVenue(\"" . htmlspecialchars($venue['Name']) . "\")'>" . htmlspecialchars($venue['Name']) . " - " . htmlspecialchars($venue['Location']) . "</p>";
    }
} else {
    echo "<p>No matching venues found.</p>";
}
?>

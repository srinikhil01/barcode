<?php
// Set content type to JSON to ensure response is treated correctly
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the barcode value from POST request
    $barcode = $_POST['barcode'];

    // Database connection and barcode insertion
    try {
        // Ensure database credentials are correct
        $pdo = new PDO('mysql:host=localhost;dbname=bel1', 'root', '');

        // Prepare SQL query to insert barcode
        $stmt = $pdo->prepare('INSERT INTO scanned_barcodes (barcode_value) VALUES (?)');
        $stmt->execute([$barcode]);

        // Return success response
        echo json_encode(['message' => 'Barcode saved successfully']);
    } catch (PDOException $e) {
        // Return error response with detailed error message
        echo json_encode(['message' => 'Error saving barcode: ' . $e->getMessage()]);
    }
}
?>

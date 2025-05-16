<?php
require_once 'config.php';

header('Content-Type: application/json');

if (!isset($_GET['id'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Trophy ID is required']);
    exit;
}

$trophyId = intval($_GET['id']);

try {
    $stmt = $pdo->prepare("SELECT * FROM trophies WHERE id = ?");
    $stmt->execute([$trophyId]);
    $trophy = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$trophy) {
        http_response_code(404);
        echo json_encode(['error' => 'Trophy not found']);
        exit;
    }
    
    // Format the response
    $response = [
        'description' => $trophy['description'],
        'times_won' => $trophy['times_won'],
        'first_win' => $trophy['first_win'],
        'last_win' => $trophy['last_win']
    ];
    
    echo json_encode($response);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Database error']);
} 
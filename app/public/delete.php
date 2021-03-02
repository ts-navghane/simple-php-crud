<?php

declare(strict_types=1);

$success = true;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST['id'] ?? 0;
    require '../config/database.php';
    $data = ['id' => $id];
    $sql = "DELETE FROM users WHERE id = :id;";
    $stmt = $conn->prepare($sql);
    $success = $stmt->execute($data);
    $stmt->closeCursor();
}

header('Content-type: application/json');
echo json_encode(['success' => $success], JSON_THROW_ON_ERROR);
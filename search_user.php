<?php
include 'db.php';

$searchTerm = $_GET['query'] ?? '';

$sql = "SELECT * FROM users WHERE full_name LIKE ? OR id LIKE ?";

$stmt = $conn->prepare($sql);
$searchWildcard = '%' . $searchTerm . '%';
$stmt->bind_param("ss", $searchWildcard, $searchWildcard);

$stmt->execute();
$result = $stmt->get_result();

$users = [];

while ($row = $result->fetch_assoc()) {
    $users[] = $row;
}

echo json_encode($users);

$stmt->close();
$conn->close();
?>
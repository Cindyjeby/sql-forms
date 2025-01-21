<?php
include 'db.php';

$sql = "SELECT * FROM users";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $users = array();
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
    echo json_encode($users); // Send the data as JSON
} else {
    echo json_encode([]); // Empty array if no users
}

$conn->close();
?>
<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name = $_POST['full_name'];
    $national_id = $_POST['national_id'];
    $passport_no = $_POST['passport_no'] ?? null;
    $kra_pin = $_POST['kra_no'];
    $bank_name = $_POST['bank_name'];
    $account_no = $_POST['account_no'];
    $amount_usd = $_POST['amount_usd'];
    $account_status = $_POST['account_status'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "INSERT INTO users (full_name, national_id, passport_no, kra_pin, bank_name, account_no, amount_usd, account_status, username, password)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssdsis", $full_name, $national_id, $passport_no, $kra_pin, $bank_name, $account_no, $amount_usd, $account_status, $username, $password);

    if ($stmt->execute()) {
        // Redirect to the admin page after successful registration
        header("Location: admin.html");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
}
?>
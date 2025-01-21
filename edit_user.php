<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $full_name = $_POST['full_name'];
    $national_id = $_POST['national_id'];
    $passport_no = $_POST['passport_no'] ?? null;
    $kra_pin = $_POST['kra_pin'];
    $bank_name = $_POST['bank_name'];
    $account_no = $_POST['account_no'];
    $amount_usd = $_POST['amount_usd'];
    $account_status = $_POST['account_status'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "UPDATE users SET 
            full_name = ?, 
            national_id = ?, 
            passport_no = ?, 
            kra_pin = ?, 
            bank_name = ?, 
            account_no = ?, 
            amount_usd = ?, 
            account_status = ?, 
            username = ?, 
            password = ? 
            WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "ssssssdsisi", 
        $full_name, 
        $national_id, 
        $passport_no, 
        $kra_pin, 
        $bank_name, 
        $account_no, 
        $amount_usd, 
        $account_status, 
        $username, 
        $password, 
        $id
    );

    if ($stmt->execute()) {
        echo "User updated successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
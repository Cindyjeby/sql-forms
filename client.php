<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $national_id = $_POST['national_id'];
    $kra_no = $_POST['kra_no'];
    $password = $_POST['password'];

    // Fetch user details based on credentials
    $sql = "SELECT * FROM users WHERE national_id = ? AND kra_pin = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $national_id, $kra_no);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verify password
        // if (password_verify($password, $user['password']))
        if ($password === $user['password']) {
            // Output the HTML page directly
            ?>
            <!DOCTYPE html>
            <html>
              <head>
                <title>Client Details </title>
                <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
                <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
                <style>
                  html, body {
                    display: flex;
                    justify-content: center;
                    height: 100%;
                  }
                  body, div, h1, form, input, p { 
                    padding: 0;
                    margin: 0;
                    outline: none;
                    font-family: Roboto, Arial, sans-serif;
                    font-size: 16px;
                    color: #666;
                  }
                  h1 {
                    padding: 10px 0;
                    font-size: 32px;
                    font-weight: 300;
                    text-align: center;
                  }
                  p {
                    font-size: 12px;
                  }
                  hr {
                    color: #a9a9a9;
                    opacity: 0.3;
                  }
                  .main-block {
                    width: 400px; 
                    min-height: 460px; 
                    padding: 10px 20px;
                    margin: auto;
                    border-radius: 5px; 
                    border: solid 1px #ccc;
                    box-shadow: 1px 2px 5px rgba(0,0,0,.31); 
                    background: #ffffff; 
                  }
                  .btn-block {
                    margin-top: 10px;
                    text-align: center;
                  }
                  button {
                    width: 100%;
                    padding: 10px 0;
                    margin: 10px auto;
                    border-radius: 5px; 
                    border: none;
                    background: #1c87c9; 
                    font-size: 14px;
                    font-weight: 600;
                    color: #fff;
                  }
                  button:hover {
                    background: #26a9e0;
                  }
                </style>
              </head>
              <body>
                <div class="main-block">
                  <h1>
                    <img src="images/NewLogoCBK.png" alt="CBK" width="108" height="100" longdesc="http://www.centralbankkenya.co.ke">
                  </h1>
                  <h3 align="center"><strong>Client Details</strong></h3>
                  <hr>
                  <div align="center">Your Details are as follows:</div>
                  <hr>
                  <strong>Full Name:</strong><br>
                  <?php echo htmlspecialchars($user['full_name']); ?><br>
                  <hr>
                  <strong>National ID/Passport No:</strong><br>
                  <?php echo htmlspecialchars($user['national_id']); ?><br>
                  <hr>
                  <strong>KRA PIN No.:</strong><br>
                  <?php echo htmlspecialchars($user['kra_pin']); ?><br>
                  <hr>
                  <strong>Bank:</strong><br>
                  <?php echo htmlspecialchars($user['bank_name']); ?><br>
                  <hr>
                  <strong>Bank Account:</strong><br>
                  <?php echo htmlspecialchars($user['account_no']); ?><br>
                  <hr>
                  <strong>Amount USD:</strong><br>
                  KES <?php echo htmlspecialchars($user['amount_usd']); ?><br>
                  <hr>
                  <strong>Account Status:</strong><br>
                  <?php echo htmlspecialchars($user['account_status']); ?><br>
                  <hr>
                </div>
              </body>
            </html>
            <?php
        } else {
            echo "<p>Incorrect password. Please try again.</p>";
        }
    } else {
        echo "<p>No user found with the provided National ID and KRA PIN.</p>";
    }

    $stmt->close();
    $conn->close();
}
?>
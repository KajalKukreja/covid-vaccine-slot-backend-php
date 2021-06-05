<?php
    require "dbconfig.php";
    
    // Create connection
    $conn = new mysqli($DB_HOST.":".$DB_PORT, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $email = $_GET['email'];
    
    $sql = "DELETE FROM member WHERE email LIKE ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $email);
    $result = $stmt->execute();
    $stmt->close();
    $conn->close();

    if ($result) {
        error_log("User unsubscribed : ".$email, 3, 'cron_logs.log');
        echo "<p style='font-family: -apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica,Arial,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol;'>You have been unsubscribed.</p>
        <p style='font-family: -apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica,Arial,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol;'>You can visit <a href='http://covid.kajalkukreja.com'>http://covid.kajalkukreja.com</a> if you want to get alerts again.</p>";
    }
    else {
        error_log("Failed to unsubscribe user : ".$email, 3, 'cron_logs.log');
        echo "<p style='font-family: -apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica,Arial,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol;'>There's some problem. Please contact me at <a href='mailto: kajalkukreja694@gmail.com'>kajalkukreja694@gmail.com</a></p>";
    }
?>
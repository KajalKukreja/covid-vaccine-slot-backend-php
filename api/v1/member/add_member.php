<?php
    header("Access-Control-Allow-Origin: http://localhost:4200");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers");
    header("Access-Control-Allow-Methods: POST");

    require "../dbconfig.php";
    
    // Create connection
    $conn = new mysqli($DB_HOST.":".$DB_PORT, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $email = $_GET['email'];
    $mobile_no = $_GET['mobile_no'];
    $pincode = $_GET['pincode'];
    $district_id = $_GET['district_id'];

    $sql = "INSERT INTO member(email, mobile_no, pincode, district_id) VALUES(?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('siii', $email, $mobile_no, $pincode, $district_id);
    $result = $stmt->execute();
    $stmt->close();
    $conn->close();

    echo $result;
?>
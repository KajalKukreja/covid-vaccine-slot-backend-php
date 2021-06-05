<?php
    header("Access-Control-Allow-Origin: http://localhost:4200");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers");
    header("Access-Control-Allow-Methods: GET, POST");

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
    $age = $_GET['age'];
    $dose = $_GET['dose'];
    
    $sql = "INSERT INTO member(email, mobile_no, pincode, district_id, age, dose) VALUES(?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('siiiis', $email, $mobile_no, $pincode, $district_id, $age, $dose);
    $result = $stmt->execute();
    $stmt->close();
    $conn->close();

    if ($result) {
        $log_msg = "\nNew user added - Email : ".$email." Pincode : ".$pincode." District ID : ".$district_id." Age : ".$age." Dose : ".$dose;
        error_log($log_msg, 3, '../logs/new_user_logs.log');
    }
    else {        
        $log_msg = "\nFailed to add new user - Email : ".$email." Pincode : ".$pincode." District ID : ".$district_id." Age : ".$age." Dose : ".$dose;
        error_log($log_msg, 3, '../logs/new_user_logs.log');
    }
    echo $result;
?>
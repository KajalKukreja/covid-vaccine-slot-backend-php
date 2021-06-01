<?php
    require "dbconfig.php";
    require "get_available_slots.php";
    require "send_emails.php";
    require "member/member.php";
    
    // Create connection
    $conn = new mysqli($DB_HOST.":".$DB_PORT, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM member";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $data_by_pincode = array();
        $data_by_district_id = array();

        while($row = $result->fetch_assoc()) {
            $time_slots = array();
            $member = new Member($row["id"], $row["email"], $row["mobile_no"], $row["pincode"], $row["district_id"]);
            echo "<br/>".$member->get_id()." ".$member->get_email()." ".$member->get_mobile_no()." ".$member->get_pincode()." ".$member->get_district_id()."<br/>";

            if ($member->get_pincode() != null && 
                strlen(trim($member->get_pincode())) > 0 && 
                $member->get_pincode() != 0) 
            {
                if (array_key_exists($member->get_pincode(), $data_by_pincode)) {
                    $time_slots = $data_by_pincode[$member->get_pincode()];
                }
                else {
                    $time_slots = get_available_slots($member->get_pincode(), 0);
                    $data_by_pincode[$member->get_pincode()] = $time_slots;
                }
            }
            if ($member->get_district_id() != null && 
                strlen(trim($member->get_district_id())) > 0 && 
                $member->get_district_id() != 0) 
            {
                if (array_key_exists($member->get_district_id(), $data_by_district_id)) {
                    $available_slots = $data_by_district_id[$member->get_district_id()];
                    $time_slots = array_merge($time_slots, $available_slots);
                }
                else {
                    $available_slots = get_available_slots(0, $member->get_district_id());
                    $data_by_district_id[$member->get_district_id()] = $available_slots;
                    $time_slots = array_merge($time_slots, $available_slots);
                }
            }
            
            if ($member->get_email() != null && count($time_slots) > 0) {
                if (send_email($member->get_email(), $time_slots)) {
                    echo "Mail sent";
                }
                else {
                    echo "Failed";
                }
            }
        }
    } else {
        echo "No results";
    }
    $conn->close();
?>
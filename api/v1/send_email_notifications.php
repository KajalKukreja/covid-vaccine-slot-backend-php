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
            $member = new Member($row["id"], $row["email"], $row["mobile_no"], $row["pincode"], $row["district_id"], $row["age"], $row["dose"]);
            
            if ($member->get_email() != 'null') {
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
                
                if ($time_slots != null) {

                    $filtered_slots = array();
                    
                    //now filter the slots based on age/dose
                    if ($member->get_age() != null && $member->get_age() != 0 && $member->get_dose() != null) {
                        foreach($time_slots as $slot) {
                            $available_doses = $member->get_dose() == 'dose1' ? $slot[3] : $slot[4];
                            if ($member->get_age() == $slot[7] && $available_doses > 0) {
                                array_push($filtered_slots, $slot);
                            }
                        }
                    }
                    else if ($member->get_age() != null && $member->get_age() != 0) {
                        foreach($time_slots as $slot) {
                            if ($member->get_age() == $slot[7]) {
                                array_push($filtered_slots, $slot);
                            }
                        }
                    }
                    else if ($member->get_dose() != null) {
                        foreach($time_slots as $slot) {
                            $available_doses = $member->get_dose() == 'dose1' ? $slot[3] : $slot[4];
                            if ($available_doses > 0) {
                                array_push($filtered_slots, $slot);
                            }
                        }
                    }
                    else {
                        $filtered_slots = $time_slots;
                    }

                    if (count($filtered_slots) > 0) {
                        if (send_email($member->get_email(), $filtered_slots)) {
                            error_log("\nMail sent to ".$member->get_email(), 3, 'cron_logs.log');
                        }
                        else {
                            error_log("\nMail could not be sent to ".$member->get_email(), 3, 'cron_logs.log');
                        }
                    }
                }
                
                //wait for 1 second before processing another record
                sleep(1);
            }
        }
    }
    $conn->close();
?>
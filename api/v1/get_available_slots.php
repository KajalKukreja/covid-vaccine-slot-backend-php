<?php
    require "config.php";

    function get_available_slots($pincode, $district_id) {
        //just for testing
        //$pincode = 562110;
        //$pincode = 0;
        //$district_id = 3;
        date_default_timezone_set("Asia/Calcutta");
        $date = date("d-m-Y");
        if ($pincode != 0) {
            $url = $GLOBALS['COWIN_ENDPOINT']."findByPin?pincode=".$pincode."&date=".$date;
        }
        else if ($district_id != 0) {
            $url = $GLOBALS['COWIN_ENDPOINT']."findByDistrict?district_id=".$district_id."&date=".$date;
        }
        $time_slots = array();
        $response = file_get_contents($url);

        if ($response != null) {
            $response = json_decode($response);
            if (isset($response->sessions) && count($response->sessions) > 0) {
                foreach($response->sessions as $row) {
                    if ($row->available_capacity > 0) {
                        $address = $row->address.", ".
                        ($row->block_name != null && $row->block_name != 'Not Applicable' ? $row->block_name.", " : "").
                        $row->district_name.", ".$row->state_name.", ".$row->pincode;

                        $slot = array($row->name, $address, $row->fee_type, 
                        $row->available_capacity_dose1, $row->available_capacity_dose2, 
                        $row->available_capacity, $row->fee, $row->min_age_limit, $row->vaccine, 
                        $row->slots);

                        array_push($time_slots, $slot);
                    }
                }
            }
        }
        return $time_slots;
    }
?>
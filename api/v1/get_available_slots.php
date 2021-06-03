<?php

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    require "config.php";

    function get_available_slots($pincode, $district_id) {
        date_default_timezone_set("Asia/Calcutta");
        $date = date("d-m-Y");
        if ($pincode != 0) {
            $url = $GLOBALS['COWIN_ENDPOINT']."calendarByPin?pincode=".$pincode."&date=".$date;
        }
        else if ($district_id != 0) {
            $url = $GLOBALS['COWIN_ENDPOINT']."calendarByDistrict?district_id=".$district_id."&date=".$date;
        }
        $time_slots = array();
        $response = file_get_contents($url);

        if ($response != null) {
            $response = json_decode($response);
            if (isset($response->centers) && count($response->centers) > 0) {
                foreach($response->centers as $row) {
                    $address = $row->address.", ".
                    ($row->block_name != null && $row->block_name != 'Not Applicable' ? $row->block_name.", " : "").
                    $row->district_name.", ".$row->state_name.", ".$row->pincode;

                    foreach($row->sessions as $session) {
                        if ($session->available_capacity > 0) {
                            $slot = array($row->name, $address, $row->fee_type, 
                            $session->available_capacity_dose1, $session->available_capacity_dose2, 
                            $session->available_capacity, $row->vaccine_fees, $session->min_age_limit,
                            $session->vaccine, $session->slots, $session->date);

                            array_push($time_slots, $slot);
                        }
                    }
                }
            }
        }
        return $time_slots;
    }
?>
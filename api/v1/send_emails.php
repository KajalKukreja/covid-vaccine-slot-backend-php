<?php
    //start the session
	session_start();
		
	//run script in background
	ignore_user_abort(true);

	//set time limit
	set_time_limit(0);
	
    function send_email($email, $time_slots) {
        $subject = "Covid Vaccine Slot Available";
        $from = "covid-vaccine-notification@kajalkukreja.com";
        $headers = "MIME-Version: 1.0"."\r\n";
	    $headers .= "Content-type:text/html;charset=UTF-8"."\r\n";
	    $headers .= "From: ".$from."\r\n";
        $message = file_get_contents("message.php");

        return mail($email, $subject, $message, $headers);
    }
?>
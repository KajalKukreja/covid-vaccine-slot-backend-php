<?php		
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

        $message = "<html>
        <head>
            <meta charset='utf-8'>
            <meta name='viewport' content='width=device-width,initial-scale=1'>
        </head>
        <body style='font-family: -apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica,Arial,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol;'>
            <p>Hi,</p>
            <span>Hope you and your family members are doing good.</span><br />
            <span>Please check the available slots and book as per your convenience from 
            <a href='https://selfregistration.cowin.gov.in/' target='_blank'>CoWIN</a> website.
            </span>
            <p class='note' style='color: #495057;
            font-size: x-small;'>Note : Slots are provided by the state govt and private hospitals. Slot availability data is cached and may be upto 30 minutes old.</p>
            <table style='font-size: x-small;
            margin-top: 15px;
            color: grey;
            border: 2px double #43a743e6;
            border-collapse: collapse;'>
                <tr>
                    <th style='width: 12%;
                    background-color: #2196F3;
                    color: #fff;
                    text-align: center;
                    padding: 10px;
                    border: 2px double #43a743e6;
                    border-collapse: collapse;'>Date</th>

                    <th style='width: 33%;
                    background-color: #2196F3;
                    color: #fff;
                    text-align: center;
                    padding: 10px;
                    border: 2px double #43a743e6;
                    border-collapse: collapse;'>Center</th>

                    <th style='width: 55%;
                    background-color: #2196F3;
                    color: #fff;
                    text-align: center;
                    padding: 10px;
                    border: 2px double #43a743e6;
                    border-collapse: collapse;'>Available Slots</th>
                </tr>";
                
                date_default_timezone_set("Asia/Calcutta");
                $date = date("d-m-Y");

                foreach($time_slots as $slot) {
                $message .= "
                <tr>
                    <td style='width: 12%;
                    padding: 10px;
                    border: 2px double #43a743e6;
                    border-collapse: collapse;'>".$slot[10]."</td>

                    <td style='width: 33%;
                    padding: 10px;
                    border: 2px double #43a743e6;
                    border-collapse: collapse;'>
                        <p class='name' style='font-weight: 600;
                        overflow-wrap: break-word;'>".$slot[0];

                            if ($slot[2] == "Paid") {
                                $message .= "<span class='paid' style='color: #fff;
                                font-size: 9px;
                                font-weight: 700;
                                background-color: #2152b3;
                                border-radius: 20px;
                                padding: 2px 5px;
                                text-align: center;
                                text-transform: uppercase;
                                margin-left: 5px;'>".$slot[2]."</span>";
                            }
                        $message .= "</p>".$slot[1]."
                        <p>
                            <a href='https://maps.google.com/?saddr=&daddr=".$slot[0].",".$slot[1].
                            "' target='_blank' class='map' style='font-weight: 600;
                            text-align: center;
                            color: #2152b3;'>Get Map Directions</a>
                        </p>";
                        
                        if ($slot[2] == "Paid" && $slot[6] != null) {
                            foreach($slot[6] as $vaccine) {
                                $message .= "<span>".$vaccine->vaccine.": Rs. ".$vaccine->fee."</span>";
                            }
                        }
                    $message .= "
                    </td>

                    <td style='width: 55%;
                    padding: 10px;
                    border: 2px double #43a743e6;
                    border-collapse: collapse;'>
                        <div class='vaccine-details' style='padding: 0 5px;'>".$slot[8]."
                            <span class='capacity' style='text-decoration: none;
                            color: #2e2e2e;
                            font-weight: 700;
                            background-color: #a9d18e;
                            padding: 0 8px;
                            line-height: 20px;
                            margin-top: 5px;
                            border-radius: 50px;
                            align-content: center;
                            justify-content: center;
                            height: 20px;
                            margin-left: 5px;'>".$slot[5]."</span>
                            <span class='age' style='color: #c20505;
                            text-transform: capitalize;
                            font-weight: 600;
                            margin-left: 5px;'>Age ".$slot[7]."+</span>
                            <span class='doses' style='margin: 0 10px;
                            padding: 0 10px;
                            border-left: 2px solid green;'>Dose 1 : ";
                            
                    if ($slot[3] != 0) {
                        $message .= "<span class='capacity' style='text-decoration: none;
                        color: #2e2e2e;
                        font-weight: 700;
                        background-color: #a9d18e;
                        padding: 0 8px;
                        line-height: 20px;
                        margin-top: 5px;
                        border-radius: 50px;
                        align-content: center;
                        justify-content: center;
                        height: 20px;
                        margin-left: 5px;'>".$slot[3];
                    }
                    else {
                        $message .= "<span class='nocapacity' style='text-decoration: none;
                        color: #2e2e2e;
                        font-weight: 700;
                        background-color: red;
                        padding: 0 8px;
                        line-height: 20px;
                        margin-top: 5px;
                        border-radius: 50px;
                        align-content: center;
                        justify-content: center;
                        height: 20px;
                        margin-left: 15px;'>".$slot[3];
                    }

                    $message .= "</span>Dose 2 : ";
                            
                    if ($slot[4] != 0) {
                        $message .= "<span class='capacity' style='text-decoration: none;
                        color: #2e2e2e;
                        font-weight: 700;
                        background-color: #a9d18e;
                        padding: 0 8px;
                        line-height: 20px;
                        margin-top: 5px;
                        border-radius: 50px;
                        align-content: center;
                        justify-content: center;
                        height: 20px;
                        margin-left: 5px;'>".$slot[4];
                    }
                    else {
                        $message .= "<span class='nocapacity' style='text-decoration: none;
                        color: #2e2e2e;
                        font-weight: 700;
                        background-color: red;
                        padding: 0 8px;
                        line-height: 20px;
                        margin-top: 5px;
                        border-radius: 50px;
                        align-content: center;
                        justify-content: center;
                        height: 20px;
                        margin-left: 5px;'>".$slot[4];
                    }

                    $message .= "</span>
                            <a href='https://selfregistration.cowin.gov.in/' target='_blank' style='text-decoration: none;'>
                            <button type='button' style='font-size: 10px;
                            margin-left: 10px;
                            padding: 5px;
                            color: #ffffff;
                            background: #9C27B0;
                            border: 1px solid #9C27B0;
                            border-radius: 2rem;'>Book Slot</button></a>
                            <p>";

                                
                                $size = count($slot[9]);
                                for ($x = 0; $x < $size; $x++) {
                                    $message .= $slot[9][$x];
                                    if ($x < $size-1) {
                                        $message .= ", ";
                                    }
                                }
                            $message .= "
                            </p>
                        </div>
                    </td>
                </tr>";
                }
                $message .= "
            </table>
            <p>If you don't want to recieve such alerts, click <a href='http://kajalkukreja.com/covid-vaccine-slot-backend/?unsubscribe&email=".$email."'>here</a>
        </body>
    </html>";
        
        return mail($email, $subject, $message, $headers);
    }
?>
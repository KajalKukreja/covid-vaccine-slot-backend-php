<?php
?>

<html>
    <head>
        <style>
            body {
                font-family: 'Open-Sans', 'Arial';
            }
            table {
                color: grey;
                border: 1px solid green;
            }
            table th {
                background-color: #2196F3;
                color: fff;
                text-align: center;
                padding: 10px;
            }
            table td {
                font-size: 13px;
                padding: 10px;
            }
            table, th, td {
                border: 3px double green;
                border-collapse: collapse;
            }
            .name {
                font-weight: 600;	
            }
            .map {
                font-size: 12px;
                font-weight: 600;
                text-align: center;
                color: #2152b3;
            }
            .paid {
                color: #fff;
                font-size: 9px;
                font-weight: 700;
                background-color: #2152b3;
                border-radius: 20px;
                padding: 2px 5px;
                text-align: center;
                text-transform: uppercase;
                margin-left: 5px;
            }
            .capacity {
                text-decoration: none;
                color: #2e2e2e;
                font-size: 12px;
                font-weight: 700;
                background-color: #a9d18e;
                padding: 0 10px;
                line-height: 20px;
                margin-top: 5px;
                border-radius: 50px;
                align-content: center;
                justify-content: center;
                height: 20px;
                margin-left: 5px;
            }
            .age {
                color: #c20505;
                font-size: 12px;
                text-transform: capitalize;
                font-weight: 600;
                margin-left: 5px;
            }
            .vaccine-details button {
                font-size: 10px;
                margin-left: 10px;
                padding: 5px;
                color: #ffffff;
                background: #9C27B0;
                border: 1px solid #9C27B0;
                border-radius: 2rem;
                cursor: pointer;
                box-shadow: 0 3px 1px -2px rgb(0 0 0 / 20%), 0 2px 2px 0 rgb(0 0 0 / 14%), 0 1px 5px 0 rgb(0 0 0 / 12%);   
            }
        </style>
    </head>
    <body>
        <p>Hi,</p>
        <p>Hope you are your family are doing good.</p>
        <p>Glad to share that covid vaccine slot is available in your area.</p>
        <p>Please check the available slots and book as per your convenience from 
        <a href="https://www.cowin.gov.in/" target="_blank">CoWIN</a> website.
        </p>
        <table>
            <tr>
                <th style="width: 10%">Date</th>
                <th style="width: 40%">Center</th>
                <th style="width: 50%">Available Slots</th>
            </tr>
            <?php
            foreach($time_slots as $slot) {
            ?>
            <tr>
                <td style="width: 10%;">
                    <?php
                        date_default_timezone_set("Asia/Calcutta");
                        $date = date("d-m-Y");
                        echo $date;
                    ?>
                </td>
                <td style="width: 40%;">
                    <p class="name"><?php echo $slot[0]; ?>
                        <?php
                        if ($slot[2] == "Paid") {
                        ?>
                            <span class="paid"><?php echo $slot[2]; ?></span>
                        <?php
                        }
                        ?>
                    </p>
                    <?php echo $slot[1]; ?>
                    <p>
                        <a href="https://maps.google.com/?saddr=&daddr=<?php echo $slot[0].",".$slot[1]; ?>" target="_blank"
                            class="map">Get Map Directions</a>
                    </p>
                    <?php
                    if ($slot[2] == "Paid") {
                    ?>
                        <span><?php echo $slot[8].": Rs. ".$slot[6]; ?></span>
                    <?php
                    }
                    ?>
                </td>
                <td style="width: 50%;">
                    <div class="vaccine-details">
                        <?php echo $slot[8]; ?><span class="capacity"><?php echo $slot[5]; ?></span>
                        <span style="margin-left: 5px;">Dose 1 : <span class="capacity"><?php echo $slot[3]; ?></span>, Dose 2 : <span class="capacity"><?php echo $slot[4]; ?></span></span>
						<span class="age">Age <?php echo $slot[7]; ?>+</span>
						<a href="https://www.cowin.gov.in/" target="_blank"><button type="button" class="button-round">Book Slot</button></a>
						<p>
                            <?php
                            $size = count($slot[9]);
                            for ($x = 0; $x < $size; $x++) { ?>
                                <?php echo $slot[9][$x]; ?>
                                <?php if ($x < $size-1) { echo ", "; } ?>
                            <?php }?>
                        </p>
					</div>
                </td>
            </tr>
            <?php
            }
            ?>
        </table>
    </body>
</html>
This php application is being used as backend for covid-vaccine-slot angular application.

Steps after deployment to the server -

Only once -
Create a new mysql database for the application
Create a new user for this database
Grant permissions to the user on the database
Login to phpmyadmin and run the sql queries given in queries.sql file

Always after deployment -
Edit dbconfig.php file and update values are per server's mysql
Edit config.php file and update recaptcha secret and site key values
Make sure following files have permissions as 400 so that only admin user can read these files 
and they are not exposed to public

    config.php
    dbconfig.php
    get_available_slots.php
    message.php
    send_email_notifications.php
    send_emails.php
    verify_recaptcha.php
    member/add_member.php
    member/member.php

Update this header based on your client application. Mine is angular application so I am using this value. When it will be deployed on server, we need to add our domain instead of localhost
header("Access-Control-Allow-Origin: http://localhost:4200");

Replace in following files -
all index.php files
verify_recaptcha.php
member/add_member.php


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
Make sure following files have permissions as 400 and do not echo sensitive details

    config.php
    dbconfig.php
    get_available_slots.php
    send_emails.php
    unsubscribe.php
    verify_recaptcha.php
    member/add_member.php
    member/member.php

We need to run cron job on send_email_notifications.php, so make sure it has 500 permission. Do not echo sensitive details

Update this header based on your client application. Mine is angular application so I am using this value. When it will be deployed on server, we need to add our domain instead of localhost
header("Access-Control-Allow-Origin: http://localhost:4200");

Replace in following files -
main index.php file
verify_recaptcha.php
member/add_member.php


Use this command to create a cron job to send alert -
php -q /home2/yourusername/public_html/covid-vaccine-slot-backend/api/v1/send_email_notifications.php >> /home2/yourusername/public_html/covid-vaccine-slot-backend/api/v1/cron_logs.log
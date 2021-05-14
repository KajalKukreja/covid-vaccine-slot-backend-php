This php application is being used as backend for covid-vaccine-slot angular application.

Steps after deployment to the server -

Only once -
Create a new mysql database for the application
Create a new user for this database
Grant permissions to the user on the database
Login to phpmyadmin and run the sql queries given in queries.sql file

Always after deployment -
Edit dbconfig.php file and update values are per server's mysql
Make sure dbconfig.php file has permissions as 400 so that only user can read that file

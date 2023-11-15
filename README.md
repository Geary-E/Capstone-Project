# Capstone-Project Demo Instructions

Hello, this is a software development project for the University of North Texas. This document will guide you through setting-up, and running a demo of the current state of the accessibility portal.

## Required Tools

- You will need XAMPP installed.

## Installation Setup

1. Navigate to your XAMPP htdocs folder and find/create:"C:\xampp\htdocs\php"

2. Ensure that you are in this folder, and download the github repository's src files here.

3. Run XAMPP in administrator mode, and click Start on Apache and MySQL

4. Wait for the module buttons to turn green, then click the admin button for MySQL on XAMPP.

5. On the phpMyAdmin dashboard click on import, then select the user_db file in the repository, and Import. - note: If you receive an error you may have to create an empty database called user_db, click on it on the left navigation bar, then click import.

6. After the import you can ensure that it was successful by clicking on user_db on the left, then designer on the right at the top to see if all the tables are viewable.

7. Open your browser and navigate to: http://127.0.0.1/php/src/registration.php

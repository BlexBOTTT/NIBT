README - How to Install `nibt` Database in XAMPP
=================================================

Prerequisites
-------------
- XAMPP installed (make sure Apache and MySQL are running)
- File: nibt/backups/nibt-wip.sql

Step-by-Step Guide
------------------

1. Open XAMPP and Start Services
   - Launch the XAMPP Control Panel
   - Start Apache and MySQL

2. Open phpMyAdmin
   - In your browser, go to: http://localhost/phpmyadmin

3. Create a New Database
   - Click on "New" from the left panel.
   - Name your database: nibt
   - Click "Create"

4. Import the SQL File
   - Select the `nibt` database from the left panel.
   - Click the "Import" tab at the top.
   - Click "Choose File" and select `nibt-wip.sql`.
   - Leave all settings as-is, scroll down, and click "Go"

If You Encounter an Import Error (e.g., File too large)
--------------------------------------------------------

Edit `php.ini`
--------------
1. Open `php.ini` (usually located at: `xampp/php/php.ini`)
2. Search and update these values (or add them if missing):

   upload_max_filesize=100M
   post_max_size=100M

3. Save and close the file.

Edit `my.ini`
-------------
1. Open `my.ini` (usually found in: `xampp/mysql/bin/my.ini`)
2. Under the [mysqld] section, add or update the following line:

   max_allowed_packet=100M

3. Save and close the file.

Restart XAMPP
-------------
- After editing the config files, restart Apache and MySQL from the XAMPP Control Panel.
COLLEGE NOTES & STUDY MATERIAL PORTAL
======================================

Technology:
- HTML5
- CSS3
- PHP 8+
- MySQL
- PDO
- No JavaScript
- No Bootstrap

INSTALLATION ON XAMPP
---------------------
1. Start Apache and MySQL in XAMPP.
2. Copy the "college_notes_portal" folder to:
   C:\xampp\htdocs\
3. Open phpMyAdmin:
   http://localhost/phpmyadmin
4. Import:
   database/college_notes_portal.sql
5. Check config/db.php:
   host = localhost
   db   = college_notes_portal
   user = root
   pass = ""   (change if your MySQL has a password)
6. Make sure the uploads folder is writable.
7. Open:
   http://localhost/college_notes_portal/

DEMO LOGIN
----------
Student: student / password
Faculty: faculty / password
Admin:   admin / password

MAIN FLOW
---------
Home -> Login/Register
Student -> Dashboard -> Notes -> Subject -> Unit -> Download
Faculty -> Dashboard -> Upload Material -> My Materials
Admin -> Dashboard -> Students / Faculty / Subjects / Materials / Reports

IMPORTANT
---------
The project uses password_hash/password_verify for login security.
Only PDF files up to 10 MB are accepted in faculty upload.
For production, add CSRF protection, stronger permissions, file scanning,
pagination, audit logs and HTTPS.

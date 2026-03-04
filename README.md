# Medical Centre Full Stack Web Application

## Introduction
This web application features a UI built from HTML & CSS for the styling, and Javascript for the dynamic form validation. There is a booking system that allows the user to book an appointment with a healthcare specialist which leverages regular expression input validation. These appointments are managed by the PhP backend, ensuring no double booking and a secure, easy way to share booking information.

## Requirements
- PHP 8.x (PHP 7.4+
- Local Web Server (e.g Apache/Nginx for web hosting)

## Deployment instructions

1. Download / clone the repo and upload the project folder to a PHP-capable web host (Apache/PHP).  

2. Disable the uni auth `.htaccess`** (otherwise you’ll likely get a 403 on normal hosting):
   - Rename `.htaccess` to `.htaccess.disabled`  
     or
   - Edit it and remove/comment the Kerberos + `SSLRequireSSL` rules.

3. Make sure these files exist on the server and are writable by PHP (or bookings/users won’t save):
   - `appointments.txt`
   - `users.txt`
   - `accessattempts.txt`

4. Visit the site:
   - If uploaded to the web root: `https://your-domain.com/index.php`
   - If uploaded to a subfolder: `https://your-domain.com/medical-centre/index.php`

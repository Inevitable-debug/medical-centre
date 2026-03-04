# Medical Centre – Full Stack Booking Web App (PHP)

A simple full-stack web application that lets users register/login and book appointments with healthcare specialists. Built as a practical project focusing on input validation, booking integrity (no double-booking), and clear deployment/troubleshooting steps.

## Highlights
- **Appointment booking workflow** with server-side checks to prevent **double-booking**
- **Client-side validation** using JavaScript + regex (fast feedback for users)
- **Simple persistence** using flat files (`appointments.txt`, `users.txt`, `accessattempts.txt`)
- Includes **real-world deployment notes** (Apache `.htaccess` / 403 troubleshooting, file permissions)

## Tech Stack
- Frontend: **HTML, CSS, JavaScript**
- Backend: **PHP**
- Hosting: Any **PHP-capable web server** (Apache/Nginx)

## Quick Demo (What to try)
1. Register a user / log in
2. Book an appointment (confirm validation blocks bad input)
3. Try booking the **same slot** again (should be prevented by backend logic)
4. Verify the booking is recorded (e.g., in `appointments.txt`)

> Tip: Add screenshots to `/screenshots` and link them below to make this repo “instantly scannable” by recruiters.

## Requirements
- PHP **8.x** (compatible with PHP **7.4+**)
- Local web server (Apache/Nginx) or a PHP-capable host

## Deployment (Local)
### Option A: PHP built-in server (quickest)
From the project directory:
```bash
php -S localhost:8000

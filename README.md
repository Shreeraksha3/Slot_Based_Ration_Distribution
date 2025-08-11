Queue Free Ration Distribution and Management System
📌 Overview
This project is a web-based application designed to streamline the ration distribution process at fair price shops.
It eliminates long queues, reduces overcrowding, and ensures fair and efficient distribution of rations to all beneficiaries, including senior citizens, working professionals, and individuals with disabilities.

The system allows administrators to:

Manage cardholder details

Create and allocate time slots based on priority

Notify beneficiaries via automated SMS without requiring internet or smartphones

Reallocate missed slots once to ensure fairness

✨ Features
Admin Dashboard for easy management of beneficiaries and slots

Slot Creation & Allocation based on:

Age

Disability status

Working status

Automated SMS Notifications using Twilio API

Missed Slot Handling with one-time reallocation

Secure Data Management with MySQL backend

Accessible for All — works with basic mobile phones (no smartphone required)

🛠️ Tech Stack
Frontend:

HTML5, CSS3, JavaScript, Bootstrap

Backend:

PHP 7.4+

MySQL 8.0+

Other Tools & Services:

Apache/Nginx Web Server

Twilio SMS API

phpMyAdmin/MySQL Workbench

⚙️ System Requirements
Hardware
Server Side:

Intel Core i5 / 8GB RAM / 500GB storage
Client Side (Admin):

Intel Core i3 / 4GB RAM / 250GB storage
Beneficiaries:

Any phone capable of receiving SMS

Software
OS: Windows 10/11 or Linux

Web Server: Apache / Nginx

Database: MySQL 8.0+

Backend: PHP 7.4+

SMS: Twilio API

📂 Project Structure
bash
Copy
Edit
.
├── /frontend        # HTML, CSS, JS files
├── /backend         # PHP scripts for slot creation, allocation, and SMS
├── /database        # SQL scripts for database setup
├── /docs            # Project documentation & diagrams
└── README.md
🚀 Installation & Setup
Clone the repository

bash
Copy
Edit
git clone https://github.com/<your-username>/<repo-name>.git
cd <repo-name>
Set up Database

Create a MySQL database

Import the provided .sql file from /database

Configure Twilio API

Get your SID and Auth Token from Twilio

Update them in the PHP configuration file for SMS sending

Run the project

Place the project folder in your web server’s root (htdocs for XAMPP)

Start Apache and MySQL

Access in browser:

arduino
Copy
Edit
http://localhost/<project-folder>
📸 Screenshots
Admin Login Page

Dashboard

Cardholder Registration

Slot Creation

Slot Allocation View

(Refer to /docs/screenshots for all images)

📈 Future Enhancements
Mobile application for both admins and beneficiaries

Aadhaar-based biometric authentication

AI-powered slot prediction

Offline admin functionality for low-connectivity areas

Multi-language support

Advanced analytics dashboard


# 🍚 Queue Free Ration Distribution and Management System


## 📌 Overview
This project is a **web-based application** designed to streamline the ration distribution process at **fair price shops**.  
It eliminates long queues, reduces overcrowding, and ensures **fair and efficient distribution** of rations to all beneficiaries, including **senior citizens, working professionals, and individuals with disabilities**.  

The system allows administrators to:
- Manage cardholder details
- Create and allocate time slots based on priority
- Notify beneficiaries via **automated SMS** without requiring internet or smartphones
- Reallocate missed slots once to ensure fairness

---

## ✨ Features
- **Admin Dashboard** for easy management of beneficiaries and slots  
- **Slot Creation & Allocation** based on:
  - Age
  - Disability status
  - Working status
- **Automated SMS Notifications** using Twilio API  
- **Missed Slot Handling** with one-time reallocation  
- **Secure Data Management** with MySQL backend  
- **Accessible for All** — works with basic mobile phones (no smartphone required)  

---

## 🛠️ Tech Stack
**Frontend:**
- HTML5, CSS3, JavaScript, Bootstrap  

**Backend:**
- PHP 7.4+  
- MySQL 8.0+  

**Other Tools & Services:**
- Apache/Nginx Web Server  
- Twilio SMS API  
- phpMyAdmin/MySQL Workbench  

---

## ⚙️ System Requirements

### **Hardware**
**Server Side:**
- Intel Core i5 / 8GB RAM / 500GB storage  
**Client Side (Admin):**
- Intel Core i3 / 4GB RAM / 250GB storage  
**Beneficiaries:**
- Any phone capable of receiving SMS  

### **Software**
- OS: Windows 10/11 or Linux  
- Web Server: Apache / Nginx  
- Database: MySQL 8.0+  
- Backend: PHP 7.4+  
- SMS: Twilio API  

---

## 📂 Project Structure
- ├── /frontend # HTML, CSS, JS files
- ├── /backend # PHP scripts for slot creation, allocation, and SMS
- ├── /database # SQL scripts for database setup
- ├── /docs # Project documentation & diagrams
- └── README.md


---

## 🚀 Installation & Setup

1. **Clone the repository**
   ```bash
    git clone https://github.com/Shreeraksha3/Slot_Based_Ration_Distribution.git
    cd Slot_Based_Ration_Distribution
2. **Set up Database**
- Create a MySQL database
- Import the provided .sql file from /database
3. **Configure Twilio API**
- Get your SID and Auth Token from Twilio
- Update them in the PHP configuration file for SMS sending
4. **Run the project**
- Place the project folder in your web server’s root (htdocs for XAMPP)
- Start Apache and MySQL
- Access the application in your browser:
  ```bash
  http://localhost/<project-folder>

---

## 📈 Future Enhancements
- Access the application in your browser:
- Mobile application for both admins and beneficiaries
- Aadhaar-based biometric authentication
- AI-powered slot prediction
- Offline admin functionality for low-connectivity areas
- Multi-language support
- Advanced analytics dashboard





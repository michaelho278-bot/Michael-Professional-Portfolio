# Login & CRUD System (CMS v4.5) + Mobile App

## 📖 Overview
This repository contains:
1. **CMS Backend (PHP + MySQL)** → Secure authentication, role-based access, CRUD APIs.
2. **Mobile App (Ionic + Angular)** → Frontend client with Login, Products, Contact pages.

---

## 🚀 Features
- 🔑 **User Authentication** using JWT tokens (no PHP sessions)
- 👥 **Role-based Access Control** (Admin / User)
- 📊 **Dashboard API** with summary statistics
- 📝 **CRUD Operations** for Users & Products
- 📱 **Mobile App** with Login, Products filter, Contact form

---

## ⚠️ Important
- The **backend requires a MySQL database**.  
- If no database is connected, only the **frontend UI** will run.  
- To enable full functionality, configure `config.php` with your DB credentials.

---

## 🛠️ Tech Stack
- **Backend**: PHP (OOP, PDO, RESTful API)
- **Frontend (Web)**: JavaScript (ES6+), Bootstrap, DataTables
- **Frontend (Mobile)**: Ionic, Angular, Capacitor
- **Database**: MySQL

---

## 📂 Project Structure
cms/ → PHP backend  
mobile-app/ → Ionic Angular frontend  

---

## 📸 Screenshots 

### CMS 系統 
#### Login Page 
![CMS Login](screenshots/cms-login.png) 
#### Dashboard 
![CMS Dashboard](screenshots/cms-dashboard.png) 
#### Products CRUD 
![CMS Products](screenshots/cms-products.png)
#### User CRUD 
![CMS Users](screenshots/cms-users.png)
#### FCM Notification 
![CMS Send](screenshots/cms-fcm.png)

### Mobile App 
#### Login Page 
![Mobile Login](screenshots/mobile-login.png) 
#### Products Page 
![Mobile Products](screenshots/mobile-products.png) 
#### Description Page 
![Mobile Description](screenshots/mobile-description.png) 
#### Contact Page 
![Mobile Contact](screenshots/mobile-contact.png) 
#### Push Notification (FCM) 
![Mobile FCM](screenshots/mobile-fcm.png)

---

## ⚡ How to Run
### CMS Backend
```bash
cd cms
php -S localhost:8000


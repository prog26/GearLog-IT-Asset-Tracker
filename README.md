# GearLog – IT Asset Tracker

## 📌 Project Overview

**GearLog** is a web application designed to manage and track company IT assets.
It allows administrators to monitor hardware, manage inventory, and track device status efficiently.

This project was developed as part of a **backend web development training using PHP and MySQL**.

---

## 🎯 Project Objective

The goal of this project is to build a simple and functional **IT asset management system** that enables:

* Tracking hardware inventory
* Managing device categories
* Monitoring asset status
* Calculating total inventory value
* Searching assets quickly

---

## 🚀 Main Features

* Asset management (Add / Update / Delete)
* Category management
* Dashboard with asset listing
* Status tracking (In Stock / Deployed / Under Repair)
* Dynamic search (name & serial number)
* Financial overview (total assets value)
* Authentication system (Login / Logout)

---

## 🛠 Technologies Used

* **PHP (PDO)**
* **MySQL**
* **HTML5**
* **CSS3**

---

## 🔐 Security

* Prepared statements (SQL Injection protection)
* Password hashing (`password_hash`)
* XSS protection (`htmlspecialchars`)
* Session-based authentication

---

## 📂 Project Structure

```
SAS_PROJET/
│
├── assets/
│   ├── logo.png        # Application logo
│   └── style.css       # Styling and layout
│
├── config/
│   └── db.php          # Database connection (PDO)
│
├── database/
│   └── database.sql    # SQL file to create database and tables
│
├── create_user.php     # Create admin user
├── create.php          # Add new asset
├── delete.php          # Delete asset
├── update.php          # Update asset
├── index.php           # Dashboard (main page)
├── login.php           # Login page
├── logout.php          # Logout system
├── splash.php          # Welcome page
│
└── README.md
```

---

## 🎓 Learning Outcomes

Through this project, key concepts were applied:

* Backend development with PHP
* Database management with MySQL
* CRUD operations
* Authentication systems
* Secure coding practices
* SQL joins and data filtering

---

## 👨‍💻 Author

Developed by **Hassan AFTAH** as part of a **self-training journey in web development**.

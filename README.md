# 🛡️ PhishED – Interactive Phishing Awareness Platform

> Learn. Simulate. Defend.

PhishED is an interactive cybersecurity awareness platform designed to help users identify, understand, and defend against phishing attacks through realistic simulations, educational content, and quizzes. It provides a safe environment where users can experience common phishing scenarios without any real risk.

---

## 📖 About the Project

Phishing is one of the most common cyber threats today. PhishED helps users improve their cybersecurity awareness by allowing them to safely explore phishing attacks, understand how they work, and learn how to avoid them.

The platform combines secure authentication, interactive simulations, quizzes, and learning resources into a single web application.

---

## ✨ Features

### 🔐 Secure Authentication
- User Registration
- Secure Login
- Password Hashing
- Email Verification
- Forgot Password
- Password Reset via Email
- Login Attempt Limiter
- Session Timeout
- Session-Based Access Control

### 🎭 Interactive Phishing Simulations
Practice with realistic phishing scenarios including:

- 📧 Email Phishing
- 🪟 Pop-up Phishing
- 📱 SMS / OTP Phishing
- 📷 Camera Permission Phishing
- 🔒 Ransomware Awareness
- 🌐 Fake Browser Update
- 🖼️ Malicious File Download
- 📱 QR Code Phishing (Quishing)
- 📞 Voice Call Phishing (Vishing)
- 💼 Business Email Compromise (BEC)
- 🐋 Whaling Attack
- 📩 Smishing


### 🧠 Interactive Quiz
- Beginner-friendly cybersecurity quiz
- Instant answer feedback
- Explanation for each question
- Final score summary

### 📘 Learning Module
Learn about:
- What is phishing?
- Types of phishing attacks
- Common phishing techniques
- Online safety tips


---



## 🛠️ Technology Stack

### Frontend
- HTML5
- Tailwind CSS
- JavaScript

### Backend
- PHP
- PHPMailer
- Apache (XAMPP)

### Database
- MySQL
- phpMyAdmin

### Development Tools
- Visual Studio Code
- Composer
- Git & GitHub

---

## 📂 Project Structure

```text
PhishED/
│
├── index.html
├── index.php
├── login.php
├── register.php
├── forgot_password.php
├── reset_password.php
├── verify.php
├── resend_verification.php
├── logout.php
│
├── simulate.php
├── quiz.php
├── learn.php
│
├── header.php
├── auth.php
├── session_check.php
├── config.php
├── database_setup.sql
│
├── composer.json
├── composer.lock
├── vendor/
│
├── images/
├── assets/
└── README.md
```

---

## 🚀 Getting Started

### 1. Clone the Repository

```bash
git clone https://github.com/Surya01x/PhishED.git
```

### 2. Move Project to XAMPP

Copy the project folder to:

```text
C:\xampp\htdocs\
```

### 3. Start XAMPP

Start:

- Apache
- MySQL

### 4. Create Database

Create a database named:

```text
pished_db
```

Import:

```text
database_setup.sql
```

### 5. Install Dependencies

Run:

```bash
composer install
```

### 6. Configure Database

Edit `config.php` and update:

```php
$dbHost = "localhost";
$dbUser = "root";
$dbPass = "YOUR_DATABASE_PASSWORD";
$dbName = "pished_db";
$dbPort = 3307;
```

Update these values according to your MySQL setup.

### 7. Configure Email

Update the SMTP credentials in:

- register.php
- forgot_password.php
- resend_verification.php

Replace with your own Gmail address and App Password.

```php
$mail->Username = "YOUR_GMAIL@gmail.com";
$mail->Password = "YOUR_GMAIL_APP_PASSWORD";
```

### 8. Run the Project

Open your browser:

```text
http://localhost/PhishED/index.php
```

---



## 📸 Screenshots



- Home Page<img width="1900" height="1078" alt="image" src="https://github.com/user-attachments/assets/e861478f-c310-45b4-8d03-5772747c4a52" />

- Login Page <img width="1913" height="1078" alt="image" src="https://github.com/user-attachments/assets/04448057-60d3-4e3e-bbf4-9d218810db4e" />

- Registration Page <img width="1918" height="1078" alt="image" src="https://github.com/user-attachments/assets/13364eef-33e7-42d4-a3af-7bdddbe1edd8" />

- Simulations <img width="1902" height="1073" alt="image" src="https://github.com/user-attachments/assets/ddc1135f-1508-4b14-89e4-cc83e598152e" />

- E-mail Phishing Simulation <img width="1918" height="1078" alt="image" src="https://github.com/user-attachments/assets/ac6dad9f-44bf-477b-8d90-e86bea5cca03" />

- Smsishing Simulation <img width="1918" height="1078" alt="image" src="https://github.com/user-attachments/assets/030adce7-0a80-4f1b-840c-d68336c236b7" />

-Camera Access Simulation <img width="1918" height="1078" alt="image" src="https://github.com/user-attachments/assets/218a5dcd-0b39-4f24-9766-72e0a651237c" />


- Quiz <img width="1900" height="1077" alt="image" src="https://github.com/user-attachments/assets/bf36eb39-38ee-4461-9f11-9ef867ad3ea4" />


- Learn Page <img width="1901" height="1077" alt="image" src="https://github.com/user-attachments/assets/0a70c53e-584f-4104-ab4a-64daf53647ed" />



---


## 👨‍💻 Author

**Surya Vishnu**

Computer Science Engineering Student

Cybersecurity Enthusiast

---

## ⭐ Support

If you found this project useful, consider giving it a ⭐ on GitHub!

Feedback and suggestions are always welcome.

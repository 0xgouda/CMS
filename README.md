# CMS Project

A simple Content Management System (CMS) developed as a student project using the **MVC** (Model-View-Controller) design pattern and **Object-Oriented Programming** (OOP) concepts. This CMS provides an admin dashboard to manage website content, including editing pages and logging changes.

## Features

- **Admin Dashboard**: manage website content.
- **Page Management**: edit the content of pages like Home, About, and Contact.
- **ORM (Object-Relational Mapping)**: Uses Active Record pattern to simplify database interactions.
- **Logging**: Tracks and logs all changes made by the admin, providing a history of content modifications.

## Technical Stack

- **PHP**
- **MySQL**
- **ORM (Active Record)**: An abstraction layer for database operations.
- **HTML/CSS**
  
## Structure
```bash
CMS
  ├── composer.json
  ├── composer.lock
  ├── logs.log
  ├── Modules
  │   ├── Contact
  │   │   ├── Controller
  │   │   │   └── ContactController.php
  │   │   ├── Model
  │   │   └── View
  │   │       ├── already-contacted.html
  │   │       ├── contact.html
  │   │       └── contact-thank-you.html
  │   ├── Page
  │   │   ├── Admin
  │   │   │   ├── Controllers
  │   │   │   │   ├── DashboardController.php
  │   │   │   │   └── LoginController.php
  │   │   │   └── View
  │   │   │       ├── page-edit.html
  │   │   │       └── page-list.html
  │   │   ├── Controller
  │   │   │   └── PageController.php
  │   │   ├── Model
  │   │   │   └── Page.php
  │   │   └── View
  │   │       └── static.html
  │   └── Users
  │       └── Model
  │           └── User.php
  ├── public
  │   ├── admin
  │   │   ├── css
  │   │   │   └── adminlte.min.css
  │   │   └── index.php
  │   └── index.php
  ├── Src
  │   ├── Auth.php
  │   ├── DataBaseConnection.php
  │   ├── Entity.php
  │   ├── Interfaces
  │   │   └── ValidateInterface.php
  │   ├── MainController.php
  │   ├── PasswordHash.php
  │   ├── Router.php
  │   ├── Sql.php
  │   ├── Template.php
  │   ├── ValidationRules
  │   │   ├── ValidateMaximumLen.php
  │   │   ├── ValidateMinimumLen.php
  │   │   └── ValidateSpecialChars.php
  │   └── Validator.php
  ├── tests
  │   ├── ActiveRecordTest.php
  │   └── ValidationTest.php
  └── View
      ├── admin
      │   ├── layout
      │   │   └── default.html
      │   └── login.html
      └── layout
          ├── default.html
          └── navbar.html
```
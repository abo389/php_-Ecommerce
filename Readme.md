# Php Ecommerce
&nbsp;
This project represents an e-commerce website developed using PHP. It is designed to provide a platform where users can browse products, add them to a shopping cart, and proceed to checkout. The application includes functionalities for user authentication, product management, and order processing.

## 🚀 Demo
  [![](https://markdown-videos-api.jorgenkh.no/vimeo/1051816012%2Fe2697401b2?width=320&height=180&filetype=png)](https://vimeo.com/1051816012/e2697401b2)




&nbsp;
&nbsp;

## 🌟 Features

- **User Authentication**: Allows users to register, log in, and manage their accounts securely.
- **Product Catalog**: Displays a list of products with details such as images, descriptions, and prices.
- **Shopping Cart**: Enables users to add products to a cart, update quantities, and remove items.
- **Checkout Process**: Facilitates the process of reviewing the cart and placing orders.
- **Admin Panel**: Provides administrative functionalities to manage products, categories, and orders.

&nbsp;
&nbsp;

## 🖥️ Tech Stack

- **Backend**: PHP – The core programming language used for server-side logic.
- **Database**: MySQL – Utilized for storing user information, product details, and order records.
- **Frontend**: HTML, CSS, and JavaScript – Employed for structuring and styling the web pages, as well as adding interactivity.
- **Additional Libraries**: jQuery – A JavaScript library used to simplify DOM manipulation and event handling.
- **Icons**: FontAwesome – Provides a set of icons used throughout the application.

&nbsp;
&nbsp;

## ⚙️ Installation Steps (XAMPP)  

### **1. Download & Install XAMPP**  
- Download XAMPP from [Apache Friends](https://www.apachefriends.org/index.html) and install it.  
- Start **Apache** and **MySQL** from the **XAMPP Control Panel**.  

### **2. Clone or Download the Repository**  
- Clone the repository using Git:  
  ```bash
  git clone https://github.com/abo389/php_Ecommerce.git
  ```
- If downloaded as a **ZIP file**, extract it and move the folder to:  
  ```
  C:\xampp\htdocs\
  ```

### **3. Create the Database & Import Data**  
- Open **phpMyAdmin** in your browser:  
  ```
  http://localhost/phpmyadmin
  ```
- Click **"New"**, enter a **database name** (e.g., `ecommerce`), and click **Create**.  
- Click **Import**, then **Choose File**, and select the **SQL file** from the repository (e.g., `database.sql`).  
- Click **Go** to import the database structure and data.  

### **4. Configure the Database Connection**  
- Open the project folder and locate the **database configuration file** (e.g., `config.php` or `db.php`).  
- Update the database credentials to match your **XAMPP settings**:  

  ```php
  $servername = "localhost";
  $username = "root"; // Default XAMPP user
  $password = ""; // No password by default
  $dbname = "ecommerce"; // Database name you created
  ```

### **5. Start the Application**  
- Open your browser and go to:  
  ```
  http://localhost/php_Ecommerce/
  ```
- You should now see the homepage of the e-commerce site.  

&nbsp;
&nbsp;


## 📧 Contact
For questions or feedback:

- **Email**: [atf389@gmail.com](mailto:atf389@gmail.com)
- **Linkedin**: [Abdulrahman Atif](https://www.linkedin.com/in/abdulrahman-atef-166697216/)

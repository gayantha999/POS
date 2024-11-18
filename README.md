POS System for Mobile Shop
A comprehensive Point of Sale (POS) system built for mobile shops to streamline operations such as inventory management, sales tracking, billing, invoicing, and generating reports. This project uses PHP CodeIgniter for the backend and Angular for the frontend.

Made by Gayantha Madhubhashana

Features
User Authentication
Role-based access control:
Admin: Full access to manage the system.
Cashier: Limited access for managing daily sales.
Secure login with session management.
Inventory Management
Add, update, and delete inventory items.
Real-time stock level tracking.
Low-stock alerts for proactive inventory replenishment.
Sales Tracking
Record and manage daily sales.
Generate sales receipts for customers.
Sales history for auditing and review.
Billing and Invoicing
Generate and print invoices with detailed billing information.
Manage payment records and customer transactions.
Reports and Analytics
Generate reports for:
Inventory levels.
Daily, weekly, and monthly sales.
Financial summaries.
Data visualization for insights into business performance.
Technologies Used
Frontend
Angular: Modern and responsive UI for a seamless user experience.
Backend
PHP CodeIgniter: Robust and scalable backend development.
Database
MySQL: Efficient data management and storage.
Installation
Prerequisites
Backend:

PHP >= 7.4
CodeIgniter Framework
MySQL Database
XAMPP/WAMP for local server setup.
Frontend:

Node.js >= 14.x
Angular CLI
Steps
Clone the Repository:

bash
Copy code
git clone https://github.com/your-repo-name/pos-system-mobile-shop.git
cd pos-system-mobile-shop
Backend Setup:

Navigate to the backend folder:
bash
Copy code
cd backend
Configure the .env file with your database credentials.
Import the database schema from the db/pos_system.sql file.
Start the local server.
Frontend Setup:

Navigate to the frontend folder:
bash
Copy code
cd frontend
Install dependencies:
bash
Copy code
npm install
Start the development server:
bash
Copy code
ng serve
Access the app at http://localhost:4200/.

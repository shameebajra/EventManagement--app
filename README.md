# Event Management App

In Version 10 of the Event Management web application, the system is designed to facilitate smooth organization and management of events. This platform provides role-based access with three primary roles:
<br>
1. Super Admin - Manages events and viewing comprehensive reports on all events and users.<br>

2. Event Organizer - Creates, manages, and updates their own events, including adding event details, setting up ticket types, and handling ticket sales data.<br>

3. User - Registers for events, purchases tickets, and views event details for participation.<br>

Each role comes with distinct permissions and views, ensuring streamlined workflows tailored to user needs. This structure promotes efficient event coordination and improves user experience for all parties involved.

## Installation

Follow these steps to set up the project on your local machine.


1. Clone the Repository
```
git clone https://github.com/shameebajra/EventManagement--app.git
```
2. Set Up Environment Variables
Copy the .env.example file and rename it to .env:
```
cp .env.example .env
```
and set 
```
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=eventmanagement
DB_USERNAME=postgres
DB_PASSWORD=<yourpassword>

QUEUE_CONNECTION=database

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=<youremail>
MAIL_PASSWORD=<youremailapppassword>
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="<youremail>"
MAIL_FROM_NAME="${APP_NAME}"
```

3. Create the Database
Make sure you have a PostgreSQL database created for the project:
```
CREATE DATABASE eventmanagement;
```
4. Install Dependencies

```
composer install
npm install
```
5. Run Migrations and Seeders
```
php artisan migrate --seed
```
6. Generate Application Key
Generate an application encryption key:
```
php artisan key:generate
```
7. Run the Application
* For Backend <br>
Start the Laravel application on your local server:
```
php artisan serve
```
* For Frontend <br>
Start the frontend development server:
```
npm run dev
```
Open http://localhost:8000 in your browser to see the backend and frontend served locally.



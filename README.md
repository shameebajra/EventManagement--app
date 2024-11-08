# Event Management App

Event Management is a web application designed to facilitate the organization and management of events.

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



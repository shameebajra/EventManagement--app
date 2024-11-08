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
* For Backend
Start the Laravel application on your local server:
```
php artisan serve
```
* For Frontend
Start the frontend development server:
```
npm run dev
```
Open http://localhost:8000 in your browser to see the backend and frontend served locally.

## Further Ideas

Of course we only had time in the Laravel From Scratch series to review the essentials of a blogging platform. You can certainly take this many 
steps further. Here are some quick ideas that you might play with.

1. Add a `status` column to the posts table to allow for posts that are still in a "draft" state. Only when this status is changed to "published" should they show up in the blog feed. 
2. Update the "Edit Post" page in the admin section to allow for changing the author of a post.
3. Add an RSS feed that lists all posts in chronological order.  
4. Record/Track and display the "views_count" for each post.
5. Allow registered users to "follow" certain authors. When they publish a new post, an email should be delivered to all followers.
6. Allow registered users to "bookmark" certain posts that they enjoyed. Then display their bookmarks in a corresponding settings page.
7. Add an account page to update your username and upload an avatar for your profile.

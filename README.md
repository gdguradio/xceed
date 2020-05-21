Prerequisites
After cloning this repository, go to the root folder, run the following command/s,
    composer install
    composer update
Rename .env.example to .env and provide your database details there.
Laravel manages the frontend tools like vue using npm. So run npm install to get all the required dependencies.
It needs a database table to perform CRUD operations on it. Find and import the sql file located at /resources/assets/Xceed.sql.
Run
php artisan key:generate

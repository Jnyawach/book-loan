# Customer Survey App

This is a simple app to demonstrate a book loaning system. The app has
been developed for a coding test.

### Installation
 ```
 git clone https://github.com/Jnyawach/book-loan.git
 
 ```
```
cd  [project folder]
```
```
cp .env.example .env
```
```
composer install
```
```
npm install
```
```
php artisan key:generate
```
Set up the database connection then run php artisan migrate
```
php artisan db:seed
```
```
php artisan serve
```
```
npm run dev
```
Create an admin user in the database

```
php artisan create:user
```
Seeder sample books to get started with
```
php artisan db:seed --class=BookSeeder
```
Set up your mailing credentials and SMS api keys
on your env file

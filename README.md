# Customer Survey App

This is a simple app to enable sales representatives collect
feedback from customers

### Installation
 ```
 git clone https://github.com/Jnyawach/survey-app.git
 
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
Create a sales representative user in the database

```
php artisan create:user
```

Set up your mailing credentials and SMS api keys
on your env file

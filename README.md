

## Report Generation and Delivery System

  

This is a small web application developed in Laravel (version 11.44.2) and MySQL. This application allows user to login, update their profile and logout, user will get a weekly reports for their activities done in the application.

To Setup this Application you need to follow these steps
- **Prerequisites**
-- PHP 8.1 or above
-- MySQL
-- Webserver (Nginx/Apache)
-- Composer
-- Postman (Optional)
- **clone this public git repository in your machine**
--https://github.com/pankajbansal/reports.git
- **After clone go to the reports directory and to install the dependency using below commands.**
```
composer install 
cp .env.example .env
```
- **Add below line in .env file for spatie/laravel-activitylog package to use database table for storing logs**
```
QUEUE_CONNECTION=database
```
- **After installing the dependency in local create one new database in MySQL database.**
- **Update the database details in .env file**
- **Run the database migration using below command**
```
php artisan migrate
```
- **Migrate command will create the below tables in database**
```
'activity_log'
'cache'
'cache_locks'
'failed_jobs'
'job_batches'
'jobs'
'migrations'
'password_reset_tokens'
'sessions'
'user_activities'
'user_reports'
'users'

```
- **create sample data in database table using below command.**
```
php artisan db:seed
```
  - **Run the below command to start the server** 
```
php artisan serve
```
- **Now you can use the application using below URL** 
```
http://127.0.0.1:8000/api/articles
```
## API Endpoints
1. **{baseURL}/login** : This API will be used to login the user into the application.
2. **{baseURL}/profile/update** : This API will be used to update the user who is logged into the application.
3. **{baseURL}/logout** : This API will be used to logout the user from the application.

## Laravel Packages Used
1. **spatie/laravel-activitylog**: This is used to log user's activities in the database table (activity_log table)
2. **barryvdh/laravel-dompdf**: This is used to generate the PDF contains user activity reports

## TODOs
1. Use try/catch block throughout the application to handle the exceptions.
2. Convert all the WEB routes (routes in web.php) to API route and implement the Token System.
3. We can add the swagger for API documentation. (Optional)
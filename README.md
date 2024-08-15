# My Laravel To-Do App

## Description
A simple to-do list application built with Laravel. It allows users to add, update, and delete tasks.
This is made using HTML, Tailwind, JS and PHP Laravel. AJAX (Asynchronous JavaScript and XML) is used to handle 
real-time interactions with the server without needing to refresh the page. 

## Installation
Clone the repository and install the dependencies:
```bash
git clone https://github.com/your-username/laravel-todo-app.git
cd laravel-todo-app
composer install
npm install
cp .env.example .env
php artisan key:generate

##For database put your database name to todo and create the same name in MySQL or any DB then run
php artisan migrate

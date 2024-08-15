# My Laravel To-Do App

## Description
A simple to-do list application built with Laravel. It allows users to add, update, and delete tasks.

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

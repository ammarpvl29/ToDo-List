# Laravel To-Do List App

![GitHub license](https://img.shields.io/badge/license-MIT-blue.svg)

The Laravel To-Do List App is a feature-rich task management application built with Laravel. It provides essential functionalities for managing tasks, including user authentication, task creation, viewing, editing, and deletion. The app is styled using Tailwind CSS. This README will guide you through setting up and running the project on your local machine.

## Table of Contents

- [Features](#features)
- [Styling with Tailwind CSS](#styling-with-tailwind-css)
- [Installation](#installation)
- [Usage](#usage)
- [Authentication](#authentication)
- [Routes](#routes)
- [Validation](#validation)
- [Middleware](#middleware)
- [Components](#components)

## Features

- **Login/Logout:** Users can authenticate themselves to access the application.
- **Signup:** New users can create an account to manage tasks.
- **Create Task:** Users can add new tasks with title, description, and due date.
- **View Task:** List all tasks with filtering and sorting options.
- **Delete Task:** Remove tasks that are no longer needed.
- **Edit Task:** Modify existing tasks.
- **Authentication:** Secure user authentication system.
- **Routes:** Clearly defined routes for different functionalities.
- **Validation:** Input data is validated to prevent errors.
- **Middleware:** Implement middleware for various checks.
- **Components:** Organized components for maintainability.

## Styling with Tailwind CSS

This project is styled using [Tailwind CSS](https://tailwindcss.com/), a highly customizable CSS framework. Tailwind CSS offers a wide range of utility classes that make it easy to create beautiful and responsive user interfaces. The application's visual design is based on Tailwind CSS, providing a modern and clean look.

## Installation

Follow these steps to set up the Laravel To-Do List App on your local machine:

1. **Clone the repository:**

   ```bash
   git clone https://github.com/phoenixxbasit/laravel-todolist.git
   ```

2. **Change directory:**

   ```bash
   cd laravel-todo-list
   ```

3. **Install dependencies:**

   Use [Composer](https://getcomposer.org/) to install PHP dependencies.

   ```bash
   composer install
   ```

4. **Copy the environment file:**

   Duplicate the `.env.example` file and name it `.env`. Configure your database connection settings in the new `.env` file.

   ```bash
   cp .env.example .env
   ```

5. **Generate an application key:**

   Run the following command to generate an application key.

   ```bash
   php artisan key:generate
   ```

6. **Migrate the database:**

   Run the migrations along with seeding to create the necessary tables with relevant data.

   ```bash
   php artisan migrate --seed
   ```

7. **Start the development server:**

   Use the following command to start the Laravel development server:

   ```bash
   php artisan serve
   ```

8. **Access the application:**

   Open your web browser and visit `http://localhost:8000` to access the application.

## Usage

1. **Signup:** Create an account using your email and password.

2. **Login:** Sign in with your credentials.

3. **Create Task:** Click the "Add Task" button to create a new task.

4. **View Task:** Access your tasks through the "View Tasks" menu item.

5. **Edit Task:** Edit tasks by clicking on the "Edit" button.

6. **Delete Task:** Remove tasks by clicking on the "Delete" button.

## Authentication

The authentication system ensures that only authorized users can access the application. Login and signup routes are available.

## Routes

- `/login`: User login and authentication.
- `/logout`: Log out the user.
- `/register`: User registration.
- `/tasks`: List tasks.
- `/tasks/create`: Create a new task.
- `/tasks/{task}/edit`: Edit a specific task.

## Validation

Input data is validated to prevent errors, ensuring data integrity and accuracy.

## Middleware

Middleware components handle various checks, such as authentication and input validation, before processing requests. They are defined in the Laravel application and provide security and data integrity.

## Components

The codebase is organized into components for maintainability and scalability. Laravel's architecture and folder structure promote a clean and modular approach to development.

**Feel free to contribute, report issues, or use this project as a foundation for your own Laravel-based applications.**

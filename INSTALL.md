# Installation Guide for Simple Resume Builder

Follow these steps to install and set up the Simple Resume Builder application on your local development environment.

## Prerequisites

Before you begin, make sure you have the following software installed:

- [PHP](https://www.php.net/downloads) (>= 7.4)
- [Composer](https://getcomposer.org/download/)
- [Node.js](https://nodejs.org/en/download/)
- [npm](https://www.npmjs.com/get-npm)
- [MySQL](https://dev.mysql.com/downloads/) or another database server
- [Git](https://git-scm.com/downloads) (optional but recommended)

## Installation Steps

1. **Clone the Repository:**

   Clone the repository to your local machine using the following command:

   ```sh
   git clone https://github.com/joebakaz/simple-resume-builder.git
   cd simple-resume-builder

2. **Install PHP Dependencies:**

   Install the required PHP dependencies using Composer:

   ```sh
   composer install

3. **Install Frontend Dependencies:**

   Install the frontend dependencies (JavaScript, CSS) using npm:

   ```sh
   npm install

4. **Create Environment File:**

   Make a copy of the .env.example file and rename it to .env. Update the database configuration in the .env file with your MySQL credentials.

   ```sh
   cp .env.example .env

5. **Generate Application Key:**

   Generate a unique application key:

   ```sh
   php artisan key:generate

6. **Run Database Migrations:**

   Run the database migrations to create the necessary tables:

   ```sh
   php artisan migrate
   
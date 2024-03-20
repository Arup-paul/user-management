
## User Management System 

## Requirements
- PHP Version  8.2 
- Laravel 11


## Installation

-  Clone the repository `git clone https://github.com/Arup-paul/user-management.git`

## Install Backend

- cd into the project directory `cd  user-management`
- Install the Composer dependencies `composer install`
- Set Up .env File `cp .env.example .env`
- Generate an application key: `php artisan key:generate`
- Configure Database
- `DB_CONNECTION=mysql
  DB_HOST=127.0.0.1
  DB_PORT=3306
  DB_DATABASE=your_database_name
  DB_USERNAME=your_database_username
  DB_PASSWORD=your_database_password`

-   Run Migrations `php artisan migrate`
-   Run Seed `php artisan db:seed`
-   Start the Development Server `php artisan serve`



## Install Frontend
- Install the npm dependencies `npm install`
- Start the Development Server `npm run dev`





  



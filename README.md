# Deskify
Web application designed to manage office desk reservations efficiently. Built with Laravel 11 and Vue.js, it ensures a smooth experience for both users and administrators.

## Technologies
<table>
    <tr>
        <td>
            <img src="https://static-00.iconduck.com/assets.00/laravel-icon-497x512-uwybstke.png" width="50" style="vertical-align: middle;">
        </td>
        <td>
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/95/Vue.js_Logo_2.svg/2367px-Vue.js_Logo_2.svg.png" width="50" style="vertical-align: middle;">
        </td>
        <td>
            <img src="https://raw.githubusercontent.com/innocenzi/awesome-inertiajs/main/assets/logo.svg" width="50" style="vertical-align: middle;">
        </td>
        <td>
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/d/d5/Tailwind_CSS_Logo.svg/2560px-Tailwind_CSS_Logo.svg.png" width="50" style="vertical-align: middle;">
        </td>
    </tr>
</table> 


## Features
<p>✅ Desk reservations for users</p>
<p>✅ Calendar-based booking system</p>
<p>✅ Admin panel for managing desks and users</p>
<p>✅ Role management</p>

## Installation
##### Clone the repository
```
  git clone https://github.com/mateziya/desk-booking-app.git
  cd desk-booking-app
```
##### Install dependencies
```
  composer install
  npm install 
```
##### Configure the .env file
```
  cp .env.example .env
  php artisan key:generate
```
##### Run migrations and seeders
```
  php artisan migrate --seed
```
##### Start the application
```
  php artisan serve
  npm run dev
```

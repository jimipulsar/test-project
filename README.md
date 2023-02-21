## Trustfactory Test Project

## FEATURES


The user management should have the following features

    Create, Edit & View users

    Archive users

    Invite users via email

    Users overview with simple filtering (searching by email/name and filtering out archived users)

    Track the last login per user

Two jobs :

    sending email invitations

    archiving a user that did not log-in in the last 24 hours. This job should run every day at 1 pm



### START (LARAVEL WEB SITE) LOCAL DEV [LIVEWIRE E-COMMERCE PLATFORM]

    composer install && composer dump-autoload
    npm install && npn run dev
    php artisan storage:link
    php artisan key:generate && php artisan serve

### POPULATE DATABASE WITH FAKE DATA [LIVEWIRE E-COMMERCE PLATFORM]

    php artisan migrate:fresh --seed

## ADMIN LOGIN PANEL

    ADMIN PANEL URL: http://localhost:8000/login

    username: jimipulsar@github.com
    password: 123pie456

## .ENV EXAMPLE

    Check .env.example to set up application

## EXECUTE CRON JOB
       0 1 * * * cd /var/www/html/test-project && php artisan schedule:run >> /dev/null 2>&1


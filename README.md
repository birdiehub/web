# Golf API
Codebase Docs  
> Version: 1.0.0  
> Author: [Thibo Verbeerst](http://thiboverbeerst.com)

`>` [API Documentation](https://www.thibo.cloud/private/api/services/golf-api/documentation)

## Description
Monolithic Architecture  
Framework: Laravel 9.19

## Get Started  
### Requirements

- [PHP 8.0](http://php.net/downloads.php)

### Installation
1. Clone the repository
2. Install the dependencies with `composer install`
3. Copy the `.env.example` file to `.env` and fill in the required values
4. Run the migrations with `php artisan migrate`
5. Run the seeder with `php artisan db:seed`
6. Generate the application key with `php artisan key:generate`
7. Generate the JWT secret with `php artisan jwt:secret`

## Authentication
JWT authentication is used for the API.

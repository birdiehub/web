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

Unauthenticated requests are handled by the `App\Http\Middleware\Authenticate` middleware.  
When a request is unauthenticated, the AuthenticationException is thrown.

## Access Control
Is handled by the middleware og the Laravel Permissions package.
### Roles & Permissions
- Super Admin: `All Permissions`
- Admin: `View Users, Create Users, Edit Users, Delete Users, View Roles, View Permissions`
- Editor: `Create Players, Edit Players, Delete Players, Create Countries, Edit Countries, Delete Countries`
- Viewer: `View Players, View Countries`

> Inheritance: `Super Admin` > `Admin` > `Editor` > `Viewer`  

> The `Super Admin` role is not available in the application. It can only be created in the database.


## Composer Additional Requirements
- [Laravel JWT Auth](https://laravel-jwt-auth.readthedocs.io/en/latest/)  
- [Laravel Permissions](https://spatie.be/docs/laravel-permission/v5/introduction)  
- [Laravel Translatable](https://spatie.be/docs/laravel-translatable/v6/introduction)  
- [Laravel Unique Translation Validation](https://github.com/codezero-be/laravel-unique-translation)


## Exceptions  
The following exceptions are used in the application and are handled in the `app/Exceptions/Handler.php` file.

#### General
```php
\App\Exceptions\Custom\GeneralException
```

#### Invalid Arguments
```php
\InvalidArgumentException
```

#### Invalid Routes
```php
\Symfony\Component\HttpKernel\Exception\NotFoundHttpException
```

#### Authentication
```php
\Illuminate\Auth\AuthenticationException
``` 

#### Authorization (Access Control)
```php
\Spatie\Permission\Exceptions\UnauthorizedException
\Illuminate\Auth\Access\AuthorizationException
```

#### Validation
```php
\Illuminate\Validation\ValidationException
```

#### Not Found Models
```php
\Illuminate\Database\Eloquent\ModelNotFoundException
```

#### Not Yet Implemented
```php
\App\Exceptions\Custom\NotYetImplementedException
```


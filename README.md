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

### Policies
The following policies are used in the application and are registered in the `app/Providers/AuthServiceProvider.php` file.
These policies are used to handle the access control for the models. When a user is not authorized to perform an action, the UnauthorizedException is thrown.
#### User Policy  
The `App\Policies\UserPolicy` class is used to handle the access control for the `App\Models\User` model.  
_Permissions handled by the policy:_
- `view-users-list`
- `view-users-details`
- `create-users`
- `edit-users`
- `delete-users`
- `view-own-user`
- `edit-own-user`
- `delete-own-user`
- `view-user-access`
- `grant-user-permissions`
- `revoke-user-permissions`
- `grant-user-roles`
- `revoke-user-roles`

#### Permission Policy
The `App\Policies\PermissionPolicy` class is used to handle the access control for the `Spatie\Permission\Models\Permission` model.  
_Permissions handled by the policy:_
- `view-permissions-list`
- `view-permissions-details`

#### Role Policy
The `App\Policies\RolePolicy` class is used to handle the access control for the `Spatie\Permission\Models\Role` model.  
_Permissions handled by the policy:_
- `view-roles-list`
- `view-roles-details`
- `create-roles`
- `delete-roles`
- `grant-role-permissions`
- `revoke-role-permissions`

#### Country Policy
The `App\Policies\CountryPolicy` class is used to handle the access control for the `App\Models\Country` model.  
_Permissions handled by the policy:_
- `view-countries-list`
- `view-countries-details`
- `create-countries`
- `edit-countries`
- `delete-countries`

#### Player Policy
The `App\Policies\PlayerPolicy` class is used to handle the access control for the `App\Models\Player` model.  
_Permissions handled by the policy:_
- `view-players-list`
- `view-players-details`
- `create-players`
- `edit-players`
- `delete-players`

### Roles
- `super-admin`: Has all permissions and cannot be deleted.
- `admin`: Manages user access; View, edit or delete users, roles; Inherits `editor`.
- `editor`: View, edit or delete countries, players; Inherits `viewer`.
- `viewer`: View countries, players; View, edit or delete own user.

> The `Super Admin` role has all permissions and cannot be deleted.


## Composer Additional Requirements  
Pleease refer to the documentation of the packages for more information.
- [Laravel JWT Auth](https://laravel-jwt-auth.readthedocs.io/en/latest/)  
- [Laravel Permissions](https://spatie.be/docs/laravel-permission/v5/introduction)  
- [Laravel Translatable](https://spatie.be/docs/laravel-translatable/v6/introduction)  
- [Laravel Unique Translation Validation](https://github.com/codezero-be/laravel-unique-translation)

## Models
Models are used to handle the data of the application.
### User
The `App\Models\User` model is used to handle the user data.  
The model uses the `Spatie\Permission\Traits\HasRoles` trait to handle the roles and permissions.  
_Relations:_
- `country`: Belongs to a country.  

_Hidden Fields:_
- `password`
- `remember_token`

### Permission
The `Spatie\Permission\Models\Permission` model is used to handle the permissions.  
_Relations:_
- `roles`: Belongs to many roles.
- `users`: Belongs to many users.

### Role
The `Spatie\Permission\Models\Role` model is used to handle the roles.  
_Relations:_
- `permissions`: Belongs to many permissions.
- `users`: Belongs to many users.

### Country
The `App\Models\Country` model is used to handle the country data.  
The model uses the `Spatie\Translatable\HasTranslations` trait to handle the translations.  
_Relations:_
- `players`: Has many players.
- `users`: Has many users.  

_Translatable Fields:_
- `name`

### Player
The `App\Models\Player` model is used to handle the player data.  
The model uses the `Spatie\Translatable\HasTranslations` trait to handle the translations.  
_Relations:_
- `country`: Belongs to a country.
- `snapshots`: Has many snapshots.
- `socials`: Has many socials.
- `leaderboard`: Has many leaderboard entries.  

_Translatable Fields:_
- `gender`
- `bio`
- `degree`
- `family`

### Snapshot
The `App\Models\Snapshot` model is used to handle the player snapshots.  
The model uses the `Spatie\Translatable\HasTranslations` trait to handle the translations.  
_Relations:_
- `player`: Belongs to a player.  

_Translatable Fields:_
- `title`
- `value`
- `description`

### Social
The `App\Models\Social` model is used to handle the player socials.  
_Relations:_
- `player`: Belongs to a player.

### Leaderboard
The `App\Models\Leaderboard` model is used to handle the leaderboard entries.  
_Relations:_
- `player`: Belongs to a player.

## Resources
A resource is used to transform a single model instance, while a resource collection is used to transform a collection of model instances. 
This can be used to transform the data of the model to a specific format or hide certain fields. 
Or include relations of the model in the response.  

Resources are located in the `app/Http/Resources` directory and can be used as return value in the controllers.

_Note:_  
I have created my own abstract resource and resource collection class so that I can pass the language as extra parameter to the resource.
And added the `translate` method to the resource class to translate the translatable fields of the model.
````php
protected function translate(string $attribute, bool $useFallbackLocale = true): string | null
{
    $translation = $this->resource->getTranslation($attribute, $this->_language ?? "", $useFallbackLocale);
    return $translation === "" ? null : $translation;
}
````

## Controllers
Controllers are used to handle the requests and responses of the application.  
They are located in the `app/Http/Controllers` directory.

## Services
Services are used to handle the business logic of the application.  
They are located in the `app/Services` directory.

## Validators
Validators are used to validate the data of the application.
They are located in the `app/Validators` directory.


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


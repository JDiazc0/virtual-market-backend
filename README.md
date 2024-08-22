# Backend API Market Virtual

This project is a backend API for a virtual marketplace where two types of users are managed: stores and clients. The system allows user registration, product management, promotions, and a shopping cart, among other functionalities that will be implemented in the future.

## Features

-   User registration (stores and clients).

## Prerequisites

-   PHP 8.x or higher
-   Laravel 10.x
-   MySQL or any database compatible with Laravel

## Endpoints

### User Registration

-   **URL:** api/register
-   **Method:** POST
-   **Description:** create a new user
-   **Parameters:**
    -   **USER:**
        -   'user_type'
        -   'phone'
        -   'email'
        -   'password'
    -   **Type Store:**
        -   'store_name'
        -   'description'
        -   'phone_store'
        -   'address'
        -   'neighborhood'
        -   'rating'
    -   **Type Client**
        -   'username'
        -   'gender'
        -   'birthday'

```json
// Store user
{
    "email": "store@gmail.com",
    "password": "123456",
    "password_confirmation": "123456",
    "phone": "2223334455",
    "user_type": 1,
    "store_name": "Test Store",
    "description": "Testing Store",
    "phone_store": "22244455",
    "address": "Main Street 123",
    "neighboord": "Test district",
    "rating": 0
}

// Client user
{
    "email": "client@gmail.com",
    "password": "123456",
    "password_confirmation": "123456",
    "phone": "2223334455",
    "user_type": 2,
    "username": "First client",
    "gender": 1,
    "birthday":"1990-01-01"
}
```

-   response:

```json
{
    "user_type": 2,
    "phone": "2223334455",
    "email": "client@gmail.com",
    "updated_at": "2024-08-19T15:45:31.000000Z",
    "created_at": "2024-08-19T15:45:31.000000Z",
    "id": 7
}
```

### Login User

-   **URL:** api/login
-   **Method:** POST
-   **Description:** Log in an existing user
-   **Parameters:**
    -   'login'
    -   'password'

```json
// Login
{
    "login": "client@gmail.com",
    "password": "123456"
}
```

-   response:

```json
{
    "token": "5|Oj25pXpdg5e0KpkgSSnSDlD0NLELPNhphRNw5Rzefe3b581d"
}
// Enable the login cookie token
```

### Recovery Forgot Password

-   **URL:** api/forgot-password
-   **Method:** POST
-   **Description:** Password recovery method
-   **Parameters:**
    -   'email'

```json
// Recovery form
{
    "email": "client@gmail.com"
}
```

-   response:

```json
{
    "message": "We have emailed your password reset link."
}
```

### Reset Password

-   **URL:** api/reset-password?<token>&<email>
-   **Method:** POST
-   **Description:** Password reset method
-   **Parameters:**
    -   'token'
    -   'email'
    -   'password'
    -   'password_confirmation'

```json
// Reset form
{
    "token": "4152f983f6955cfc228d60307c21a4774d054746141fd727351b04e44d486f55",
    "email": "jhoanandresd@gmail.com",
    "password": "87654321",
    "password_confirmation": "87654321"
}
```

-   response:

```json
{
    "message": "Your password has been reset."
}
```

## Data base MER

![Diagrama de la Base de Datos](/Market_Backend.png)

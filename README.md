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

-   **URL:** api/reset-password?{token}&email?{email}
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

### Products

-   **URL:** api/products
-   **Method:** GET
-   **Description:** Get all existing products

-   response:

```json
[
    {
        "id": 1,
        "barcode": "78113021671",
        "product_name": "Beef - Tenderlion, Center Cut",
        "description": "at lorem integer tincidunt ante vel ipsum praesent blandit lacinia",
        "presentation": "unit",
        "size": null,
        "weight": null,
        "created_at": null,
        "updated_at": null
    },
    {
        "id": 2,
        "barcode": "94501157686"
        //...
    }
]
```

### Product id

-   **URL:** api/product/{id}
-   **Method:** GET
-   **Description:** Search for a specific product and return to the stores that sell it

-   response:

```json
{
    "id": 14,
    "barcode": "65155825476",
    "product_name": "Pie Shells 10",
    "description": "rhoncus dui vel sem sed sagittis nam congue risus semper porta volutpat quam",
    "presentation": "unit",
    "size": null,
    "weight": null,
    "created_at": null,
    "updated_at": null,
    "stores": [
        {
            "id": 1,
            "status": 1,
            "store_name": "Test Store",
            "description": "Testing Store",
            "phone": "22244455",
            "address": "Main Street 123",
            "neighborhood": "",
            "rating": "0.00",
            "id_user": 1,
            "created_at": "2024-08-26T15:55:39.000000Z",
            "updated_at": "2024-08-26T15:55:39.000000Z",
            "pivot": {
                "id_product": 14,
                "id_store": 1,
                "amount": "5.00",
                "created_at": "2024-08-26T19:43:38.000000Z",
                "updated_at": "2024-08-26T19:43:38.000000Z"
            }
        }
    ]
}
```

### Stores

-   **URL:** api/stores
-   **Method:** GET
-   **Description:** Get all existing stores

-   response:

```json
[
    {
        "id": 1,
        "status": 1,
        "store_name": "Test Store",
        "description": "Testing Store",
        "phone": "22244455",
        "address": "Main Street 123",
        "neighborhood": "",
        "rating": "0.00",
        "id_user": 1,
        "created_at": "2024-08-26T15:55:39.000000Z",
        "updated_at": "2024-08-26T15:55:39.000000Z"
    }
]
```

### Stores id

-   **URL:** api/store/{id}
-   **Method:** GET
-   **Description:** Search for a specific store and return all of its products

-   response:

```json
{
    "id": 1,
    "status": 1,
    "store_name": "Test Store",
    "description": "Testing Store",
    "phone": "22244455",
    "address": "Main Street 123",
    "neighborhood": "",
    "rating": "0.00",
    "id_user": 1,
    "created_at": "2024-08-26T15:55:39.000000Z",
    "updated_at": "2024-08-26T15:55:39.000000Z",
    "products": [
        {
            "id": 14,
            "barcode": "65155825476",
            "product_name": "Pie Shells 10",
            "description": "rhoncus dui vel sem sed sagittis nam congue risus semper porta volutpat quam",
            "presentation": "unit",
            "size": null,
            "weight": null,
            "created_at": null,
            "updated_at": null,
            "pivot": {
                "id_store": 1,
                "id_product": 14,
                "amount": "5.00",
                "created_at": "2024-08-26T19:43:38.000000Z",
                "updated_at": "2024-08-26T19:43:38.000000Z"
            }
        }
    ]
}
```

### Add products

-   **URL:** api/stores/add-products
-   **Method:** POST
-   **Description:** Add products to the store (url protected for stores only)
-   **Parameters**

    -   'id_product'
    -   'id_store'
    -   'amount'

```json
[
    {
        "id_product": 14,
        "id_store": 1,
        "amount": 10
    }
]
```

-   response:

```json
{
    "message": "Product Add succesfylly"
}
```

### Add promotions

-   **URL:** api/stores/add-promotions
-   **Method:** POST
-   **Description:** Add promotions to the store (url protected for stores only)
-   **Parameters**

    -   'id_promotion'
    -   'id_store'
    -   'start_date'
    -   'end_date'
    -   'promotion_status'

```json
[
    {
        "id_promotion": 1,
        "id_store": 1,
        "start_date": "2024-08-15",
        "end_date": "2024-08-15",
        "promotion_status": 1
    }
]
```

-   response:

```json
{
    "message": "Promotion Add succesfylly"
}
```

### Activate promotions

-   **URL:** api/stores/activate-promotions
-   **Method:** POST
-   **Description:** Activate existing promotions in the store (url protected for stores only)
-   **Parameters**

    -   'id_promotion'
    -   'id_store'

```json
{
    "id_store": 1,
    "id_promotion": 2
}
```

-   response:

```json
{
    "message": "Promotion activated successfully"
}
```

### Deactivate promotions

-   **URL:** api/stores/deactivate-promotions
-   **Method:** POST
-   **Description:** Deactivate existing promotions in the store (url protected for stores only)
-   **Parameters**

    -   'id_promotion'
    -   'id_store'

```json
{
    "id_store": 1,
    "id_promotion": 2
}
```

-   response:

```json
{
    "message": "Promotion deactivated successfully"
}
```

### Create shopping cart

-   **URL:** api/user-client/shoppingCart
-   **Method:** POST
-   **Description:** Create or Update a shopping cart (url protected for user clients only)
-   **Parameters**

    -   'id_product'
    -   'id_store'
    -   'id_user'
    -   'amount'

```json
{
    "id_user": 2,
    "id_store": 1,
    "id_product": 14,
    "amount": 1
}
```

-   response:

```json
// Create shopping cart
{
    "message": "Product successfully added to the cart"
}

// Update shopping cart
{
	"message": "Product quantity successfully updated in the cart"
}
```

### Delete shopping cart

-   **URL:** api/user-client/shoppingCart
-   **Method:** DELETE
-   **Description:** Delete a shopping cart (url protected for user clients only)
-   **Parameters**

    -   'id_product'
    -   'id_store'
    -   'id_user'

```json
{
    "id_user": 2,
    "id_store": 1,
    "id_product": 14
}
```

-   response:

```json
// Delete shopping cart
{
    "message": "Product successfully removed from the cart"
}
```

## Data base MER

![Diagrama de la Base de Datos](/Market_Backend.png)

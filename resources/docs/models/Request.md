# App\Models\Integrations\Request

The request model acts as a request log for any integration actions taken. These include searching for products, importing a product into a provider, etc.

This table is for logging purposes only and for keeping track of any errors that may crop up in making requests.

Table: requests

## Attributes
Column          | Type(s)                   | Comment
----------------|---------------------------|------------------------------------------------------------
id              | Big Integer, Primary key  |
user_id         | Big Integer, Nullable     | Nullable as requests may not be triggered by users
provider        | String(20)                | The provider that triggered the request
handler         | String(255)               | The class that made the request
method          | String(6)                 | Enum: GET, POST, PUT, PATCH, DELETE
uri             | String(255)               | The endpoint that the request was made to (including host)
status_code     | Integer                   | The HTTP Status Code
duration        | Integer                   | The time taken to complete the request in miliseconds
data            | Text                      | Any important request data worth logging
created_at      | Timestamp, Nullable       |
updated_at      | Timestamp, Nullable       |

## Casts
- data | array

## Relationships
- A request can belong to an `App\Models\User`. An `App\Models\User` has many requests.

## Indexes
Columns             | Reason
--------------------|------------------------
id                  | Primary key
user_id             | Common search parameter
provider            | Common search parameter
provider, user_id   | Common search parameter

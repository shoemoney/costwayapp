# App\Models\Products\Export

A product export is a log of the products that have been exported by a user to a provider.

Table: product_exports

## Attributes
Column          | Type(s)                   | Comment
----------------|---------------------------|------------------------------------------------------------
id              | Big Integer, Primary key  |
user_id         | Big Integer               | The user's internal identifier
product_id      | Big Integer               | The product's internal identifier
created_at      | Timestamp, Nullable       |
updated_at      | Timestamp, Nullable       |

## Casts
This model has no casts.

## Relationships
- An export belongs to an `App\Models\User`.
- An export belongs to an `App\Models\Product`.

## Indexes
Columns                 | Reason
------------------------|--------------------
id                      | Primary key
product_id, user_id     | Composite unique key
product_id              | Common search parameter
user_id                 | Common search parameter

# App\Models\Products\Category

A provider has many categories for products. This table is used to keep track of categories for ease of searching and for relational purposes on a product.

Table: categories

## Attributes
| Column     | Type(s)                  | Comment                                             |
| ---------- | ------------------------ | --------------------------------------------------- |
| id         | Big Integer, Primary key |
| provider   | String(20)               | The provider where the product is sold              |
| identifier | String(40)               | The provider's identifier for the category          |
| name       | String(255)              | The provider's name for the category                |
| parent_id  | String(40)               | The provider's identifier for the category's parent |
| created_at | Timestamp, Nullable      |
| updated_at | Timestamp, Nullable      |

## Casts
This model has no casts.

## Relationships
- A category has many `App\Models\Product`. An `App\Models\Product` belongs to many categories.

## Indexes
| Columns   | Reason                  |
| --------- | ----------------------- |
| id        | Primary key             |
| provider  | Common search parameter |
| parent_id | Common search parameter |

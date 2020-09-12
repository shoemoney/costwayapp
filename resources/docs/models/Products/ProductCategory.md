# App\Models\Products\ProductCategory | Pivot

A product has many categories, a category has many products. This table acts as a pivot between the categories table and the products table.

Table: product_categories

## Attributes
| Column      | Type(s)                  | Comment                            |
| ----------- | ------------------------ | ---------------------------------- |
| id          | Big Integer, Primary key |
| category_id | Big Integer              | The category's internal identifier |
| product_id  | Big Integer              | The product's internal identifier  |
| created_at  | Timestamp, Nullable      |
| updated_at  | Timestamp, Nullable      |

## Casts
There are no casts on this model.

## Relationships
- A ProductCategory belongs to `App\Models\Product`.
- A ProductCategory belongs to `App\Models\Products\Category`.

## Indexes
| Columns                 | Reason                  |
| ----------------------- | ----------------------- |
| id                      | Primary key             |
| category_id, product_id | Composite unique key    |
| category_id             | Common search parameter |
| product_id              | Common search parameter |

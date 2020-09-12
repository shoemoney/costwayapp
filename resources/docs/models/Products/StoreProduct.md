# App\Models\Products\StoreProduct | Pivot

A store can have many products. This model acts as a pivot between the stores and products tables.

Table: store_products

## Attributes
| Column     | Type(s)                  | Comment                           |
| ---------- | ------------------------ | --------------------------------- |
| id         | Big Integer, Primary key |
| store_id   | Big Integer              | The store's internal identifier   |
| product_id | Big Integer              | The product's internal identifier |
| created_at | Timestamp, Nullable      |
| updated_at | Timestamp, Nullable      |

## Casts
There are no casts on this model.

## Relationships
- A StoreProduct belongs to many `App\Models\Store`.
- A StoreProduct belongs to many `App\Models\Product`.

## Indexes
| Columns              | Reason               |
| -------------------- | -------------------- |
| id                   | Primary key          |
| store_id, product_id | Composite unique key |

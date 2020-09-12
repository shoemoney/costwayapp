# App\Models\Products\Meta

A product metadata record contains a key => value to be used by the associated product record.

Table: product_metadata

## Attributes
| Column     | Type(s)                  | Comment                           |
| ---------- | ------------------------ | --------------------------------- |
| id         | Big Integer, Primary key |
| product_id | Big Integer              | The product's internal identifier |
| key        | String(100)              | The key being monitored           |
| value      | Text                     |
| created_at | Timestamp, Nullable      |
| updated_at | Timestamp, Nullable      |

## Casts
This model has no casts.

## Relationships
- Metadata belongs to an `App\Models\Product`.

## Indexes
| Columns         | Reason                  |
| --------------- | ----------------------- |
| id              | Primary key             |
| product_id, key | Composite unique key    |
| product_id      | Common search parameter |
| key             | Common search parameter |

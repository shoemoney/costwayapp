# App\Models\Products\Metric

A product metric is the tracking of a products values that would interest a dropshipper. An example of this would be watching the price of the product over time, or the number of hits that it has had.

Table: product_metrics

## Attributes
Column          | Type(s)                   | Comment
----------------|---------------------------|------------------------------------------------------------
id              | Big Integer, Primary key  |
product_id      | Big Integer               | The product's internal identifier
key             | String(100)               | The key being monitored
value           | String(50)                | The snapshotted value being monitored
created_at      | Timestamp, Nullable       |
updated_at      | Timestamp, Nullable       |

## Casts
This model has no casts.

## Relationships
- A metric belongs to an `App\Models\Product`.

## Indexes
Columns                 | Reason
------------------------|--------------------
id                      | Primary key
product_id, key         | Composite unique key
product_id              | Common search parameter
key                     | Common search parameter

## Notes
- Update product relationship to be polymorphic

# App\Models\Products\Sale

The product_sales table records the sales made for a product on a given provider's platform.

This table is populated when a user first looks at a product and is kept up-to-date daily.

Table: product_sales

## Attributes
| Column     | Type(s)                  | Comment                                             |
| ---------- | ------------------------ | --------------------------------------------------- |
| id         | Big Integer, Primary key |
| provider   | String(20)               | The provider where the product is sold              |
| product_id | String(40)               | The Product identifier given by the provider        |
| quantity   | Integer (Unsigned)       |
| price      | Integer (Unsigned)       |
| currency   | String(3)                | ISO 4217 standard for currency codes, e.g. GBP, USD |
| sold_at    | Timestamp                | The date that the product was sold                  |
| created_at | Timestamp, Nullable      |
| updated_at | Timestamp, Nullable      |

## Casts
- price | on set: integer - on get: float

## Relationships
- A sale belongs to an `App\Models\Product`. An `App\Models\Product` has many sales. This relationship is polymorphic where `product_id` is the identifier and `provider` acts as the type.
- A sale belongs to an `App\Models\Store` through an `App\Models\Product`. An `App\Models\Store` has many sales.

## Indexes
| Columns    | Reason                  |
| ---------- | ----------------------- |
| id         | Primary key             |
| provider   | Common search parameter |
| product_id | Common search parameter |
| sold_at    | Common search parameter |

## Considerations
Might be worth looking at [defining custom collections](https://laravel.com/docs/5.8/eloquent-collections#custom-collections) when using this for the ability to group by day and any other custom logic.

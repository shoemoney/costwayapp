# App\Models\Product

INCOMPLETE - Requires collaboration

- A product needs to have a selling status as they may become unlisted

Table: products

## Attributes
| Column      | Type(s)                  | Comment                                         |
| ----------- | ------------------------ | ----------------------------------------------- |
| id          | Big Integer, Primary key |
| provider    | String(20)               | The provider where the product is listed        |
| identifier  | String(40), Nullable     | The provider's identifier for the product       |
| name        | String(255)              |
| description | String(500)              |
| images      | Text                     | Array containing all images for the product     |
| price       | Integer (unsigned)       | The price of the product in pennies             |
| currency    | String(3)                | ISO 4217 Standard for currencies, e.g. GBP, USD |
| created_at  | Timestamp, Nullable      |
| updated_at  | Timestamp, Nullable      |
| deleted_at  | Timestamp, Nullable      |

## Casts
- The `price` attribute should be divided by 100 and rounded to 2DP for pound values.

## Relationships
- A product belongs to many `App\Models\Store`. An `App\Models\Store` has many products.
- A product can be "watched" by an `App\Models\User`.
- A product belongs to many `App\Models\Products\Category`. An `App\Models\Products\Category` has many products.

## Indexes
| Columns              | Reason                  |
| -------------------- | ----------------------- |
| id                   | Primary key             |
| provider, identifier | Common search parameter |
| identifier           | Common search parameter |
| provider             | Common search parameter |


## Notes
- Need to ask the user to enter a quantity
- Need to ask for duration
- Best offer flag
- Get eBay store location to attach to exports
- Need to make a user settings table (Payment methods, store location, Dispatch Time, Base Shipping details, returns policy)
- A product can override the base shipping from a user
- A prodct can override the base returns policy
- UPC, EAN or ASIN
- Condition

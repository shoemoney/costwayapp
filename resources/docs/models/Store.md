# App\Models\Store

A store is an entity contained within the given provider that sells products.

A User can watch a store to see their products and sale history. This is a common tactic among dropshippers to see what their competitors are doing.

Table: stores

## Attributes
Column          | Type(s)                   | Comment
----------------|---------------------------|------------------------------------------------------------
id              | Big Integer, Primary key  |
provider        | String(20)                | The provider where the store is listed
identifier      | String(100)               | The store's identifier on the provider
name            | String(255)               | The given name of the store on the provider's site
created_at      | Timestamp, Nullable       |
updated_at      | Timestamp, Nullable       |


## Relationships
- A store has many products through `App\Models\Products\StoreProduct`.
- A store can be "watched" by an `App\Models\User`.
- A store has many sales through an `App\Models\Product`.

## Indexes
Columns                 | Reason
------------------------|--------------------
id                      | Primary key
provider, identifier    | Composite unique key
provider                | Common search parameter
identifier              | Common search parameter

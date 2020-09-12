# App\Models\User\Watcher | Pivot

A user can watch many resources, including: `App\Models\Product` and `App\Models\Store`. This table acts as a polymorphic pivot between a user and the resource that they are watching.

Table: users_watches

## Attributes
Column          | Type(s)                   | Comment
----------------|---------------------------|------------------------------------------------------------
id              | Big Integer, Primary key  |
user_id         | Big Integer               | The user's internal identifier
watchable_id    | Big Integer               | The resource's internal identifier
watchable_type  | String(100)               | The resource's internal type
paused_at       | Timestamp, Nullable       |
created_at      | Timestamp, Nullable       |
updated_at      | Timestamp, Nullable       |
deleted_at      | Timestamp, Nullable       |

## Casts
- paused_at | DateTime (YYYY-MM-DD HH:ii:ss)

## Relationships
- A Watcher belongs to an `App\Models\User`.
- A Watcher belongs to a `watchable` model.

## Indexes
Columns                         | Reason
--------------------------------|------------
id                              | Primary key
user_id                         | Common search parameter
watchable_id, watchable_type    | Common search parameter

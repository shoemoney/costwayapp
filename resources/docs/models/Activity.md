# App\Models\Activity

An activity is logged when a user performs an action of note.

Table: activities

## Attributes
Column          | Type(s)                   | Comment
----------------|---------------------------|------------------------------------------------------------
id              | Big Integer, Primary key  |
user_id         | Big Integer               | The user's internal identifier
action          | String(255)               | A slug of the action performed
metadata        | String(255)               | Any additional data that helps put the action into context
created_at      | Timestamp, Nullable       |
updated_at      | Timestamp, Nullable       |

## Casts
This model has no casts.

## Relationships
- An export belongs to an `App\Models\User`.

## Indexes
Columns                 | Reason
------------------------|--------------------
id                      | Primary key
user_id                 | Common search term
action                  | Common search term

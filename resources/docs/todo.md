# General
- [ ] Create scheduled task to get the past 100 orders per product
- [ ] Create scheduled task to cache available categories per provider
- [x] Collapse scraping infrastructure in favour of APIs
- [ ] Design a way of getting an ISO 4217 Currency Code from symbol

# Database
- [ ] Create products
    - [ ] migration
      - [x] Basic implementation
    - [ ] model
      - [x] Basic implementation
    - [ ] documentation
      - [x] Basic design
- [x] Create the store_products (pivot)
- [x] Create request log
- [x] Create stores
- [x] Create the users_watches (polymorphic pivot)
- [x] Create activities
- [x] Create product_sales
- [x] Create categories
- [x] Create product_categories
- [x] Create product_metrics
- [x] Create product_meta
- [ ] Create product_exports
    - [ ] migration
    - [ ] model
    - [x] documentation

# API
- [x] Products
- [x] Product Sales
- [ ] Stores
- [ ] Watchers

# Integrations Framework
- [ ] Log requests made in the database
    - [x] Event fired once a request is made
- [x] Look at moving scraping sales into integrations framework for consistency of calls
- [ ] Refactor import eBay product to use requests/responses/entities
- [ ] Refactor eBay categories to use integrations framework structure
    - [x] Make categories callable via the integrations framework
    - [x] Update categories response formatting to match database table
    - [ ] Replace hknonnet request with internal request
- [x] Create product entity for search results

# Testing
- [ ] Unit test integrations framework
- [ ] Feature test searching products

# Documentation
- [x] Restructure Models documentation structure to match the app/Models structure
- [ ] How the integration framework works
- [ ] Using integrations framework
- [ ] Adding to integrations framework
- [x] How to search for a product
- [ ] How to search a category
- [ ] How to list categories
- [ ] How to search a store's products
- [ ] How to get more information about product(s)

## Notes
- Look into a link between an exported product and the source (cloned from product)
- Predict how much profit you could make by fulfilling a percentage of the original seller's sales
- Track the top products in their categories by day by default

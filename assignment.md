# Aertrip back-end assignment

Challenge is to build a cross functional User's Management (Frontend App, iOS/Andrioid Apps, API consumers)

## Rules

- All users need to be uniquely identified
- All api's required authentication.
- Authorization of API endpoints based upon Type of User.
- *BONUS* Mapping of sub-accounts with main User

## Requirements

- For each user you have to generate CRUD with following information:
    - email id
    - mobile
    - Name
    - user type (FE / app / consumers)

- Profile Info
    - PAN / GSTIN
    - Address
    
- Subaccounts (Bonus)
    - email id
    - mobile
    - name
    - parent-id

- Create Endpoints for 
    - GET user-data
    - profile info
    - GET airport/search
    - GET accounts/details
    - GET api-hits/count

- For Users of type API Consumers
    - Log API hits
    - Access to only user-data, airport/search endpoints
    
- For Users of type FE & Apps
    - Do not allow Access to api-hits/count
 
- Need to implement search functionality
    - It must be possible to implement caching
    - It must be possible to implement API caching
    - Implement Query caching (Bonus points)

## Bonus points

- We like clean and well documented code.

## What we will evaluate

- The `git` history will be evaluated.
- Do not forget to document the process needed to run and build your app. Or else how are we going to evaluate your work if we can't init the project on our machines?
- Do not forget to add SQL schema along with `DROP DATABASE IF EXISTS`

## Got questions?

- The challenge is harder than you anticipated? Would you like to show your experience with something else? Contact us by opening an _issue_.

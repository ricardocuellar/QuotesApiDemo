## How to run in docker

You need to have docker installed previously. 

In you terminal you need to clone this project. 
Enter to your project and run the following code: 
- docker run --rm --interactive --tty -v $(pwd):/app composer install
After installations you should up the containers.
- sail up

## About API Routes
The routes of the API are the following.
Open routes:
- /register
- /login
- /forget-password

Auth routes: 
- /logout
- /quotes (Update quotes) POST Method
- /quotes/{id} (Show Quote) GET Method
- /quotes/{id} (Update Quote) PUT Method
- /quotes/{id} (Delete Quote) DELETE Method
- /quotes/{id} (Comment Quote) POST Method


Admin routes:
- admin/quotes (Get Quotes) GET Method
  - ?included=comments
  - ?filter[created_at]=2023
  - ?filter[status]=1 (Here we use 1: Draft, 2: Accepted, 3: Declined)
- admin/quotes/{id}/accept (Accept comment) POST Method
- admin/quotes/{id}/decline (Decline comment) POST Method


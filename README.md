# MANUAL  

**How to run the API**
1. Create a database,  
2. Configure your .env file for the new database,  
3. Run *php artisan migrate*,  
4. Run *php artisan passport:keys*, copy the generated keys to be used in frontend for authentication,  
5. Run your server.  

OBS: the API does not store files nor file's url in database, the API look for the files in local storage based on ids of user/feed.

**1. To log in**  
By passing the right username, password, client secret, client id and grant type the auth endpoint returns an access token to be used in almost every request and it will be used to identify the user.  
OBS: The API gets the id of who is logged in so you don`t need to pass it from the frontend.  

**2. To create a new user**  
Firstly the database must have addresses already created, so when creating a new user you must pass which address it belongs.  
You don`t need to be logged in to create a new address or user.  
The inputs *name*, *email* and *password* are required but *photo* is not. The *email* input will be used as username to log in in the API.

**3. To create a new feed**  
You must be logged in.  
The inputs *name* and *description* are required but *photo* is not. Its up to the user if he wants to insert an image too.

**4. To follow a user**  
You must be logged in.  
By passing a GET request of follow endpoint and passing the target user id in it you follow and unfollow an user.

**5. To like a feed**  
You must be logged in.  
By making a GET request passing of like endpoint and passing the target feed id in it you like and dislike a feed.
## Project Overview
Library App project is my personal laravel project which implement SOLID design pattern
and caching data using Redis

### Design Patterns
In this project I'm using `SOLID` design pattern, it is a very popular pattern that has been used
by many developers especially in a big scale project that require high maintainable code.

To be spesific I am using `repository layer (DAO)` and `service layer (Facade)` to separate data access and business logic from the controller 
in order to make the controllers have single responsibility, which is only to be the gate of request and response. Note that it may seem over 
engineering to be used in this simple project, but it is very 
useful when applied to large scale application.

I also use Redis data caching in order to make load
performance becomes faster when fetching the same data over and over.
Note that the cached data will be flushed everytime the data being modified.

To make the error more readable to the user, i am handling the error
in `App\Exceptions\Handler.php` class and disable the debug mode in .env file.



## API endpoint quick guide
| Route  | HTTP Method   | Handler |
| ------------- | -------------  | ------------- |
| /api/v1/authors  | GET   | AuthorController@index  |
| /api/v1/authors/{id}  | GET   | AuthorController@show  |
| /api/v1/authors/{id}  | PUT/PATCH   | AuthorController@update  |
| /api/v1/authors/{id}  | DELETE   | AuthorController@destroy  |
| ------------- | -------------  | ------------- |
| /api/v1/books/  | GET    | BookController@index  |
| /api/v1/books/{id}  | GET    | BookController@show  |
| /api/v1/books/  | POST    | BookController@store  |
| /api/v1/books/{id}  | PUT   | BookController@update  |
| /api/v1/books/{id}  | DELETE    | BookController@destroy  |
| /api/v1/books/{id}/upload-cover  | PATCH    | BookController@uploadCover |


[Full API Endpoint Documentation Link](https://documenter.getpostman.com/view/14542872/UV5RkKLi)


## Installation

1. Clone the repository
    ```bash
    git clone https://github.com/rullyafrizal/api_informasi_buku.git
    ```

2. Use the package manager [composer](https://getcomposer.org/download/) to install vendor.

    ```bash
    composer install
    ```

3. Configure .env files, => copy .env.example and rename it to .env

4. Set your database configuration in .env files

5. Generate APP_KEY

    ```bash
    php artisan key:generate
    ```

6. Run Migration

    ```bash
    php artisan migrate
    ```
   
7. Run Seeder
    ```bash
    php artisan db:seed
    ```

8. Run docker-compose to install redis via docker (optional)
    ```bash
    docker-compose up -d
    ```
    or for V2
   ```bash
    docker compose up -d
    ```

10. To make uploaded files accessible from the web, you should create a symbolic link from public/storage to storage/app/public.

     ```bash
     php artisan storage:link
     ```

11. Run Laravel server

     ```bash
     php artisan serve
     ```
12. (Optional) if you want to trace your bug easily i had installed
    this app with sentry bug tracking, in order to do so just fill your DSN in .env file

### Database Design
![Image of Database](/public/img/erd.png)

### Demo Video
https://www.loom.com/share/876a5c57b0de4cabbc77a1d54fae3d0b

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

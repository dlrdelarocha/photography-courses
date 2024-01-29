
# Photography Courses

This application is built using PHP/Laravel and Docker.
This application is responsible for listening to CommentWritten and LessonWatched events to determine if a user is eligible for a new achievement or Badge.


## Run Locally

Clone the project

```bash
 git clone https://github.com/dlrdelarocha/photography-courses.git
```

Go to the project directory

```bash
  cd photography-courses
```

1.- Ensure that [Docker](https://www.docker.com/get-started) y [Docker Compose](https://docs.docker.com/compose/install/) Compose are installed on your machine. 

2.- Run the following command to build the Docker containers:

```bash
docker-compose build
```
3.- Start the Docker containers in detached mode:

```bash
 docker-compose up -d
```

4.- Install Composer dependencies:

```bash
 composer install
```

## Seeding

Run database migrations and seeders:

```bash
  docker-compose exec app php artisan migrate --seed

```
## Automated Tests

This project includes unit tests to test models, listeners, and controllers. Run the tests using the following command:

```bash
  php artisan test
```

## Testing with Postman


To test the application using Postman, import the provided [Postman collection](https://github.com/dlrdelarocha/photography-courses/blob/main/public/photograpy_requests.json) that includes sample requests:

Postman Collection

1.- Execute requests for endpoints:

http://localhost/api/{lessonId}/comments

http://localhost/api/lessons/{lessonId}/watched

These endpoints trigger the LessonWatched and CommentWritten events, which in turn call the UnlockAchievement listener responsible for checking if a user has unlocked a new achievement.

Note: The UserSeeder assigns comments and watched lessons to the user.

2.- Finally 
After completing the steps above, you can call the endpoint 
http://localhost/users/{userId}/achievements  
to verify that the data is correct.


## Diagram

![Texto alternativo](https://github.com/dlrdelarocha/photography-courses/blob/main/public/event-diagram.png)


## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

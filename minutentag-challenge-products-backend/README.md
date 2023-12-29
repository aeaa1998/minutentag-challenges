# PDP - Backend
This folder has the code for the backend repository. For the setup you have two options:
1. Docker
2. Without Docker

## Docker setup
To test this project with docker it comes with Laravel Sail, you just need to follow the following steps to create the container with the application.

### Steps
1. Copy the .env.example file and rename it as .env
2. Run ```sh composer-install.sh``` in the command line to install composer inside a container. (To create the vendor folder and install dependencies)
3. Run ```sail up```.

After this steps you should have the container listening on port 8000 for requests.

## Without Docker setup

### Requirements
- PHP 8.1 and above
- Have composer installed in the computer

### Steps
1. Copy the .env.example file and rename it as .env
2. Run ```composer install``` to install the dependencies
3. Run ```php artisan serve --port 8000``` to have the application listening on port 8000

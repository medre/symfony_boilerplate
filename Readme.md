# Symfony Boilerplate

This project is a [**Symfony 7.1**](https://symfony.com/doc/7.1/index.html) and
[**Bootstrap 5.3**](https://getbootstrap.com/docs/5.3/customize/overview/)
boilerplate application that integrates several essential services and includes
basic user authentication with login and register functionality setup with
Docker, Nginx, and PHP-FPM. It includes configurations for various environments
and services.

## Prerequisites

Before you begin, ensure you have the following installed on your machine:

-   [Docker](https://www.docker.com/get-started)
-   [Docker Compose](https://docs.docker.com/compose/install/)

## Services Used

-   **PHP-FPM**: Handles PHP processing.
-   **Nginx**: Serves as the web server.
-   **Database**: PostgreSQL & MySQL (optional) database service.
-   **Redis**: Redis service to keep sessions
-   **RabbitMQ**: Advanced Message Queuing Protocol (AMQP) and supports other
    messaging protocols as well.
-   **Mailpit**: Mailpit mailer for email service during development.
-   **Adminer**: Basic database admin panel.

## Installation

1. Clone the Repository.

    Start by cloning the project repository and navigating to the project directory:

    ```
    git clone https://github.com/medre/symfony-boilerplate.git
    cd symfony-boilerplate
    ```

2. Set Up Environment Variables

    The application uses a .env.local file for environment-specific configurations.
    If it doesn’t already exist, copy the .env file and modify it as needed to override
    variables like DATABASE_DSN or APP_URL:

    ```
    cp .env .env.local
    # Edit .env.local to override variables
    ```

3. Build docker containers and start.

    Use Docker Compose to build the containers and start them in the background:

    ```
    docker-compose build
    docker-compose up -d
    ```

4. Create database structure.

    Run the following command to apply database migrations and create the necessary
    database structure:

    ```
    docker-compose exec app bin/console doctrine:migrations:migrate --no-interaction
    ```

5. Build Frontend Assets.

    To build the application’s frontend assets, install the required Node.js dependencies
    and run the Webpack build process:

    ```
    docker-compose exec app npm install
    docker-compose exec app yarn install
    docker-compose exec app yarn encore dev
    docker-compose exec app php bin/console sass:build
    ```

6. Start/Restart Docker containers
    ```
    docker-compose stop
    docker-compose up -d
    ```

#

The application is now set up and ready for use. You can access it by opening
http://localhost in your browser. To get started, visit the Register page to create a new
user account. Once registered, you can log in using your credentials on the Login page
and begin exploring the application.

## Services Access

-   Application: http://localhost:80
-   Mailer: http://localhost:8025
-   Database Admin: http://localhost:8080

## Building Application

This boilerplate has a build.sh file for building the application.
The script is used to build the Symfony application inside a Docker container:

-   Install dependencies
-   Build frontend assets
-   Run database migrations
-   Clear caches

```
./build.sh
```

Change the file permission for execution if you got permission error.

```
chmod +x build.sh
```

## User Module

The application includes a user module with the following pages:

-   **Login URL**: `http://localhost/login`
-   **Register URL**: `http://localhost/register`

## Makefile Description

The `Makefile` provides a set of commands to manage the project. Below is a simple
description of the available commands:

-   **build**: Build the Docker containers
-   **start**: Start the Docker containers
-   **container-list**: List all running containers
-   **connect**: Connect to the running container
-   **connect-app**: Connect to the PHP application container
-   **migrate**: Run database migrations
-   **clear-cache**: Clear the Symfony cache
-   **build-app**: Build the application (includes building frontend assets)
-   **migration**: Generate a new migration file
-   **make-entity**: Create a new Doctrine entity
-   **stop**: Stop all running containers

### Example Makefile

```
make build
make migrate
make connect app
make entity
```

## Domain Customization

To customize the domain for your Symfony application, follow these steps:

1. **Update the `.env.local` file**:

    Modify the `APP_URL` variable to reflect your custom domain.

    ```env
    APP_URL=http://your-custom-domain.com
    ```

2. **Configure Domain**:

    Update the `compose.override.yaml` file to listen to your custom domain.

    ```
    ...
    web:
        environment:
            - DOMAIN_NAME=your-custom-domain.com
    ...
    ```

3. **Update your hosts file**:

    Add an entry to your local `hosts` file to map the custom domain to your local
    Docker IP address.

    ```plaintext
    127.0.0.1 your-custom-domain.com
    ```

4. **Restart Docker containers**:

    After making these changes, restart your Docker containers to apply the new
    configuration.

    ```sh
    $ docker-compose down
    $ docker-compose up -d
    ```

By following these steps, your Symfony application should be accessible via your
custom domain.

## VSCode Setup

To enhance your development experience, the project includes a settings.json file
configured for Visual Studio Code. This file helps manage common settings and integrates
tools for better code quality and debugging. You can find or customize the settings
in .vscode/settings.json.

## Contributing

Contributions are welcome! Please open an issue or submit a pull request for any changes.

## Contact

For any questions or support, please contact [info@erdemdurdu.com].

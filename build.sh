#!/bin/sh

##
## Build the Symfony application, execute migrations and clear the cache in the Docker container
##


# Define the Docker container name
CONTAINER_NAME="app"

# Run migrations
docker-compose exec $CONTAINER_NAME bash -c "php bin/console doctrine:migrations:migrate --no-interaction"

# Build the Symfony application
docker-compose exec $CONTAINER_NAME bash -c "npm install && yarn install && yarn encore dev"

# Build Sass and JS files
docker-compose exec $CONTAINER_NAME bash -c "php bin/console sass:build"

# Clear the Symfony cache
docker-compose exec $CONTAINER_NAME bash -c "php bin/console cache:clear"

echo "Application has been successfully built and caches cleared within the Docker container: $CONTAINER_NAME"

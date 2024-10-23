# Variables
DOCKER_COMPOSE = docker-compose
APP_CONTAINER = app

# Build Docker images
build:
	$(DOCKER_COMPOSE) build

# Start Docker containers
start:
	$(DOCKER_COMPOSE) up -d

# Stop Docker containers
stop:
	$(DOCKER_COMPOSE) stop

# List Docker containers with detailed information
container-list:
	$(DOCKER_COMPOSE) ps --format "table {{.Names}}\t{{.Image}}\t{{.Service}}\t{{.Status}}\t{{.Ports}}"

# Connect to a specified container
connect:
	@if [ -z "$(filter-out $@,$(MAKECMDGOALS))" ]; then \
    	echo "Container name is required. Usage: make connect <container_name>"; \
	else \
		$(DOCKER_COMPOSE) exec $(filter-out $@,$(MAKECMDGOALS)) /bin/bash; \
	fi

# Connect to the app container
connect-app:
	$(DOCKER_COMPOSE) exec -it $(APP_CONTAINER) /bin/bash

# Run database migrations
migrate:
	$(DOCKER_COMPOSE) exec $(APP_CONTAINER) php bin/console doctrine:migrations:migrate --no-interaction

# Clear Symfony cache
clear-cache:
	$(DOCKER_COMPOSE) exec $(APP_CONTAINER) php bin/console cache:clear

# Execute build.sh script
build-app:
	./build.sh

# Generate a new Doctrine migration
migration:
	$(DOCKER_COMPOSE) exec $(APP_CONTAINER) php bin/console make:migration

# Generate a new Doctrine entity
entity:
	$(DOCKER_COMPOSE) exec $(APP_CONTAINER) php bin/console make:entity

.PHONY: build start container-list connect connect-app migrate clear-cache build-app migration make-entity stop

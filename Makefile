#!/bin/bash

OS := $(shell uname)
DOCKER_BE = webserver

help: ## Show this help message
	@echo 'usage: make [target]'
	@echo
	@echo 'targets:'
	@egrep '^(.+)\:\ ##\ (.+)' ${MAKEFILE_LIST} | column -t -c 2 -s ':#'

run: ## Start the containers
ifeq ($(OS),Linux)
	docker-compose -f docker-compose.linux.yml up -d
else
	docker-compose -f docker-compose.yml up -d
endif

stop: ## Stop the containers
ifeq ($(OS),Linux)
	docker-compose -f docker-compose.linux.yml stop
else
	docker-compose -f docker-compose.yml stop
endif

restart: ## Restart the containers
	$(MAKE) stop && $(MAKE) run

build: ## Rebuilds all the containers
ifeq ($(OS),Linux)
	docker-compose -f docker-compose.linux.yml build --compress --parallel
else
	docker-compose -f docker-compose.yml build
endif

prepare: ## Runs backend commands
	$(MAKE) composer-install

clean: ## Clean containers
	docker-compose down --rmi local --volumes --remove-orphans

# Backend commands

test: ## Execute test suite
	docker exec -it ${DOCKER_BE} ./vendor/bin/phpunit --configuration phpunit.xml

composer-install: ## Installs composer dependencies
	docker exec -it ${DOCKER_BE} composer install --no-scripts --no-interaction --optimize-autoloader


ssh-be: ## ssh's into the be container
	docker exec -it ${DOCKER_BE} bash

#code-style: ## Runs php-cs to fix code styling following Symfony rules
#	docker exec -it --user ${UID} ${DOCKER_BE} php-cs-fixer fix src --rules=@Symfony
#	docker exec -it --user ${UID} ${DOCKER_BE} php-cs-fixer fix tests --rules=@Symfony

#Esto lo necesitaremos luego despues para encriptar los JWT
#generate-ssh-keys: ## Generate ssh keys in the container
#	docker exec -it --user ${UID} ${DOCKER_BE} mkdir -p config/jwt
#	docker exec -it --user ${UID} ${DOCKER_BE} openssl genrsa -passout pass:sf5-expenses-api -out config/jwt/private.pem -aes256 4096
#	docker exec -it --user ${UID} ${DOCKER_BE} openssl rsa -pubout -passin pass:sf5-expenses-api -in config/jwt/private.pem -out config/jwt/public.pem

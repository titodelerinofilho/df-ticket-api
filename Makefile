DC = docker compose
PHP_SERVICE = df-ticket-php

.PHONY: init start down composer-install composer-update make-migration migrate

start:
	$(DC) up -d

down:
	$(DC) down

composer-install:
	$(DC) exec $(PHP_SERVICE) composer install

composer-update:
	$(DC) exec $(PHP_SERVICE) composer update

init:
	$(DC) up -d --build
	$(DC) exec $(PHP_SERVICE) composer install
	$(DC) exec $(PHP_SERVICE) php bin/console doctrine:migrations:migrate --no-interaction

make-migration:
	$(DC) exec $(PHP_SERVICE) php bin/console make:migration

migrate:
	$(DC) exec $(PHP_SERVICE) php bin/console doctrine:migrations:migrate --no-interaction

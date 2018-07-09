SHELL := /bin/bash

build:
	docker-compose rm -s -f
	@docker-compose build --no-cache

up:
	@docker-compose up -d --remove-orphans

install-requirements:
	@docker-compose exec simplecrud bash -c "composer install --no-dev"
	@docker-compose exec simplecrud bash -c "php /var/www/bin/cli-doctrine.php orm:schema-tool:create"

open-browser: 
	xdg-open http://localhost:8080

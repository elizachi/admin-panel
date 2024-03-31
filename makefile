start:
	docker compose up
	docker exec -t php-container /bin/sh
	php bin/console doctrine:database:create
	php bin/console doctrine:migrations:migrate

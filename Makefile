migrate:
	sudo docker exec php-fpm_test php artisan migrate

migrate-rollback:
	sudo docker exec php-fpm_test php artisan migrate:rollback

docker-build:
	sudo docker compose up -d --build

docker-run:
	sudo docker compose up -d

docker-stop:
	sudo docker compose stop

docker-down:
	sudo docker compose down

composer-install:
	sudo docker exec -it php-cli_test composer install

make-env:
	sudo docker exec -it php-cli_test cp .env.example .env




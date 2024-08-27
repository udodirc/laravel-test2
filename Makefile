install:
	cp .env.example .env
	docker compose up -d
	docker compose exec php composer i
	docker compose exec php php artisan key:generate
	docker compose exec php php artisan migrate

update:
	git pull
	docker compose exec php composer i
	docker compose exec php php artisan migrate

test:
	docker compose exec php php artisan migrate --env testing
	docker compose exec php php artisan test

stan:
	docker compose exec php composer static-analysis

pint:
	docker compose exec php ./vendor/bin/pint

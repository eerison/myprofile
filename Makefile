install:
	docker-compose up -d  --remove-orphans
	docker-compose exec php $(MAKE) init
	docker-compose run --rm client $(MAKE) yarn

init:
	composer install --prefer-dist --no-ansi --no-interaction --no-progress --optimize-autoloader
	bin/console doctrine:database:create  --if-not-exists
	bin/console doctrine:migrations:migrate --allow-no-migration --no-interaction

test:
	bin/phpunit

restart:
	docker-compose restart

build:
	sudo chmod 777 -R .docker/database
	docker-compose up -d --build

yarn:
	yarn
	yarn encore dev

watch:
	docker-compose run --rm client yarn encore dev --watch

deploy:
	docker run -e APP_ENV=prod eerison/myprofile make init
	docker build --tag web --target build --file ./.docker/dockerfiles/Dockerfile .
	docker tag web registry.heroku.com/mighty-eyrie-46636/web
	docker push registry.heroku.com/mighty-eyrie-46636/web
	heroku container:release web

install:
	composer install

lint:
	composer run-script phpcs -- --standard=PSR12 public routes app

lint-fix:
	composer run-script phpcbf -- --standard=PSR12 public routes app

test:
	composer run-script phpunit tests

run:
	php -S localhost:8000 -t public

logs:
	tail -f storage/logs/lumen.log

dumpautoload:
	composer dump-autoload --optimize

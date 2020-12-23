# update.axonivy.com

## Installation

Execute the following command in the root directory:

	docker-compose up -d

This will build a PHP container with Apache2 and the php dependency manager Composer.
You will also get a MariaDb container with and empty database.

Install composer dependencies

	docker-compose exec web composer install

## Test

To execute the test execute the following command:

	docker-compose exec web ./vendor/bin/phpunit

You also can run specific test suites:

	docker-compose exec web ./vendor/bin/phpunit --testsuite unit
	docker-compose exec web ./vendor/bin/phpunit --testsuite integration

## Deployment

* Create database and execute the sql scripts in the directory **sql** in order.
* The php application will be deployed automatically via Jenkins.
* You must provide a config file `/../../../../config/update.axonivy.com.php` similar to `src/config/config.php`
 
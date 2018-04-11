# update.axonivy.com

## Installation

Execute the following command in the root directory:

	docker-compose up

This will build a PHP container with Apache2 and the php dependency manager Composer.
You will also get a MySQL container with and empty database.

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
* Deploy the directory **src**, **vendor** to your server (attention when you override the config folder).
* Modify the configuration in the folder **config**.
* Point the webroot of your webserver to the **src/web** folder.
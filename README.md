# update.axonivy.com

## Installation

Execute the following command in the root directory:

	docker-compose up

This will build a PHP container with Apache2 and the php dependency manager Composer.
You will also get a MySQL container with and empty database.

Connect to the web container to install all dependencies of this php project:

	docker exec -i -t update-axonivy-com-web /bin/bash

And execute the following command in `/var/www/html`

	composer install

## Test

To execute the connect to the web container and execute the following command:

	./vendor/bin/phpunit

You also can run specific test suites:

	./vendor/bin/phpunit --testsuite unit
	./vendor/bin/phpunit --testsuite integration

## Deployment

* Create database and execute the sql scripts in the directory **sql** in order.
* Deploy the directory **src**, **vendor** to your server (attention when you override the config folder).
* Modify the configuration in the folder **config**.
* Point the webroot of your webserver to the **src/web** folder.
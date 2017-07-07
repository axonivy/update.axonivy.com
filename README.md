# update.axonivy.com

## Installation

* Execute `php composer.phar install` in root directory. 
* Create database and execute the sql scripts in the directory **sql** in order.
* Deploy the directory **src**, **vendor** to your server (attention when you override the config folder).
* Modify the configuration in the folder **config**.
* Point the webroot of your webserver to the **src/web** folder.

## Test

* To execute the test go to the root directory and run the command: `./vendor/bin/phpunit`. There are two type of tests, which you can run independently:
    * Unit-Test: `./vendor/bin/phpunit --testsuite unit`
    * Integration-Test (needs a running mysql server - look at the config in `IntegrationTestCase`): `./vendor/bin/phpunit --testsuite integration`

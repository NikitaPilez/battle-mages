## API Documentation generate
* ### Public config
    php artisan vendor:publish --tag=request-docs-config
* ### Static html generate
    php artisan lrd:generate
* ### Visit `/docs` route

## Supervisor install
* ### Install supervisor 
    `sudo apt-get install supervisor`
* ### Create conf file, example supervisor-example.conf in project dir
* ### Common commands
    `sudo supervisorctl update`
    `sudo supervisorctl start all`
    `sudo supervisorctl status all`

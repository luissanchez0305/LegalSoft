Installation

https://linoxide.com/how-to-install-laravel-on-ubuntu-20-04/

create
.env file

put key with 
`php artisan key:generate`
`php artisan config:cache`

set .env with db access and credentials
DB_CONNECTION=mysql
DB_HOST=34.210.255.79
DB_PORT=3306
DB_DATABASE=legalSoft
DB_USERNAME=legalsoft
DB_PASSWORD=O19AJsqeLz$0

then
`php artisan serve`
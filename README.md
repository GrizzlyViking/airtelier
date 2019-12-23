# Airtelier
AirBnB style workshops for artists

## Installation
You will need to setup something as a web server and a database. Please ask if you dont know how.

#### Backend
After you have downloaded the `git repository` locally for example ```git@github.com:GrizzlyViking/airtelier.git```

```
composer install
```
and then
```bash
npm install
```
#### Database
Install whatever database type you like, MySQL is probably the easiest to get to grips with. And then ...
```
php artisan migrate --seed
```

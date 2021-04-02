
# Skeleton: Laravel + WebpayPlus
Code example to add WebpayPlus to PHP with Laravel Framework
 
## Requirements:

- PHP: 7.2+
- [Laravel:](https://laravel.com/) `^8.*`
- [NodeJs:](https://www.npmjs.com/) `^15.*`

## Getting Started
  
### Composer

First step is install the composer dependencies for laravel:

```SH
$ composer install
```

### NPM

Install the javascript dependencies:

```SH
$ npm install && npm run dev
```

### DB Migrations

If the database is configured in the .env file, let's run this command to create the tables:

```SH
$ php artisan migrate
```

## Run Server
To start the server we must enter the following command:

```SH
$ php artisan serv
```
Now we must access the following url [http://127.0.0.1:8000/](http://127.0.0.1:8000/) to see the application test page.

![Main Test Page](https://github.com/angelmaturanat/laravel-webpay-skeleton/blob/main/Readme-image-1.png)


## Credits

- Github - Transbank SDK's documentation:[https://github.com/TransbankDevelopers](https://github.com/TransbankDevelopers)
- Official page - Transbank SDK's documentation: [https://www.transbankdevelopers.cl/documentacion/webpay-plus](https://www.transbankdevelopers.cl/documentacion/webpay-plus)
# Post Trends

A short description.


## Key Technologies:

- PHP - v7.3

- Laravel - v6.2

- Bootstrap - v4.0

- jQuery - v3.2

- Vue.js - v2.5

- MySQL - v5.7


## Development Environment Setup

1). [Laravel Homestead](https://laravel.com/docs/6.0/homestead)

2). LAMP Stack


### Prerequisites for LAMP(Linux/Apache/MySQL/PHP) stack

1). Install PHP 7.3 (reference: [installation in ubuntu](https://thishosting.rocks/install-php-on-ubuntu/))

2). Install php 7.3 extensions 

```php
$ sudo apt install php7.3 libapache2-mod-php7.3 php7.3-curl php7.3-mbstring php7.3-xmlrpc php7.3-soap php7.3-gd php7.3-xml php7.3-cli php7.3-zip
```

3). Install MySQL v5.7 (reference: [installation in ubuntu](https://www.digitalocean.com/community/tutorials/how-to-install-mysql-on-ubuntu-18-04))

4). Install Apache2 (reference: [installation in ubuntu](https://www.digitalocean.com/community/tutorials/how-to-install-the-apache-web-server-on-ubuntu-18-04))

5). Install Composer (reference: [installation in ubuntu](https://websiteforstudents.com/how-to-install-php-composer-on-ububuntu-16-04-17-10-18-04/))

```composer
$ curl -sS https://getcomposer.org/installer | sudo php -- --install-dir=/usr/local/bin --filename=composer
```

6). Download and install Node.js from [nodejs.org/en/download/](https://nodejs.org/en/download/)

7). Install the latest npm.

```npm
npm install --global npm@latest
```


### Application Setup in the LAMP stack Environment

In the case of LAMP usage...

In the /post-trends folder,

1). Create a .env file copying from .env.example.

2). Run `$ composer install` to install the necessary dependencies.

3). Run `$ yarn` to install yarn dependencies.

4). Run `$ npm run build` to compile all the assets(sass, js, media).

5). Run `$ php artisan key:generate` to generate a new key.

6). Run `$ php artisan config:cache` to reflect the .env configuration.


## Coding Style

- Use [PSR-1](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-1-basic-coding-standard.md) and [PSR-4](http://www.php-fig.org/psr/psr-4/) coding standards.

- PHP tab size is 4.

- Blade/HTML tab size is 2.

- CSS/SCSS/JavaScript tab size is 2.

- Translate tabs to spaces.

- Ensure newline at end of file.

- Trim trailing white space.

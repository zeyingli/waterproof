## Waterproof
#### Waterproof is an umbrella sharing mobile web application, in which it will provide clients a convenient way to rent umbrellas either on or off campus. Users will be able to rent or return umbrellas with using our application that incorporates with any authorized kiosk stations around campus.
[![StyleCI](https://github.styleci.io/repos/156929579/shield?branch=master)](https://github.styleci.io/repos/156929579)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/zeyingli/waterproof/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/zeyingli/waterproof/?branch=master)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)

#### Table of contents
- [Introduction](#introduction)
	- [Executive Summary](#executive-summary)
	- [Background](#background)
- [Features](#features)
- [Dependenies](#dependenies)
- [Installation Instructions](#installation-instructions)
    - [Build the Front End Assets with Mix](#build-front-end-assets-with-mix)
    - [Optionally Build Cache](#optionally-build-or-clear-cache)
- [Screenshots](#screenshots)
- [Waterproof License](#license)

### Introduction

#### Executive Summary
This final deliverable provides a technical overview and showcasing our implementation of our application Waterproof. This application will be modeled after the idea of Citi Bikes, but instead will be for umbrellas. Citi Bikes has changed the way of travel around big cities and college campuses, and docking stations with rentable umbrellas, integrated with a mobile app and easy to use kiosk could change campus and city life for students and commuters alike.

The purpose of this application is an umbrella sharing system, in which it will provide clients a convenient way to rent umbrellas either on or off campus. We will be promoting a shareable economy which is rising quickly in the United States and overseas. Soon, shareable economies will be throughout the United States, which allows us access to a currently untapped market to enhance and improve the lives of others by giving individuals and efficient and easy way to keep out of the rain. We also understand that this is a multi-purpose application and could embrace more fields.

#### Background
Our project attempts to integrate modern technologies to solve the urgent needs of unexpected circumstances such as rainy and windy days. By creating a “sharing-economy” system, we have the opportunity to improve living quality of campus life in a sustainable manner. At the moment, we do not know of any umbrella sharing systems in the United States, and our only North American competitor is UmbraCity, who currently only have locations in British Columbia, Canada. They have a similar model that we do, for instance they have implemented kiosks of rentable umbrellas scattered throughout some cities in British Columbia, Canada. Something that they have not integrated, however, is an application for this service. This is where we want to implement mobile technologies and make this shareable product easier to access.

The opportunities for this product in the United States are endless due to the fact that many applications that are similar to ours have yet to make a profound impact here in the United States. College campuses are the biggest opportunity for us because we have a great point of view of why this is needed, individually we have run into problems where we needed an umbrella and did not have one to use. If we assume most college students have experienced a similar issue, then this market is clearly full of untapped potential. The opportunity for us to implement this on college campuses is there for the taking and we plan on making the most efficient, easy to use, and affordable method for college students to not get caught in the pouring rain.

### Features
#### A [Laravel](http://laravel.com/) 5.7.x with minimal [Bootstrap](http://getbootstrap.com) 4.0.x project.

| Waterproof Features  |
| :------------ |
|User Registration and Activation|
|Marking Kiosk Stations on the map|
|Order History and Transaction Tracking|
|User Registration with email verification|
|User Password Reset via Email Token|
|Built on [Laravel](http://laravel.com/) 5.7|
|Built on [Bootstrap](https://getbootstrap.com/) 4|
|Uses [MySQL](https://github.com/mysql) Database|
|Uses [Artisan](http://laravel.com/docs/5.7/artisan) to manage database migration, schema creations, and create/publish page controller templates|
|Dependencies are managed with [COMPOSER](https://getcomposer.org/)|
|Laravel Scaffolding **User** and **Administrator Authentication**.|
|Make use of [Laravel-Admin](https://github.com/z-song/laravel-admin) Laravel-Admin|
|Make use of [Googlmapper](https://github.com/bradcornford/Googlmapper) Google Maps Helpers|
|[Google Maps API v3](https://developers.google.com/maps/documentation/javascript/) for User Location lookup and Geocoding|
|Make use of [Agent](https://github.com/jenssegers/agent) User Agents Detecter|

### Dependenies
```
OS: Debian-based Linux OS (x64), such as Debian 8 Jessie, Ubuntu 16.04 Xenial
Web: Apache HTTP 2.4 with rewrite and ssl module enabled.
Language: PHP 7.2+
Database: MySQL 5.7.13 InnoDB engine Collation utf8mb4
Library: git, curl3, php7.2, libapache2-mod-php7, php7.2-common, php7.2-fpm, php7.2-cli, php7.2-curl, php7.2-json, php7.2-readline, php7.2-fileinfo, php7.2-opache, php7.2-gd, php7.2-imagick, php7.2-mysql, php7.2-mcrypt, php7.2-mbstring, php7.2-intl, php7.2-xml, php7.2-pdo, php7.2-ctype, php7.2-zip, php7.2-pdo, and the latest version of OpenSSL PHP Extension.
```

### Installation Instructions
1. Run `git clone https://github.com/zeyingli/waterproof.git waterproof`
2. Create a MySQL database for the project
    * ```mysql -u root -p```, if using Vagrant: ```mysql -u homestead -psecret```
    * ```CREATE DATABASE waterproof CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;;```
    * ```\q```
3. From the projects root run `cp .env.example .env`
4. Configure your `.env` file
5. Run `composer update` from the projects root folder
6. From the projects root folder run `php artisan key:generate`
7. From the projects root folder run `php artisan migrate`
8. From the projects root folder run `composer dump-autoload`
9. Compile the front end assets with [npm steps](#using-npm) or [yarn steps](#using-yarn).

#### Build the Front End Assets with Mix
##### Using NPM:
1. From the projects root folder run `npm install`
2. From the projects root folder run `npm run dev` or `npm run production`
  * You can watch assets with `npm run watch`

##### Using Yarn:
1. From the projects root folder run `yarn install`
2. From the projects root folder run `yarn run dev` or `yarn run production`
  * You can watch assets with `yarn run watch`

#### Optionally Build or Clear Cache
1. From the projects root folder run `php artisan config:cache`
2. From the projects root folder run `php artisan config:clear`

### Screenshots
![Index](https://cdn.zeyingli.com/waterproof/images/project/index.png)
![Sign-In](https://cdn.zeyingli.com/waterproof/images/project/7.1.1.png)
![Sign-Up](https://cdn.zeyingli.com/waterproof/images/project/7.1.2.png)
![Activation](https://cdn.zeyingli.com/waterproof/images/project/7.2.1.png)
![Terms](https://cdn.zeyingli.com/waterproof/images/project/7.2.2.png)
![Menu](https://cdn.zeyingli.com/waterproof/images/project/menu.png)
![Account](https://cdn.zeyingli.com/waterproof/images/project/7.3.1.png)
![Rewards Program](https://cdn.zeyingli.com/waterproof/images/project/7.3.2.png)
![Add Balance](https://cdn.zeyingli.com/waterproof/images/project/7.4.1.png)
![Order History](https://cdn.zeyingli.com/waterproof/images/project/7.4.2.png)
![Forgot Password](https://cdn.zeyingli.com/waterproof/images/project/7.4.3.png)
![Reset Password](https://cdn.zeyingli.com/waterproof/images/project/7.4.4.png)
![Kiosks Map](https://cdn.zeyingli.com/waterproof/images/project/7.5.1.png)
![Pickup Kiosks List](https://cdn.zeyingli.com/waterproof/images/project/7.5.2.png)
![Pickup Kiosk Details](https://cdn.zeyingli.com/waterproof/images/project/7.5.3.png)
![Counting Timer](https://cdn.zeyingli.com/waterproof/images/project/7.5.4.png)
![Order History In Progress](https://cdn.zeyingli.com/waterproof/images/project/7.5.5.png)
![Dropoff Kiosks List](https://cdn.zeyingli.com/waterproof/images/project/7.6.1.png)
![Dropoff Kiosk Details](https://cdn.zeyingli.com/waterproof/images/project/7.6.2.png)
![Dropoff Charged](https://cdn.zeyingli.com/waterproof/images/project/7.6.3.png)
![Order History Completed](https://cdn.zeyingli.com/waterproof/images/project/7.6.4.png)
![Dropoff Insufficient Fund](https://cdn.zeyingli.com/waterproof/images/project/7.7.1.png)
![Pay Overdue Insufficient Fund](https://cdn.zeyingli.com/waterproof/images/project/7.7.2.png)
![Unable Rent Overdue Order](https://cdn.zeyingli.com/waterproof/images/project/7.7.3.png)
![Pay Overdue Order](https://cdn.zeyingli.com/waterproof/images/project/7.7.4.png)
![Overdue Order Paid Off](https://cdn.zeyingli.com/waterproof/images/project/7.7.5.png)
![Help Center](https://cdn.zeyingli.com/waterproof/images/project/7.8.1.png)
![Detailed Terms](https://cdn.zeyingli.com/waterproof/images/project/7.8.2.png)

### License
Waterproof is licensed under the [MIT license](https://opensource.org/licenses/MIT).



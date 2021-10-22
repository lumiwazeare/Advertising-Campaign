<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Project Dependencies

The project is develop with
- Vue 3 (Front-End).
- [Laravel V8](https://laravel.com/docs/container).
-  [Bootstrap 5]


## Running the project on docker

Docker and Docker-compose are both required to run the project

### How to run it

- Pull project folder from github and change to the project root directory
- Open terminal and execute the following in order:
- docker-compose up -d
- docker ps 
- find the container id for 'adcampaign' and execute
- docker exec 'containerID' php artisan migrate

Then visit http://127.0.0.1:8000 or http://localhost:8000 in your browser.

#### Note: This project is only tested in chrome browser

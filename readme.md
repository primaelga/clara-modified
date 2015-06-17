## Clara
Clara is generic PostgreSQL to REST API application. Clara is built on top of Lumen PHP Framework. 

### Basic Concept
each CRUD has its own request:

- Create: Using POST request with url http://[HOST]/api/service/[TABLE NAME]/[PRIMARY KEY FIELD], and the data in body
- Retrieve: Using GET request with url http://[HOST]/api/service/[TABLE NAME]
- Update: Using PUT request with url http://[HOST]/api/service/[TABLE NAME]/[PRIMARY KEY FIELD], and the data in body
- Delete: Using DELETE request with url http://[HOST]/api/service/[TABLE NAME]/[PRIMARY KEY FIELD], and the data in body

### Lumen PHP Framework
[![Build Status](https://travis-ci.org/laravel/lumen-framework.svg)](https://travis-ci.org/laravel/lumen-framework)
[![Total Downloads](https://poser.pugx.org/laravel/lumen-framework/d/total.svg)](https://packagist.org/packages/laravel/lumen-framework)
[![Latest Stable Version](https://poser.pugx.org/laravel/lumen-framework/v/stable.svg)](https://packagist.org/packages/laravel/lumen-framework)
[![Latest Unstable Version](https://poser.pugx.org/laravel/lumen-framework/v/unstable.svg)](https://packagist.org/packages/laravel/lumen-framework)
[![License](https://poser.pugx.org/laravel/lumen-framework/license.svg)](https://packagist.org/packages/laravel/lumen-framework)

Laravel Lumen is a stunningly fast PHP micro-framework for building web applications with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Lumen attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as routing, database abstraction, queueing, and caching.

#### Official Documentation

Documentation for the framework can be found on the [Lumen website](http://lumen.laravel.com/docs).

#### Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell at taylor@laravel.com. All security vulnerabilities will be promptly addressed.

#### License

The Lumen framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)



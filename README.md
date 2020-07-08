# Laravel 5 REST API client for a Backdrop cms site with the headless module

[![Latest Version on Packagist](https://img.shields.io/packagist/v/robertgarrigos/backdrop-headless-client.svg?include_prereleases)](https://packagist.org/packages/robertgarrigos/backdrop-headless-client)
[![Build Status](https://img.shields.io/travis/robertgarrigos/backdrop-headless-client/master.svg)](https://travis-ci.org/robertgarrigos/backdrop-headless-client)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/robertgarrigos/backdrop-headless-client/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/robertgarrigos/backdrop-headless-client/?branch=master)
[![Total Downloads](https://img.shields.io/packagist/dt/robertgarrigos/backdrop-headless-client.svg)](https://packagist.org/packages/robertgarrigos/backdrop-headless-client)

This is a laravel package which allows you to pull data from a backdrop cms site, configured with the headles module. Thus you can use the backdrop site as a backend and laravel as front end.

## Compatibility
v. 1.* of this package is compatible with Laravel 5.8

v. 2.* of this package is compatible with Laravel 7.*

## Installation

You can install the package via composer:

```bash
composer require robertgarrigos/backdrop-headless-client
```
Optionally, you can use `artisan vendor:publish --tag=backdrop-config` to publish a config file.

You need to add a config value in your .env file for the backdrop api url as:

```
BACKDROP_API_SERVER="https://example.com"
```

## Usage

To make use of this package, you need to install and config a [backdrop cms](https://github.com/backdrop/backdrop) site with the [headless module](https://github.com/backdrop-contrib/headless), which is reponsible to create the JSON end points.

You acces those endpoints in your controller with:

```php
/* Nodes (v2): /api/v2/node/{type}/{id} */

$node = Backdrop::getNode($type, $id);

/* Terms: /api/{vocabulary}/term/{id} */

$term = Backdrop::getTerm($vocabulary, $id);

/* Views (v2): /api/v2/views/{view_name}/{display_id}/{contextual_arguments}{filter_arguments} */

$view = Backdrop::getView($view, $display_id, $args);

/* Paragraphs (v3): /api/v3/paragraphs/{id} */

$paragraph = Backdrop::getParagraph($id);
```

Read my [blog post](https://garrigos.cat/blog/how-to-set-a-backdrop-cms-as-backend-and-a-laravel-as-frontend) about this package for a deeper understanding of how it works and how to use it.

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email robert@garrigos.cat instead of using the issue tracker.

## Credits

- [Robert Garrigos](https://github.com/robertgarrigos)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).

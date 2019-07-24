# Laravel 5 REST API client for a backdrop cms site with the headless module

**This package is still in a heavy development process**

[![Latest Version on Packagist](https://img.shields.io/packagist/v/robertgarrigos/backdrop-headless-client.svg?style=flat-square)](https://packagist.org/packages/robertgarrigos/backdrop-headless-client)
[![Build Status](https://img.shields.io/travis/robertgarrigos/backdrop-headless-client/master.svg?style=flat-square)](https://travis-ci.org/robertgarrigos/backdrop-headless-client)
[![Quality Score](https://img.shields.io/scrutinizer/g/robertgarrigos/backdrop-headless-client.svg?style=flat-square)](https://scrutinizer-ci.com/g/robertgarrigos/backdrop-headless-client)
[![Total Downloads](https://img.shields.io/packagist/dt/robertgarrigos/backdrop-headless-client.svg?style=flat-square)](https://packagist.org/packages/robertgarrigos/backdrop-headless-client)

This is where your description should go. Try and limit it to a paragraph or two, and maybe throw in a mention of what PSRs you support to avoid any confusion with users and contributors.

## Installation

You can install the package via composer:

```bash
composer require robertgarrigos/backdrop-headless-client
```
Optionally, you can use `artisan vendor publish` to publish a config file.

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

/* Views (v2): /api/v2/views/{view_name}/{display_id}{arguments} */

$view = Backdrop::getView($view, $display_id, $args);
```

// TODO: better description of the usage. Plannig to write a blog post about it.

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

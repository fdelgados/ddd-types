# DDD Types

[![Build Status](https://travis-ci.org/fdelgados/ddd-types.svg?branch=master)](https://travis-ci.org/fdelgados/ddd-types)
[![Packagist](https://img.shields.io/packagist/v/fdelgados/ddd-types.svg)](https://github.com/fdelgados/ddd-types/releases)

Wrapper PHP types and Value Objects

### Prerequisites
You need PHP 7.1 or later and Composer to use this collection

### Installing
To install DDD Types, run the following command:
```
$ composer require fdelgados/ddd-types
```

### Utilities provided
* Type validatiors
* Base Collection class
* Common Value Objects

## Usage

First, you must import the class you are going to use:
```php
use function CiscoDelgado\Types\ValueObject\IdentifierUuid;
```

Then use it:
```php
$userId = new IdentifierUuid();
```

## Authors
* **Cisco Delgado** - *Initial work* - [fdelgados](https://github.com/fdelgados)

## License
This project is licensed under the [MIT License](https://opensource.org/licenses/MIT).

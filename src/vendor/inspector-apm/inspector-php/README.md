# Inspector | Real-Time monitoring

[![Build Status](https://travis-ci.org/inspector-apm/inspector-php.svg?branch=master)](https://travis-ci.org/inspector-apm/inspector-php)
[![Latest Stable Version](https://poser.pugx.org/inspector-apm/inspector-php/v/stable)](https://packagist.org/packages/inspector-apm/inspector-php)

Inspector is a composer package to add Real-Time monitoring in your PHP applications.

## Requirements

- PHP >= 7.2.0

## Install
Install the latest version by:

```shell
composer require inspector-apm/inspector-php
```

## Use

To start sending data to Inspector you need an API key to create a configuration instance. You can obtain `INSPECTOR_API_KEY` creating a new project in your [Inspector](https://www.inspector.dev) dashboard.

```php
use Inspector\Inspector;
use Inspector\Configuration;

$configuration = new Configuration('YOUR_API_KEY');
$inspector = new Inspector($configuration);
```

All start with a `transaction`. Transaction represent an execution cycle and it can contains one or hundred of segments:

```php
// Start an execution cycle with a transaction
$inspector->startTransaction($_SERVER['PATH_INFO']);
```

Use `addSegment` method to monitor a code block in your transaction:

```php
$result = $inspector->addSegment(function ($segment) {
    // Do something here...
	return true;
}, 'my-process');

echo $result; // this will print "Hello World!"
```

Inspector will collect information to produce performance chart in your dashboard.

**[See official documentation](https://docs.inspector.dev)**

## LICENSE

This package is licensed under the [MIT](LICENSE) license.

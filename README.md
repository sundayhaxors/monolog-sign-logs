# Monolog Sign Logs

[![Build Status](https://img.shields.io/travis/com/sundayhaxors/monolog-sign-logs/master.svg?style=for-the-badge&logo=travis)](https://travis-ci.com/sundayhaxors/monolog-sign-logs) [![PHP Version](https://img.shields.io/packagist/php-v/sundayhaxors/monolog-sign-logs.svg?style=for-the-badge)](https://github.com/sundayhaxors/monolog-sign-logs) [![Stable Version](https://img.shields.io/packagist/v/sundayhaxors/monolog-sign-logs.svg?style=for-the-badge&label=latest)](https://packagist.org/packages/sundayhaxors/monolog-sign-logs)

Monolog processor that will cryptographically sign all the log messages for you.

## Installation

```
$ composer require sundayhaxors/monolog-sign-logs
```

## Usage

```php
<?php

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use SundayHaxors\Monolog\SignLogs\Processor\SignLogsProcessor;

$log = new Logger('logger');
$log->pushHandler(new StreamHandler('path/to/log', Logger::WARNING));

$processor = new SignLogsProcessor('YOUR-SECRET-KEY','Hashing Algorithm');
$log->pushProcessor($processor);

$log->log(Logger::DEBUG, 'This is a log message');
```

For the available Hashing Algorithms in your PHP Installation, please check the output of the function `hash_algos();`

In case you use several Processors in your Stack, take care that the SignLogsProcessor is running last.

## License

Package is licensed under the LGPL License - see the LICENSE file for details

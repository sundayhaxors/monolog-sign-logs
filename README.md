# Monolog Sign Logs

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

$processor = new SignLogsProcessor('YOUR-SECRET-KEY');
$log->pushProcessor($processor);

$log->log(Logger::DEBUG, 'This is a log message');
```
## License

Package is licensed under the LGPL License - see the LICENSE file for details

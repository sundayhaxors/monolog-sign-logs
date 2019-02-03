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

$processor = new SignLogsProcessor('YOUR-SECRET-KEY','Hashing Algorithm');
$log->pushProcessor($processor);

$log->log(Logger::DEBUG, 'This is a log message');
```

For the available Hashing Algorithms in your PHP Installation, please check the output of the function `hash_algos();`

In case you use several Processors in your Stack, take care that the SignLogsProcessor is running last.

## License

Package is licensed under the LGPL License - see the LICENSE file for details

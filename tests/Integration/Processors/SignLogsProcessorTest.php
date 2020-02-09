<?php

declare(strict_types=1);

namespace SundayHaxors\Monolog\SignLogs\Tests\Integration\Processors;

use Monolog\Logger;
use Monolog\Handler\TestHandler;
use PHPUnit\Framework\TestCase;
use SundayHaxors\Monolog\SignLogs\Processor\SignLogsProcessor;

/**
 * @covers SundayHaxors\Monolog\SignLogs\Processor\SignLogsProcessor
 */
class SignLogsProcessorTest extends TestCase
{
    public function testSigning(): void
    {
        $log = new Logger('logger');
        $handler = new TestHandler(
            Logger::DEBUG
        );
        $log->pushHandler($handler);

        $algo = 'md5';
        $secret = 'SECRET';

        $processor = new SignLogsProcessor(
            $secret,
            $algo
        );
        $log->pushProcessor($processor);

        $log->log(
            Logger::DEBUG,
            'This is a log message'
        );

        foreach ($handler->getRecords() as $record) {
            $signature = $record['extra']['signature'];
            unset($record['extra']['signature']);
            unset($record['formatted']);
            $serialized_record = \serialize($record);
            $checksum = hash($algo, $secret.':'.$serialized_record, false);
            $this->assertEquals($signature, $checksum);
        }
    }
}

<?php

declare(strict_types = 1);

namespace SundayHaxors\Monolog\SignLogs\Tests\Unit\Processors;

use PHPUnit\Framework\TestCase;
use SundayHaxors\Monolog\SignLogs\Processor\SignLogsProcessor;

/**
 * @covers SundayHaxors\Monolog\SignLogs\Processor\SignLogsProcessor
 */
class SignLogsProcessorTest extends TestCase
{
    use \Spatie\Snapshots\MatchesSnapshots;

    public function testThrowsExceptionOnEmptyKeyAndAlgo(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        new SignLogsProcessor('', '');
    }

    public function testThrowsExceptionOnEmptyKeyAndInvalidAlgo(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        new SignLogsProcessor('key', 'invalidAlgo');
    }

    public function testThrowsExceptionOnEmptyAlgo(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        new SignLogsProcessor('foobar', '');
    }

    public function testThrowsExceptionOnEmptyKeyButValidAlgo(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        new SignLogsProcessor('', 'md5');
    }

    public function testSigning(): void
    {
        $record = [
            'message' => '',
            'level' => 200,
            'level_name' => 'INFO',
            'channel' => 'app',
            'datetime' => new \DateTimeImmutable('2018-06-11 18:39:26'),
            'context' => [],
            'extra' => []
        ];
        $signProcessor = new SignLogsProcessor('key', 'md5');
        $signedRecord = $signProcessor($record);
        $this->assertArrayHasKey('signature', $signedRecord['extra']);
        $this->assertMatchesSnapshot($signedRecord);

        $record = [
            'message' => '',
            'level' => 200,
            'level_name' => 'INFO',
            'channel' => 'app',
            'datetime' => new \DateTimeImmutable('2018-06-11 18:39:26'),
            'context' => [],
            'extra' => []
        ];
        $signProcessor = new SignLogsProcessor('key', 'sha256');
        $signedRecord = $signProcessor($record);
        $this->assertArrayHasKey('signature', $signedRecord['extra']);
        $this->assertMatchesSnapshot($signedRecord);
    }
}

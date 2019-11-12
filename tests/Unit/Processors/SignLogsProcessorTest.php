<?php
declare(strict_types = 1);

namespace SundayHaxors\Monolog\SignLogs\Tests\Unit\Processors;

use PHPUnit\Framework\TestCase;
use SundayHaxors\Monolog\SignLogs\Processor\SignLogsProcessor;

class SignLogsProcessorTest extends TestCase
{
    use \Spatie\Snapshots\MatchesSnapshots;

    /**
     * @covers SundayHaxors\Monolog\SignLogs\Processor\SignLogsProcessor::__construct
     */
    public function testThrowsExceptionOnEmptyKeyAndAlgo()
    {
        $this->expectException(\InvalidArgumentException::class);
        new SignLogsProcessor('', '');
    }

    /**
     * @covers SundayHaxors\Monolog\SignLogs\Processor\SignLogsProcessor::__construct
     */
    public function testThrowsExceptionOnEmptyKeyAndInvalidAlgo()
    {
        $this->expectException(\InvalidArgumentException::class);
        new SignLogsProcessor('key', 'invalidAlgo');
    }

    /**
     * @covers SundayHaxors\Monolog\SignLogs\Processor\SignLogsProcessor::__construct
     */
    public function testThrowsExceptionOnEmptyAlgo()
    {
        $this->expectException(\InvalidArgumentException::class);
        new SignLogsProcessor('foobar', '');
    }

    /**
     * @covers SundayHaxors\Monolog\SignLogs\Processor\SignLogsProcessor::__construct
     */
    public function testThrowsExceptionOnEmptyKeyButValidAlgo()
    {
        $this->expectException(\InvalidArgumentException::class);
        new SignLogsProcessor('', 'md5');
    }

    /**
     * @covers SundayHaxors\Monolog\SignLogs\Processor\SignLogsProcessor::__construct
     * @covers SundayHaxors\Monolog\SignLogs\Processor\SignLogsProcessor::__invoke
     */
    public function testSigning()
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

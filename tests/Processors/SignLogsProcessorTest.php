<?php
declare(strict_types = 1);

use PHPUnit\Framework\TestCase;
use SundayHaxors\Monolog\SignLogs\Processor\SignLogsProcessor;

class SignLogsProcessorTest extends TestCase
{

    /**
     * @covers SundayHaxors\Monolog\SignLogs\Processor\SignLogsProcessor::__construct
     * @expectedException \InvalidArgumentException
     */
    public function testThrowsExceptionOnEmptyKeyAndAlgo()
    {
        new SignLogsProcessor('', '');
    }

    /**
     * @covers SundayHaxors\Monolog\SignLogs\Processor\SignLogsProcessor::__construct
     * @expectedException \InvalidArgumentException
     */
    public function testThrowsExceptionOnEmptyKeyAndInvalidAlgo()
    {
        new SignLogsProcessor('', 'invalidAlgo');
    }

    /**
     * @covers SundayHaxors\Monolog\SignLogs\Processor\SignLogsProcessor::__construct
     * @expectedException \InvalidArgumentException
     */
    public function testThrowsExceptionOnEmptyAlgo()
    {
        new SignLogsProcessor('foobar', '');
    }

    /**
     * @covers SundayHaxors\Monolog\SignLogs\Processor\SignLogsProcessor::__construct
     * @expectedException \InvalidArgumentException
     */
    public function testThrowsExceptionOnEmptyKeyButValidAlgo()
    {
        new SignLogsProcessor('', 'md5');
    }

    /**
     * @covers SundayHaxors\Monolog\SignLogs\Processor\SignLogsProcessor::__construct
     * @covers SundayHaxors\Monolog\SignLogs\Processor\SignLogsProcessor::__invoke
     */
    public function testSigning() {
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
    }

}

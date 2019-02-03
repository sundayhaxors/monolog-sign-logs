<?php
declare(strict_types = 1);

use PHPUnit\Framework\TestCase;
use SundayHaxors\Monolog\SignLogs\Processor\SignLogsProcessor;

class SignLogsProcessorTest extends TestCase
{

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testThrowsExceptionOnEmptyKeyAndAlgo()
    {
        new SignLogsProcessor('', '');
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testThrowsExceptionOnEmptyKeyAndInvalidAlgo()
    {
        new SignLogsProcessor('', 'invalidAlgo');
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testThrowsExceptionOnEmptyAlgo()
    {
        new SignLogsProcessor('foobar', '');
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testThrowsExceptionOnEmptyKeyButValidAlgo()
    {
        new SignLogsProcessor('', 'md5');
    }

}

<?php
declare(strict_types = 1);

use PHPUnit\Framework\TestCase;
use SundayHaxors\Monolog\SignLogs\Processor\SignLogsProcessor;

class SignLogsProcessorTest extends TestCase
{

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testThrowsExceptionOnInvalidCall()
    {
        new SignLogsProcessor('', '');
        new SignLogsProcessor('', 'none');
        new SignLogsProcessor('foobar', '');
    }


}

<?php
declare(strict_types = 1);

use PHPUnit\Framework\TestCase;
use SundayHaxors\Monolog\SignLogs\Processor\SignLogsProcessor;

class SignLogsProcessorTest extends TestCase
{

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testThrowsExceptionOnEmptyKey()
    {
        new SignLogsProcessor('');
    }


}

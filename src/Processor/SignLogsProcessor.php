<?php
/**
 * Created by PhpStorm.
 * User: frank
 * Date: 2019-02-03
 * Time: 21:20
 */

namespace Sundayhaxors\Monolog\SignLogs\Processor;


class SignLogsProcessor
{
    
    /*
     *
     * $record = [
  'message' => '',
  'level' => 200,
  'level_name' => 'INFO',
  'channel' => 'app',
  'datetime' => DateTime::__set_state([
     'date' => '2018-06-11 18:39:26.353995',
     'timezone_type' => 3,
     'timezone' => 'UTC',
  ]),
  'context' => [],
  'extra' => []
    add
]
     */
    
    /**
     * @var string Preshared Key
     */
    protected $key;
    
    /**
     * @param string $key
     */
    public function __construct(string $key) {
    
    }
    
    public function __invoke(array $record): array {
    
    }
    
    
    
    
}

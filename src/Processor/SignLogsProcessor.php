<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: frank
 * Date: 2019-02-03
 * Time: 21:20
 */

namespace SundayHaxors\Monolog\SignLogs\Processor;

use Monolog\Processor\ProcessorInterface;

/**
 * Class SignLogsProcessor
 *
 * @package SundayHaxors\Monolog\SignLogs\Processor
 */
class SignLogsProcessor implements ProcessorInterface
{
    
    /**
     * @var string Preshared Key
     */
    protected $key;
    
    /**
     * @var string selected Algorithm
     */
    protected $algorithm;
    
    /**
     * SignLogsProcessor constructor.
     *
     * @param string $key
     * @throws \InvalidArgumentException
     */
    public function __construct(string $key, string $algorithm)
    {
        if (empty($key)) {
            throw new \InvalidArgumentException('Add a key');
        }
        if (empty($algorithm)) {
            throw new \InvalidArgumentException('Define an Algorithm');
        }
        $supported_algorithm = \hash_algos();
        if (!in_array($algorithm, $supported_algorithm)) {
            throw new \InvalidArgumentException('Algorithm not supported by your PHP Installation. See hash_algos()');
        }
        $this->key = $key;
        $this->algorithm = $algorithm;
    }
    
    /**
     * @param array $record
     * @return array
     */
    public function __invoke(array $record): array
    {
        $cleanedRecord = $record;
        $cleanedRecord['level'] = $cleanedRecord['level_name'];
        unset($cleanedRecord['level_name']);
        $cleanedRecord['datetime'] = $cleanedRecord['datetime']->getTimestamp();
        \arsort($cleanedRecord);
        
        $serialized_record = \serialize($cleanedRecord);
        
        
        print_r($cleanedRecord);
        var_dump($serialized_record);
        var_dump($this->key);
        $checksum = hash($this->algorithm, $this->key.':'.$serialized_record, false);
        var_dump($checksum);
        $record['extra']['signature'] = $this->algorithm.':'.$checksum;
        unset($checksum);
        unset($serialized_record);
        return $record;
    }
}

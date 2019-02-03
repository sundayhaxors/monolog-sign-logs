<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: frank
 * Date: 2019-02-03
 * Time: 21:20
 */

namespace Sundayhaxors\Monolog\SignLogs\Processor;

use Monolog\Processor\ProcessorInterface;

class SignLogsProcessor implements ProcessorInterface
{
    
    /**
     * @var string Preshared Key
     */
    protected $key;
    
    /**
     * @var
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
            throw new \InvalidArgumentException('Algorithm not supported by your PHP Installation. See output of function hash_algos()');
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
        $serialized_record = \serialize($record);
        $checksum = hash($this->algorithm, $this->key.':'.$serialized_record, false);
        $record['extra']['signature'] = $checksum;
        unset($checksum);
        unset($serialized_record);
        return $record;
    }
}

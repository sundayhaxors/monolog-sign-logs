<?php
declare(strict_types=1);

namespace SundayHaxors\Monolog\SignLogs\Service;


use Dubture\Monolog\Parser\LineLogParser;
use SundayHaxors\Monolog\SignLogs\Processor\SignLogsProcessor;

//TODO Interface

class CheckIntegrityService
{
    /**
     * @param string $key
     * @param string $logline
     * @return bool
     */
    public static function checkLogLine (string $key, string $logline) : bool
    {
        
        $logParser = new LineLogParser();
        $parsedLogline = $logParser->parse($logline);
        
        
        // clean up
        $parsedLogline['channel'] = $parsedLogline['logger'];
        $parsedLogline['datetime'] = $parsedLogline['date'];
        $parsedLogline['datetime'] = $parsedLogline['datetime']->getTimestamp();
        unset($parsedLogline['logger']);
        unset($parsedLogline['date']);
        
        \arsort($parsedLogline);
        
        //$signature = $parsedLogline['extra']['signature'];
        [$algorithm,$signature] = explode(':',$parsedLogline['extra']['signature']);
        var_dump([$algorithm,$signature]);
        
        // remove the extra data
        unset($parsedLogline['extra']['signature']);
        
        // parse logline
        $record = [];
        //$algorithm = '';
        //$checksum = '';
        //$serialized_record = \serialize($record);
    
        print_r($parsedLogline);
        \var_dump(serialize($parsedLogline));
        $ret =  hash($algorithm, $key.':'.\serialize($parsedLogline));
        // initriate processor
        
        echo $ret,"\n";
        return \hash_equals($signature, $ret);
    }
}

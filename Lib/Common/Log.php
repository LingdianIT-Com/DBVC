<?php

namespace Lib\Common;

use Psr\Log\LoggerInterface as PsrLoggerInterface;

class Log implements PsrLoggerInterface
{

    protected $monolog;
    private static $ins;
    
    
    public static function getIns()
    {
       if (empty(self::$ins)) {
           self::$ins = new self();
       }
       return self::$ins;
    }

    private function __construct()
    {
        $this->monolog = new \Monolog\Logger("default");
        $logname = "logs/app.log";
        $this->monolog->pushHandler(new \Monolog\Handler\RotatingFileHandler($logname, 5));
        return $this;
    }

    public function alert($message, array $context = array())
    {
        return $this->writeLog(__FUNCTION__, $message, $context);
    }

    public function critical($message, array $context = array())
    {
        return $this->writeLog(__FUNCTION__, $message, $context);
    }

    public function debug($message, array $context = array())
    {
        return $this->writeLog(__FUNCTION__, $message, $context);
    }

    public function emergency($message, array $context = array())
    {
        return $this->writeLog(__FUNCTION__, $message, $context);
    }

    public function error($message, array $context = array())
    {
        array_push($this->errorlog, $message);
        return $this->writeLog(__FUNCTION__, $message, $context);
    }

    public function info($message, array $context = array())
    {
        return $this->writeLog(__FUNCTION__, $message, $context);
    }

    public function notice($message, array $context = array())
    {
        return $this->writeLog(__FUNCTION__, $message, $context);
    }

    public function warning($message, array $context = array())
    {
        return $this->writeLog(__FUNCTION__, $message, $context);
    }

    public function log($level, $message, array $context = array())
    {
        return $this->writeLog($level, $message, $context);
    }

    private function writeLog($level, $message, $context)
    {
        if (!empty($context) && is_array($context)) {
            $this->monolog->{$level}($message, $context);
        } else {
            $this->monolog->{$level}($message);
        }
    }


}

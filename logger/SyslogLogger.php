<?php
namespace Logger;

use Logger\LogLevel;

/**
 * Class SyslogRoute
 */
class SyslogLogger extends Route
{
   
    public function __construct(array $attributes = [])
    {
       parent::__construct($attributes);  
       $this->template = "{message}"; 
    }
   
    /**
     * Логирование в syslog 
     *
     * @param mixed $level
     * @param string $message
     * @return void
     */
    
    public function log($level, $message)
    {        
       syslog(LOG_DEBUG, trim(strtr($this->template, [
            '{message}' => $message,
        ])));
    }
    
}
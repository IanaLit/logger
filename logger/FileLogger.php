<?php

namespace Logger;

use Logger\LogLevel;

/**
 * Class FileLogger
 */
class FileLogger extends Route
{

   
	public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->filename = $attributes['filename'];
    }
   
   /**
     * Запись логов в файл
     *
     * @param mixed $level
     * @param string $message
     *
     * @return void
     */

	public function log($level, $message)
    {
        if ($this->is_enabled)
        {
             file_put_contents($this->filename, trim(strtr($this->template, [
            '{date}' => $this->getDate(),
            '{level_code}' => $this->setLoggerCode($level),
            '{level}' => $level,
            '{message}' => $message,
        ])) . PHP_EOL, FILE_APPEND);

       }
    }
    /**
     *
     * @param string $message
     *
     * @return void
     */

    public function info ($message)     
    {
        $this->log(LogLevel::LEVEL_INFO, $message);
    } 

}
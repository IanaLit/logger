<?php

namespace Logger;

use Logger\Logger;
use Logger\LogLevel;

date_default_timezone_set('UTC');

/**
 * Class Route
 */

abstract class Route 
{
	protected $is_enabled = false;
	protected $template = "{date} {level_code} {level} {message}";
    public $levels;

    public function __construct(array $attributes = [])
    {
        $this->is_enabled = $attributes['is_enabled'];
        if(isset($attributes['levels']))
        {
              $this->levels = $attributes['levels'][0];
        }
        $this->setLoggerCode($this->levels);
    }
    /**
     * Текущая дата
     *
     * @return string
    */
    protected function getDate()
    {
        return date("c");
    }

    /**
    * Установка кода уровня логирования
    *
    * @param mixed $levels
    *
    * @return string
    */

    protected function setLoggerCode($levels)
    {
        if (isset ($levels))
        {
            $map = [
                '001'=> 'ERROR' ,
                '004'=>'NOTICE' ,
                '002'=> 'INFO',
                '003' =>'DEBUG',
            ];
                
            return array_search($levels, $map);
        }
        else return 000;
    }
        
    /**
    * Включение логгера
    *
    * @param bool
    *
    * @return string
    */

    public function setIsEnabled ($is_enabled)
    {    
        $this->is_enabled = $is_enabled;        
    }
    
     /**
     * Запись логов в файл
     *
     * @param mixed $level
     * @param string $message
     *
     * @return void
     */

	abstract public function log($level, $message);

}



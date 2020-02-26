<?php

namespace Logger;

use Logger\LogLevel;
use FileLogger;

/**
 * Class Logger
 */
class Logger {

    private $routes;
    
    /**
     * Массив логгеров
     */

    public function __construct()
    {
        $this->routes = array(
            'all' =>[],
            'error' => [], 
            'info' =>[], 
            'debug' =>[],
            'fake' =>[],
        );
    }

     /**
     * Маршрутизация логгеров 
     *
     * @param mixed $level
     * @param string $message
     *
     * @return void
     */
    public function log($level, $message)
    { 
      $this->routes['all']->log($level, $message);
      switch ($level) {
          case LogLevel::LEVEL_ERROR:
              $this->routes['error']->log($level, $message);
          break;
          case LogLevel::LEVEL_INFO:
              $this->routes['info']->log($level, $message);
          break;
          case LogLevel::LEVEL_DEBUG:
              $this->routes['debug']->log($level, $message);
          break; 
      }  
    }
     /**
     *
     * @param string $message
     * @return void
    */

    public function error($message)
    { 
        $this->log(LogLevel::LEVEL_ERROR, $message);
    }

     /**
     * @param string $message
     * @return void
     */

    public function info ($message)
      
    {
        $this->log(LogLevel::LEVEL_INFO, $message);
    } 

     /**
     * @param string $message
     * @return void
     */
    public function notice($message)
    {
      $this->log(LogLevel::LEVEL_NOTICE, $message);
    }

     /**
     * @param string $message
     * @return void
     */
    public function debug($message)
    {
       $this->log(LogLevel::LEVEL_DEBUG, $message);
    } 
      
     /**
     * Добавление логгеров в массив в соответсвии с уровнем логирования
     *
     * @param  mixed $routeLogger
     * @return void
     */

    public function addLogger($routLogger){
 
        if ( $routLogger->levels == LogLevel::LEVEL_ERROR) 
        {
            $this->routes['error'] = $routLogger;
        } 
        else if ( $routLogger->levels == LogLevel::LEVEL_INFO) 
        {
            $this->routes['info'] = $routLogger;
        } 
        else if ($routLogger->levels == LogLevel::LEVEL_DEBUG)
         {
            $this->routes['debug'] = $routLogger;
        } 
        else if (!(isset($routLogger->levels)) || ($routLogger->levels == LogLevel::LEVEL_NOTICE)) 
        {
        $this->routes['all'] = $routLogger;
        } 
        else if ($routLogger->levels =='NULL')
        {
          $this->routes['fake'] = $routLogger;
        }
    }
}

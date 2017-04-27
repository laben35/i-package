<?php

namespace Lib\MVC;

abstract class AbstractSubject
{
    
    protected 
    /**
     * 
     *@var ObserverInterface observer
     */
    $observer;
    
    protected function __construct()
    {
        $this->observer = [];
    }
    
    /**
     * Register observer
     * add an observer for notification
     *
     * @param ObserverInterface $observer observer
     */
    public function register(ObserverInterface $observer) 
    {
        
        $this->observer[] = $observer;
    }
    
    /**
     * unregister observer
     * remove an observer of notifications
     *
     * @param ObserverInterface $observer observer
     */
    public function unregister(ObserverInterface $observer)
    {
      $key =  array_search($observer, $this->observer);
      if (is_int($key)) {
          unset($this->observer[$key]);
      }
      
      var_dump($key);
        
    }
    /**
     * Notify observer
     * update observer collection
     */
    
    public function notify()
    {
        foreach ($this->observer as $observer) {
            $observer->update($this);
        }
        
    }
    
}   
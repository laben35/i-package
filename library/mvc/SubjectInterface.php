<?php

namespace Lib\MVC;

interface SubjectInterface
{
    /**
     * Register observer
     * add an observer for notification
     * 
     * @param ObserverInterface $observer observer
     */
   public function register(ObserverInterface $observer) ;
   
   /**
    * unregister observer
    * remove an observer of notifications
    * 
    * @param ObserverInterface $observer observer
    */
   public function unregister(ObserverInterface $observer);
   
   /**
    * Notify observer
    * update observer collection
    */
   
   public function notify();
    
}
<?php

namespace Lib\MVC;

interface ObserverInterface
{
    /**
     * Update
     * update on subject notifications
     * 
     * @param subjectInterface $subject
     */
    
   public function update(subjectInterface $subject); 
   
    
}
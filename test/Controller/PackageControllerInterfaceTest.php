<?php


namespace FindCode\Test\Controller;

use FindCode\Api\Controller\PackageControllerInterface;
use \PHPUnit\Framework\TestCase;




abstract class PackageControllerInterfaceTest extends TestCase
{   

    /**
     * 
     * get PackageControllerInterface
     */
    abstract public function getPackageControllerInterface(
        ): PackageControllerInterface;
    
        /**
         * testMethod
         */
    public function testMethod()
    {       
        $this->assertTrue(
            method_exists(
               $this->getPackageControllerInterface(),
               "execute"
          )
        );     
    }
    /**
     * 
     *  testInstanceofPackageControllerInterface
     */
    public function testInstanceofPackageControllerInterface ()
    {
        $this->assertTrue(
            $this->getPackageControllerInterface() 
            instanceof 
            PackageControllerInterface
            );
    }
    
/**
 * 
 *  @runInSeparateProcess
 *
 */
public function testExecute ()
{
   
    $mock = $this->getPackageControllerInterface();
    $output = $mock->execute();
    $this->assertTrue(
         is_string($output)
        );
 }
 
}
<?php

namespace  FindCode\Test\View;
use FindCode\Api\View\ViewInterface;
use stdClass;
use Lib\MVC\AbstractSubject;
use Lib\MVC\SubjectInterface;
use ReflectionClass;

abstract class ViewInterfaceTest extends \PHPUnit\Framework\TestCase
{
    
     abstract public function getViewInterface(): ViewInterface;
    
    /**
     * 
     *testHello
     */
    public function testInstanceofViewInterafce ()
    {
      $mock = $this->getViewInterface();
      $this->assertTrue(
          $this->getViewInterface() instanceof ViewInterface 
          );  
    }
    
    public function testMethods ()
    {
        $mock = $this->getViewInterface();
        $this->assertTrue(
             method_exists($mock,"render") 
            && method_exists($mock,"update") 
            );
    }
    /**
     *  @expectedException TypeError
     * 
     */
    public function testTypeError()
    {
        $this->getViewInterface()
        ->update("Dummy");
    }
    
    public function testRenderJsonOnly()
    {
        $mock = $this->getViewInterface();
        $this->assertTrue(
            is_string($mock->render())
            && json_decode($mock->render()) instanceof stdClass
            
        );

    }
    public function testUpdate ()
    {
        $subjectMock = (new  ReflectionClass(DummyTest::class))
                      ->newInstance([]);
        $mock = $this->getViewInterface();
        $mock->update($subjectMock);
        $obj = json_decode($mock->render());
        $this->assertTrue(
              property_exists($obj, "foo")
         && $obj->foo === "foo"
        );
    }
}

class DummyTest extends AbstractSubject implements SubjectInterface
{
    public $foo = "foo";
    public function __construct ()
    {
        parent::__construct();
    }
   
}
    
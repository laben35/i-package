<?php


namespace FindCode\Test\Model;

use FindCode\Api\Model\PackageModelInterface;
use Lib\MVC\SubjectInterface;



abstract class PackageModelInterfaceTest extends \PHPUnit\Framework\TestCase
{   

    /**
     * 
     * @return PackageModelInterface
     */
    abstract public function getPackageModelInterface(): PackageModelInterface;
    /**
     *@dataProvider attributesProvider
     */
    public function testAttribut($attribut)
    {
        $mock = $this->getPackageModelInterface();
        $this->assertTrue(
            property_exists($mock, $attribut)
        );
    }
    
    /**
     * attributesProvider
     */
    public final function attributesProvider()
    {
        return [
            ["testable"],
            ["distribuable"],
            ["type"],
            ["name"],
            ["langage"],
            ["package"],
            ["description"],
            ["keywords"],
            ["homepage"],
            ["dependencies"],
            ["devDependencies"],
            ["versions"],
            ["license"],
            ["author"]
            
        ];
    }
    /**
     * 
     * @dataProvider methodsProvider
     */
    public function testMethod($method)
    {
        $mock = $this->getPackageModelInterface();
        $this->assertTrue(
            method_exists($mock, $method)
        );
    }
    
    
    /**
     * testInstanceofSubjectInterafce
     * 
     */
    public function testInstanceofSubjectInterafce ()
    {
            $this->assertTrue(
            $this->getPackageModelInterface() instanceof SubjectInterface
            );  
    }
    /**
     * testInstanceofPackageModelInterface
     */
    public function testInstanceofPackageModelInterface ()
    {
           $this->assertTrue(
           $this->getPackageModelInterface() instanceof PackageModelInterface
            );
    }
    /**
     * @expectedException RuntimeException
     */
    public function testRuntimeException ()
    {
        $this->getPackageModelInterface()->get ();
    }
    /**
     * methodsProvider
     */
    public final function methodsProvider()
    {
        return [
            ["get"],
            ["setAttribute"],
            
        ];
    }
}
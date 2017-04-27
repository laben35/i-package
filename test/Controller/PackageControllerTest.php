<?php

namespace FindCode\Test\Controller;

use  FindCode\Api\Controller\PackageController;
use FindCode\Api\Controller\PackageControllerInterface;
use ReflectionClass;
use FindCode\Api\Model\PackageModel;
use FindCode\Api\View\PackageView;


class PackageControllerTest extends PackageControllerInterfaceTest
{
    public function getPackageControllerInterface(): PackageControllerInterface
    {
        return (new ReflectionClass(PackageController::class))
        ->newInstanceArgs([
     
            (new ReflectionClass(PackageModel::class))
            ->newInstanceArgs([]),
           ( new ReflectionClass(PackageView::class))
            ->newInstanceArgs([])
              
        ]);
       
    }
    
}

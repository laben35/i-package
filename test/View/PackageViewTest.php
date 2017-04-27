<?php

namespace FindCode\Test\View;

use FindCode\Api\View\ViewInterface;
use FindCode\Api\View\PackageView;
use ReflectionClass;

class PackageViewTest extends ViewInterfaceTest
{
    
    public function getViewInterface(): ViewInterface
    
    {
//         return new PackageView:: class;
//         on cherche l'�quivalant de �a mais en mode bonne pratique
   
        
//       reflective class
        return (new \ReflectionClass(PackageView:: class))
                ->newInstanceArgs([]);

    }
     
    
    
}

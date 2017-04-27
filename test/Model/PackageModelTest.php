<?php

namespace FindCode\Test\Model;

use  FindCode\Api\Model\PackageModel;
use FindCode\Api\Model\PackageModelInterface;
use ReflectionClass;


class PackageModelTest extends PackageModelInterfaceTest
{
    public function getPackageModelInterface(): PackageModelInterface
    {
        return (new ReflectionClass(PackageModel::class))->newInstanceArgs([]);
    }
    
}

<?php

use FindCode\Api\Controller\PackageController;

use FindCode\Api\View\PackageView;
use FindCode\Api\Model\PackageModel;


require "../vendor/autoload.php";

$controller = new PackageController(
      new PackageModel(),
      new PackageView());

header("Content-Type: application/json; charset=utf8");

echo $controller->execute();

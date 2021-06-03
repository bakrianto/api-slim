<?php

require '../vendor/autoload.php';

//$app = new \Slim\App;
$app = new \Slim\App(['settings' => ['displayErrorDetails' => true]]);

require '../src/autoload.php';

$app->run();

?>

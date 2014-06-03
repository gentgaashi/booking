<?php

require 'bootstrap.php';

use App\App;


$app = new App(array(
	"debug" => true,
	'templates.path' => __DIR__.'/src/templates'
));

$app->run();
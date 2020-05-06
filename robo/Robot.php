<?php

require __DIR__.'/vendor/autoload.php';

use App\Command\CleanCommand;
use Symfony\Component\Console\Application;

$app = new Application();

$app->add(new CleanCommand());
$app->run();

<?php

require __DIR__.'/vendor/autoload.php';

use Symfony\Component\Console\Application;
use App\Commands\ScoreboardGeneratorCommand;

$application = new Application();
$application->add(new ScoreboardGeneratorCommand());
$application->run();

<?php
require_once dirname(__DIR__, 1) . '/vendor/autoload.php';

use \Doctrine\ORM\Tools\Console\ConsoleRunner;
use \App\Database\config\EntityManagerBuilder;

return ConsoleRunner::createHelperSet(EntityManagerBuilder::build());
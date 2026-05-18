<?php
require  "config.php";


use Nemundo\Project\Install\ProjectInstall;

require  "config.php";

$reset = new \Nemundo\Project\Reset\ProjectReset();

(new ProjectInstall())->install();


$reset->remove();


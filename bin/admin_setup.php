<?php

require 'config.php';

if ((new \Nemundo\Core\File\File(\Nemundo\Project\ProjectConfig::$projectPath . 'config.ini'))->fileExists()) {
    (new \Nemundo\Dev\Install\AdminPackageInstall())->install();
    (new \Nemundo\App\ModelDesigner\Application\ModelDesignerApplication())->installApp();
} else {
    (new \Nemundo\Core\Debug\Debug())->write('config.ini does not exists');
}




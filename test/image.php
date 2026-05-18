<?php

require __DIR__ . '/../config.php';

$imageGeneration = new \LuzernTourismus\Llm\Core\ImageGeneration();
$imageGeneration->prompt = 'haus mit drei bäumen';
$imageGeneration->filename = (new \Nemundo\Project\Path\TmpPath())->addPath('img.png')->getFullFilename();
$imageGeneration->generateImage();

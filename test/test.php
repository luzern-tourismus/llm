<?php

require __DIR__ . '/../config.php';


(new \LuzernTourismus\LlmTest\ImageGenerationTest())->runTest();



/*$loop = new \Nemundo\Core\Structure\ForLoop();
$loop->minNumber = 1;
$loop->maxNumber = 30;
foreach ($loop->getData() as $number) {

    $imageGeneration = new \LuzernTourismus\Llm\Core\ImageGeneration();
    $imageGeneration->prompt = 'Kreiere ein Logo für das "LTAG Minigolf Turnier". Mach eine lustige Person die Minigolf spielt.';
    $imageGeneration->filename = (new \Nemundo\Project\Path\TmpPath())->addPath('minigolf7_'.$number.'.png')->getFullFilename();
    $imageGeneration->generateImage();

}*/

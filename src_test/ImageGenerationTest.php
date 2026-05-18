<?php

namespace LuzernTourismus\LlmTest;

use Nemundo\Test\AbstractTest;

class ImageGenerationTest extends AbstractTest
{


    public function runTest()
    {

        $imageGeneration = new \LuzernTourismus\Llm\Core\ImageGeneration();
        $imageGeneration->prompt = $this->getValue('test_promt');
        $imageGeneration->filename = (new \Nemundo\Project\Path\TmpPath())->addPath('img.png')->getFullFilename();
        $imageGeneration->generateImage();



    }

}
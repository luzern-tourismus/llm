<?php

namespace LuzernTourismus\Llm\Core;

use LuzernTourismus\Llm\Config\LlmConfig;
use Nemundo\Core\Base\AbstractBase;
use Nemundo\Core\Debug\Debug;
use Nemundo\Core\Json\JsonText;
use Nemundo\Core\Json\Reader\JsonReader;
use Nemundo\Core\TextFile\Writer\TextFileWriter;
use Nemundo\Core\WebRequest\BearerAuthentication\JsonBearerAuthenticationWebRequest;
use Nemundo\Project\Path\TmpPath;

class ImageGeneration extends AbstractBase
{

    public $prompt;

    public $filename;


    public function generateImage()
    {

        $url = 'https://api.openai.com/v1/images/generations';

        $data = [];
        $data['model'] = 'gpt-image-1.5';
        $data['prompt'] = $this->prompt;
        $data['quality'] = 'low';


        /*size, quality, and background support the auto option, where the model will automatically select the best option based on the prompt.

    Size and quality options

Square images with standard quality are the fastest to generate. The default size is 1024x1024 pixels.

    Available sizes
1024x1024 (square) - 1536x1024 (landscape) - 1024x1536 (portrait) - auto (default)
Quality options	- low - medium - high - auto (default)*/


        $json = (new JsonText())->addData($data)->getJson();

        $request = new JsonBearerAuthenticationWebRequest();
        $request->bearerAuthentication = (new LlmConfig())->getApiKey();
        $response = $request->postUrl($url, $json);


        if (LlmConfig::$debugMode) {
            $filename = (new TmpPath())->addPath('response.json')->getFullFilename();

            $writer = new TextFileWriter($filename);
            $writer->addLine($response->html);
            $writer->writeFile();
        }


        $reader = new JsonReader();
        $reader->fromText($response->html);
        $data = $reader->getData();

        if (isset($data['data'])) {
            $img = base64_decode($data['data'][0]['b64_json']);

            $writer = new TextFileWriter($this->filename);
            //$writer->overwriteExistingFile=true;
            $writer->addLine($img);
            $writer->writeFile();

        } else {

            (new Debug())->write($response);

        }

    }

}
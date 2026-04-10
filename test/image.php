<?php

require __DIR__ . '/../config.php';

//(new \Nemundo\Project\Path\TmpPath())->createPath()->emptyDirectory();

$loop = new \Nemundo\Core\Structure\ForLoop();
$loop->minNumber = 1;
$loop->maxNumber = 10;
foreach ($loop->getData() as $number) {

    $imageGeneration = new \LuzernTourismus\Llm\Core\ImageGeneration();
    $imageGeneration->prompt = 'blick schlagzeile skandal in luzern: mitarbeiter von luzern tourismus bauen eine luxus küche in ihren büro. erfinde noch ein paar dinge. und mache eine zeichnung wie die küche aussieht';
    $imageGeneration->filename = (new \Nemundo\Project\Path\TmpPath())->addPath('img_'.$number.'.png')->getFullFilename();
    $imageGeneration->generateImage();

}


/*
curl -X POST "https://api.openai.com/v1/images/generations" \
    -H "Authorization: Bearer $OPENAI_API_KEY" \
    -H "Content-type: application/json" \
    -d '{
        "model": "gpt-image-1.5",
        "prompt": "A childrens book drawing of a veterinarian using a stethoscope to listen to the heartbeat of a baby otter."
    }' | jq -r '.data[0].b64_json' | base64 --decode > otter.png

*/


/*$request = new \LuzernTourismus\Llm\Core\RequestLlm();
$request->endpoint = 'https://api.openai.com/v1/images/generations';
$request->model = 'gpt-image-1.5';
//$request->systemPrompt = 'ein blaues quadrat';
$request->userPrompt = 'ein blaues quadrat';

//(new \Nemundo\Core\Debug\Debug())->write($request->userPrompt);

$response = $request->getResponse();*/

/*
$url = 'https://api.openai.com/v1/images/generations';

$data = [];
$data['model'] = 'gpt-image-1.5';
$data['prompt'] = 'ein blaues quadrat';

$json = (new JsonText())->addData($data)->getJson();

//(new Debug())->write($json);

//(new Debug())->write((new \LuzernTourismus\Llm\Config\LlmConfig())->getApiKey());

$request = new JsonBearerAuthenticationWebRequest();
$request->bearerAuthentication = (new \LuzernTourismus\Llm\Config\LlmConfig())->getApiKey(); // $this->token;
$response = $request->postUrl($url, $json);


$filename = (new \Nemundo\Project\Path\TmpPath())->addPath('response.json')->getFullFilename();

$writer = new \Nemundo\Core\TextFile\Writer\TextFileWriter($filename);
$writer->addLine($response->html);
$writer->writeFile();



$reader = new JsonReader();
$reader->fromText($response->html);
$data = $reader->getData();

(new \Nemundo\Core\Debug\Debug())->write($data);

$img =base64_decode($data['data'][0]['b64_json']);

$filename = (new \Nemundo\Project\Path\TmpPath())->addPath('img.png')->getFullFilename();

$writer = new \Nemundo\Core\TextFile\Writer\TextFileWriter($filename);
$writer->addLine($img);
$writer->writeFile();

(new \Nemundo\Core\Debug\Debug())->write($response);
*/
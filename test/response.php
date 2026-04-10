<?php

require __DIR__ . '/../config.php';





$request = new \LuzernTourismus\Llm\Core\AbstractRequestLlm();
$request->endpoint = 'https://api.openai.com/v1/responses';
$request->model = 'gpt-5.4';
$request->systemPrompt = (new \Nemundo\Core\TextFile\Reader\TextFileReader(__DIR__.'/prompt/system.txt'))->getText();  //'Du gibst die Telefon Nr. zurück';
$request->userPrompt = (new \Nemundo\Core\TextFile\Reader\TextFileReader(__DIR__.'/prompt/user.txt'))->getText();  // 'weshalb 42';

//(new \Nemundo\Core\Debug\Debug())->write($request->userPrompt);

$response = $request->getResponse();

(new \Nemundo\Core\Debug\Debug())->write($response->message);


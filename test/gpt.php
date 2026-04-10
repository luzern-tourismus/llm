<?php

require __DIR__ . '/../config.php';

$request = new \LuzernTourismus\Llm\Core\Gpt5Request();
$request->systemPrompt = '';
$request->userPrompt = '';

$response = $request->getResponse();
(new \Nemundo\Core\Debug\Debug())->write($response->message);


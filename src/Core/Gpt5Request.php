<?php

namespace LuzernTourismus\Llm\Core;

class Gpt5Request extends AbstractRequestLlm
{

    public $userPrompt;


    public $systemPrompt;

    public function __construct()
    {

        $this->endpoint = 'https://api.openai.com/v1/responses';
        $this->model = 'gpt-5.4';

    }

}
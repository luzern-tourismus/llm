<?php

namespace LuzernTourismus\Llm\Core;

use Nemundo\Core\Base\AbstractBase;
use Nemundo\Core\Json\JsonText;
use Nemundo\Core\Json\Reader\JsonReader;
use Nemundo\Core\WebRequest\BearerAuthentication\JsonBearerAuthenticationWebRequest;

abstract class AbstractRequestLlm extends AbstractBase
{

    protected $endpoint;

    //protected $token;

    protected $userPrompt;


    protected $systemPrompt;


    protected $model;

    /**
     * @var LlmFunction[]
     */
    protected $toolList = [];

    public function addFunction(LlmFunction $function)
    {

        $this->toolList[] = $function;
        return $this;

    }


    public function getResponse()
    {

        $data = [];
        $data['model'] = $this->model;

        foreach ($this->toolList as $tool) {
            $data['tools'][] = $tool->getData();
        }

        //$data['input'] = $this->userPrompt;


        if ($this->systemPrompt !== null) {
            $content = [];
            $content['content'] = $this->systemPrompt;
            $content['role'] = 'developer';
            $data['input'][] = $content;
        }

        $content = [];
        $content['content'] = $this->userPrompt;
        $content['role'] = 'user';
        $data['input'][] = $content;

        $json = (new JsonText())->addData($data)->getJson();

        //(new Debug())->write($json);

        //(new Debug())->write((new \LuzernTourismus\Llm\Config\LlmConfig())->getApiKey());

        $request = new JsonBearerAuthenticationWebRequest();
        $request->bearerAuthentication = (new \LuzernTourismus\Llm\Config\LlmConfig())->getApiKey(); // $this->token;
        $response = $request->postUrl($this->endpoint, $json);

        $reader = new JsonReader();
        $reader->fromText($response->html);
        $data = $reader->getData();

        //(new \Nemundo\Core\Debug\Debug())->write($data);


        $message = null;
        $functionCall = [];

        $outputList = $data['output'];
        foreach ($outputList as $output) {

            $type = $output['type'];

            if ($type === 'message') {
                foreach ($output['content'] as $content) {
                    $message = $content['text'];
                }

            }


            if ($type === 'function_call') {

                $functionCall[] = $output['name'] . ' ' . $output['arguments'];

            }

            //(new \Nemundo\Core\Debug\Debug())->write($output);

        }


        $response = new ResponseLlm();
        $response->message = $message;
        $response->functionList = $functionCall;

        return $response;


    }

}
<?php

namespace LuzernTourismus\Llm\Core;

use Nemundo\Core\Base\AbstractBase;
use Nemundo\Core\Base\DataSource\AbstractDataSource;
use Nemundo\Core\Debug\Debug;
use Nemundo\Core\Json\Reader\JsonReader;
use Nemundo\Core\WebRequest\BearerAuthentication\JsonBearerAuthenticationWebRequest;

class RestReader extends AbstractBase
{

    public function getData($endpoint)
    {

        $url = 'https://api.openai.com/v1/' . $endpoint;

        $request = new JsonBearerAuthenticationWebRequest();
        $request->bearerAuthentication = (new \LuzernTourismus\Llm\Config\LlmConfig())->getApiKey(); // $this->token;
        $response = $request->getUrl($url);

        //(new Debug())->write($response);

        $reader = new JsonReader();
        $reader->fromText($response->html);
        $data = $reader->getData();



        // [id] => gpt-3.5-turbo-16k


        return $data;

    }

}
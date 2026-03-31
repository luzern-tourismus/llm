<?php

namespace LuzernTourismus\Llm\Config;

use Nemundo\Core\Base\AbstractBase;
use Nemundo\Project\Config\ProjectConfigReader;

class LlmConfig extends AbstractBase
{

    public static $apiToken;

    public function getApiKey()
    {

        if (LlmConfig::$apiToken == null) {
            LlmConfig::$apiToken = (new ProjectConfigReader())->getValue('openai_key');
        }

        return LlmConfig::$apiToken;

    }



}
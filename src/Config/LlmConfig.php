<?php

namespace LuzernTourismus\Llm\Config;

use Nemundo\Core\Base\AbstractBase;
use Nemundo\Core\Check\ValueCheck;
use Nemundo\Core\Debug\Debug;
use Nemundo\Project\Config\ProjectConfigReader;

class LlmConfig extends AbstractBase
{

    public static $apiToken;

    /**
     * @var bool
     */
    public static $debugMode = false;

    public function getApiKey()
    {

        if (LlmConfig::$apiToken == null) {
            LlmConfig::$apiToken = (new ProjectConfigReader())->getValue('openai_key');
        }

        if (!(new ValueCheck())->hasValue(LlmConfig::$apiToken)) {
            (new Debug())->write('No Llm API token');
            exit;
        }

        return LlmConfig::$apiToken;

    }

}
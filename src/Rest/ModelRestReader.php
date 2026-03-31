<?php

namespace LuzernTourismus\Llm\Rest;

use LuzernTourismus\Llm\Core\RestReader;
use Nemundo\Core\Base\DataSource\AbstractDataSource;
use Nemundo\Core\Debug\Debug;

class ModelRestReader extends AbstractDataSource
{

    protected function loadData()
    {

        //https://api.openai.com/v1/models

        $data = (new RestReader())->getData('models');

        foreach ($data['data'] as $model) {
            $this->addItem($model['id']);
        }

        (new Debug())->write($data);



    }

}
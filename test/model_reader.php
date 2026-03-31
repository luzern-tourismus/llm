<?php

require __DIR__ . '/../config.php';


$reader = new \LuzernTourismus\Llm\Rest\ModelRestReader();
foreach ($reader->getData() as $model) {
    (new \Nemundo\Core\Debug\Debug())->write($model);
}
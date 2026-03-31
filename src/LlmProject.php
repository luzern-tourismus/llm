<?php

namespace LuzernTourismus\Llm;

use Nemundo\Project\AbstractProject;
use Nemundo\Core\Path\Path;

class LlmProject extends AbstractProject
{
    public function loadProject()
    {
        $this->project = 'Llm';
        $this->projectName = 'llm';
        $this->path = __DIR__;
        $this->namespace = __NAMESPACE__;
        $this->modelPath = (new Path())
            ->addPath(__DIR__)
            ->addParentPath()
            ->addPath('model')
            ->getPath();
    }
}
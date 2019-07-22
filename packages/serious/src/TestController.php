<?php

namespace Serious\Controllers;

class TestController extends MainController
{
    public function render()
    {
        $this->data['test'] = 'test';
        $this->modx->addDataToView($this->data);
    }
}
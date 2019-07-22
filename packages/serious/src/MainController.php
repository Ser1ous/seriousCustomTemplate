<?php

namespace Serious\Controllers;

class MainController
{
    public $data = [];
    public $modx = '';

    public function __construct()
    {
        $this->modx = EvolutionCMS();
        $this->data['main'] = 'main';
    }


}
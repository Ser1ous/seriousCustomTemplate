<?php

namespace Serious\Controllers;

class TestController extends BaseController
{
    public function render()  //Пример для вывода данных
    {
        $this->data['test'] = 'test';
    }
}
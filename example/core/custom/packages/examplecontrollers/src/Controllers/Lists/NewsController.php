<?php
//Контроллер для шаблона с alias lists.news
namespace EvolutionCMS\Example\Controllers\Lists;

use EvolutionCMS\Example\Controllers\BaseController;

class NewsController extends BaseController
{
    public function render()  //Пример для вывода данных
    {
        $this->data['test'] = 'test';
    }

}
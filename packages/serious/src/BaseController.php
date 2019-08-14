<?php

namespace Serious\Controllers;

class BaseController
{
    public $data = [];
    public $evo = '';
    public $cache = false; //переключатель с кэшем или без кэша
    public $sphinx;

    public function __construct()
    {
        $this->evo = EvolutionCMS();
        $cacheid = md5(json_encode($_GET)); //беру весь $_GET и из него генерирую id для кеша
        if ($this->cache) {
            $this->data = Cache::remember($cacheid, 1440, function () {
                $this->ourelements();
                $this->render();
                return $this->data;
            });
        } else {
            $this->ourelements();
            $this->render();
        }
        $this->noCacheRender();

        $this->sendToView();
    }

    public function render()
    {
        //В случае если нам нужен только base. Всё что надо помещаем в массив $this->data
    }

    public function noCacheRender()
    {
        //Не кешируемая генерация информации. Всё что надо помещаем в массив $this->data
    }

    public function ourelements()
    {
       //Место под общие данные всех элементов
    }

    public function sendToView() //отправляем на вывод
    {
        $this->evo->addDataToView($this->data);
    }
}

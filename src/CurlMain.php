<?php
namespace sorokinmedia\curl;

use yii\base\Component;

/**
 * Class CurlMain
 * @package sorokinmedia\curl
 */
class CurlMain extends Component
{
    /** @var array конфиги сервисов */
    public $services;
    private $_loadedServices;

    /**
     * Инициализация центра.
     * Загрузка всех сервисов
     */
    public function init()
    {
        foreach ($this->services as $name => $params) {
            $class = $params['class'];
            $this->_loadedServices[$name] = new $class();
            foreach ($params as $param_name => $param_value){
                if ($param_name != 'class'){
                    $this->_loadedServices[$name]->$param_name = $param_value;
                }
            }
        }
        parent::init();
    }
}
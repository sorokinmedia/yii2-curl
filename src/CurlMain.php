<?php
namespace sorokinmedia\curl;

use yii\base\Component;

/**
 * Class CurlMain
 * @package sorokinmedia\curl
 *
 * @property array $services
 */
abstract class CurlMain extends Component
{
    public $services;

    private $_loadedServices;

    /**
     * Инициализация центра.
     * Загрузка всех сервисов
     */
    public function init()
    {
        $this->setLoadedServices();
        parent::init();
    }

    /**
     * подтягивает данные из конфига
     */
    public function setLoadedServices()
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
        $this->setServices();
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function getService(string $name)
    {
        return $this->_loadedServices[$name];
    }

    /**
     * инициализация сервисов
     * @return mixed
     */
    abstract public function setServices();

    /**
     * @return ServiceInterface[]
     */
    public function getLoadedServices()
    {
        return $this->_loadedServices;
    }
}
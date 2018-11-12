<?php
namespace sorokinmedia\curl;

use yii\web\IdentityInterface;
use yii\base\Component;

/**
 * Class BaseService
 * @package sorokinmedia\curl
 */
class BaseService extends Component implements ServiceInterface
{
    const TYPE_GET = 'get';
    const TYPE_POST = 'post';
    const TYPE_PUT = 'put';

    /**
     * Получение типа аутентификации
     * @return string
     */
    public function getAuthType(){}

    /**
     * Получение токена авторизации
     * @param IdentityInterface $user
     * @param bool $admin
     * @return string|boolean
     */
    public function getAuthToken(IdentityInterface $user = null, bool $admin = false){}

    /**
     * Установка урла обращения
     * @param string $url
     * @param string $type
     * @param array $fields
     * @param IdentityInterface $user
     * @return string|boolean
     */
    public function setUrl($url, $type = self::TYPE_GET, $fields = null, IdentityInterface $user = null){}

    /**
     * Установка типа запроса
     * @param integer $type
     * @param $ch
     * @return mixed
     */
    public function setRequestType($type, $ch){
        switch ($type):
            case self::TYPE_POST:
                curl_setopt($ch, CURLOPT_POST, true);
                return true; // задаем тип запроса POST
            case self::TYPE_PUT:
                curl_setopt($ch, CURLOPT_PUT, true);
                return true; // задаем тип запроса PUT
            default: return true;
        endswitch;
    }

    /**
     * строит строку запроса
     * @param $fields
     * @return string
     */
    public function prepareFields($fields)
    {
        return http_build_query($fields);
    }

    /**
     * Установка массива параметров
     * @param $fields
     * @param $ch
     * @return mixed
     */
    public function setPostFields($fields, $ch){
        if (!is_null($fields)){
            $field_string = $this->prepareFields($fields); // строим строку запроса
            curl_setopt($ch, CURLOPT_POSTFIELDS, $field_string); // заносим данные в запрос
        }
        return true;
    }

    /**
     * Установка Headers
     * @param $ch
     * @param IdentityInterface $user
     * @param bool $admin
     * @return boolean
     */
    public function setHeaders($ch, IdentityInterface $user = null, bool $admin = false){}

    /**
     * Инициализация curl
     * @param $url
     * @return resource
     */
    public function initCurl($url)
    {
        $ch = curl_init($url); // задаем URL для запроса
        return $ch;
    }

    /**
     * настройка ответа
     * @param $ch
     * @param int $status
     * @return boolean
     */
    public function setTransfer($ch, $status = 1)
    {
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, $status); // возвращаем или нет ответ
        return true;
    }

    /**
     * Запуск запроса
     * @param $ch
     * @return mixed
     */
    public function execCurl($ch)
    {
        return curl_exec($ch); // делаем запрос
    }

    /**
     * Возвращает последнюю ошибку текущего сеанса
     * @param $ch
     * @return string
     */
    public function getError($ch)
    {
        return curl_error($ch);
    }

    /**
     * Декодирует ответ
     * @param $response
     * @return mixed
     */
    public function decodeResponse($response)
    {
        return json_decode('[' . $response . ']');
    }

    /**
     * закрывает текущий сеанс
     * @param $ch
     * @return bool
     */
    public function closeCurl($ch)
    {
        if (curl_close($ch)){
            return true;
        }
        return false;
    }

    /**
     * выполнение запроса
     * @param $url
     * @param string $type
     * @param null $fields
     * @param IdentityInterface $user
     * @param bool $admin
     * @return mixed|string
     */
    public function makeRequest($url, $type = self::TYPE_GET, $fields = null, IdentityInterface $user = null, bool $admin = false){}
}
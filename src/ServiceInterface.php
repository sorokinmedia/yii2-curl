<?php
namespace sorokinmedia\curl;

use yii\web\IdentityInterface;

/**
 * Interface ServiceInterface
 * @package sorokinmedia\curl
 */
interface ServiceInterface
{
    /**
     * Получение типа аутентификации
     * @return mixed
     */
    public function getAuthType();

    /**
     * Получение токена авторизации
     * @param IdentityInterface|null $user
     * @param bool $admin
     * @return mixed
     */
    public function getAuthToken(IdentityInterface $user = null, bool $admin = false);

    /**
     * set header for curl object
     * @param $ch
     * @param IdentityInterface|null $user
     * @param bool $admin
     * @return mixed
     */
    public function setHeaders($ch, IdentityInterface $user = null, bool $admin = false);

    /**
     * Установка урла обращения
     * @param string $url
     * @param string $type
     * @param array $fields
     * @param IdentityInterface $user
     * @return mixed
     */
    public function setUrl($url, $type = 'get', $fields = null, User $user = null);

    /**
     * Установка типа запроса
     * @param integer $type
     * @param $ch
     * @return mixed
     */
    public function setRequestType($type, $ch);

    /**
     * Устновка массива параметров
     * @param $fields
     * @param $ch
     * @return mixed
     */
    public function setPostFields($fields, $ch);

    /**
     * Настройка овтета
     * @param $ch
     * @param $status
     * @return mixed
     */
    public function setTransfer($ch, $status = 1);

    /**
     * Инициализация curl
     * @param $url
     * @return mixed
     */
    public function initCurl($url);

    /**
     * запуска запроса
     * @param $ch
     * @return mixed
     */
    public function execCurl($ch);

    /**
     * закрывает текущий сеанс
     * @param $ch
     * @return mixed
     */
    public function closeCurl($ch);

    /**
     * получает последнюю ошибку текущего сеанса
     * @param $ch
     * @return mixed
     */
    public function getError($ch);

    /**
     * декодирует ответ
     * @param $response
     * @return mixed
     */
    public function decodeResponse($response);

    /**
     * выполнение запроса
     * @param $url
     * @param string $type
     * @param null $fields
     * @param IdentityInterface $user
     * @param bool $admin
     * @return mixed
     */
    public function makeRequest($url, $type = 'get', $fields = null, IdentityInterface $user = null, bool $admin = false);
}
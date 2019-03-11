<?php/** *  +---------------------------------------------------------------------- *  | 草帽支付系统 [ WE CAN DO IT JUST THINK ] *  +---------------------------------------------------------------------- *  | Copyright (c) 2018 http://www.iredcap.cn All rights reserved. *  +---------------------------------------------------------------------- *  | Licensed ( https://www.apache.org/licenses/LICENSE-2.0 ) *  +---------------------------------------------------------------------- *  | Author: Brian Waring <BrianWaring98@gmail.com> *  +---------------------------------------------------------------------- */namespace IredCap\Pay\Http;use IredCap\Pay\Util\HttpUtil;use IredCap\Pay\Util\LogUtil;use IredCap\Pay\Exception\InvalidRequestException;class HttpRequest{    const CAHRSET = 'utf-8';    /**     * $var string The Caomao API version     */    public static $version = '1.0.0';    /**     * @var string The base URL for the Caomao unifiedorder.     */    public static $baseUrl = 'https://api.pay.iredcap.cn/';    /**     * @var string The Caomao mch ID     */    private static $mchId = null;    /**     * @var string The Caomao notifyUrl     */    private static $notifyUrl = null;    /**     * @var string The Caomao returnUrl     */    private static $returnUrl = null;    /**     * @var string SecretKey     */    private static $secretKey = null;    /**     * @var     */    private static $publicKeyPath = null;    /**     * @var null The Caomao privateKeyPath     */    private static $privateKeyPath = null;    /**     * @var null The Caomao privateKeyPath     */    private static $payPublicKeyPath = null;    /**     * @return string     */    public static function getBaseUrl(): string    {        return self::$baseUrl;    }    /**     * @param string $baseUrl     */    public static function setBaseUrl(string $baseUrl)    {        self::$baseUrl = $baseUrl;    }    /**     * @return string     */    public static function getMchId()    {        return self::$mchId;    }    /**     * @param string $mchId     */    public static function setMchId($mchId)    {        self::$mchId = $mchId;    }    /**     * @return string     */    public static function getNotifyUrl()    {        return self::$notifyUrl;    }    /**     * @param string $notifyUrl     */    public static function setNotifyUrl($notifyUrl)    {        self::$notifyUrl = $notifyUrl;    }    /**     * @return string     */    public static function getReturnUrl()    {        return self::$returnUrl;    }    /**     * @param string $returnUrl     */    public static function setReturnUrl($returnUrl)    {        self::$returnUrl = $returnUrl;    }    /**     * @return null|string     */    public static function getApiVersion()    {        return self::$version;    }    /**     * @param null|string $apiVersion     */    public static function setApiVersion($apiVersion)    {        self::$version = $apiVersion;    }    /**     * @return string     */    public static function getSecretKey()    {        return self::$secretKey;    }    /**     * @param string $secretKey     */    public static function setSecretKey($secretKey)    {        self::$secretKey = $secretKey;    }    /**     * @return null     */    public static function getPrivateKeyPath()    {        return self::$privateKeyPath;    }    /**     * @param null $privateKeyPath     */    public static function setPrivateKeyPath($privateKeyPath)    {        self::$privateKeyPath = $privateKeyPath;    }    /**     * @return mixed     */    public static function getPublicKeyPath()    {        return self::$publicKeyPath;    }    /**     * @param mixed publicKeyPath     */    public static function setPublicKeyPath($publicKeyPath)    {        self::$publicKeyPath = $publicKeyPath;    }    /**     * @return null     */    public static function getPayPublicKeyPath()    {        return self::$payPublicKeyPath;    }    /**     * @param null $payPublicKeyPath     */    public static function setPayPublicKeyPath($payPublicKeyPath)    {        self::$payPublicKeyPath = $payPublicKeyPath;    }    /**     * 请求验证     *     * @author 勇敢的小笨羊 <brianwaring98@gmail.com>     *     * @param string $url     * @param string $method     * @param array $params     *     * @return mixed|string     * @throws InvalidRequestException     * @throws \IredCap\Pay\Exception\InvalidParameterException     */    protected static function _request($url = '', $method = 'GET', $params = [])    {        $opts = self::_validateParams($params);        LogUtil::INFO('Create Params :'.json_encode($params));        $respose = new HttpUtil();        return $respose->request($url, $method, $opts, 5);    }    /**     * 参数补全     *     * @author 勇敢的小笨羊 <brianwaring98@gmail.com>     *     * @param $options     *     * @return mixed     * @throws InvalidRequestException     */    private static function _validateParams($options)    {        //参数填充        if (!array_key_exists('mchid', $options)) {            $options['mchid'] = self::getMchId();        }        if (!array_key_exists('return_url', $options)) {            $options['return_url'] = self::getReturnUrl();        }        if (!array_key_exists('notify_url', $options)) {            $options['notify_url'] =self::getNotifyUrl();        }        if (!array_key_exists('client_ip', $options)) {            $options['client_ip'] = $_SERVER['REMOTE_ADDR'];        }        if (empty(self::getPrivateKeyPath())){            throw new InvalidRequestException("The Path of User Private Key can not be blank.");        }        if (empty(self::getPayPublicKeyPath())){            throw new InvalidRequestException("The Path of Platform Public Key can not be blank.");        }        return $options;    }}
<?php

namespace Westery\LaravelSms;
use Westery\LaravelSms\lib\NetEase;

/**
 * 短信发送
 * Class Sms
 * @package Westery\LaravelSms
 */
class Sms
{

    protected $smsData = [
        'to'           => null,
        'templates'    => [],
        'templateData' => [],
        'content'      => null,
    ];

    protected $agent;

    protected $config;

    public function __construct($config)
    {
        $this->config = $config;
    }

    /**
     * Get all the data of SMS/voice verify.
     *
     * @param null|string $name
     *
     * @return mixed
     */
    public function getData($name = null)
    {
        if (is_string($name) && isset($this->smsData["$name"])) {
            return $this->smsData[$name];
        }

        return $this->smsData;
    }

    /**
     * send mobile.
     *
     * @param $mobile
     *
     * @return $this
     */
    public function to($mobile)
    {
        $this->smsData['to'] = $mobile;

        return $this;
    }

    /**
     * send content for part of sms-providers support content-sms.
     *
     * @param $content
     *
     * @return $this
     */
    public function content($content)
    {
        $this->smsData['content'] = $content;

        return $this;
    }

    /**
     * set template-id for part of sms-providers support template-sms.
     *
     * @param $agentName
     * @param null $tempId
     *
     * @return $this
     */
    public function template($agentName = 'SMS_AGENT', $tempId = null)
    {
        if ($agentName === 'SMS_AGENT') {
            $agentName = $this->config;
        }
        if (is_array($agentName)) {
            foreach ($agentName as $k => $v) {
                $this->template($k, $v);
            }
        } elseif ($agentName && $tempId) {
            if (!isset($this->smsData['templates']) || !is_array($this->smsData['templates'])) {
                $this->smsData['templates'] = [];
            }
            $this->smsData['templates']["$agentName"] = $tempId;
        }

        return $this;
    }

    /**
     * set template-data for part of sms-providers support template-sms.
     *
     * @param array $data
     *
     * @return $this
     */
    public function data(array $data)
    {
        $this->smsData['templateData'] = $data;

        return $this;
    }

    /**
     * @throws \Exception
     *
     * @return mixed
     */
    public function send()
    {
        if($this->config === 'NetEase'){
            $_config = config('sms.agents.'.$this->config);
            $rest = new NetEase($_config['appKey'],$_config['appSecret']);

            if($this->smsData['templates']['NetEase'] == 9999){
                return $rest->sendSmsCode($this->smsData['to'],$this->smsData['templateData']['code']);
            }
            return  $rest->sendSMSTemplate($this->smsData['templates']['NetEase'],$this->smsData['to'],$this->smsData['templateData']);

        } else {
            throw new \Exception('make sure you have choose a right agent');
        }
    }
}

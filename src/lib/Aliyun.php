<?php

/**
 * 阿里云SMS短信发送
 */

namespace Westery\LaravelSms\lib;
use Aliyun\Core\Config as AliyunConfig;
use Aliyun\Core\Profile\DefaultProfile;
use Aliyun\Core\DefaultAcsClient;
use Aliyun\Api\Sms\Request\V20170525\SendSmsRequest;
use Aliyun\Api\Sms\Request\V20170525\QuerySendDetailsRequest;


class Aliyun{


    private $AppKey;
    private $AppSecret;

    private $acsClient;

    private $signName;

    /**
     * 参数初始化
     * @param $AppKey
     * @param $AppSecret
     * @param $SignName
     */
    public function __construct($AppKey,$AppSecret,$SignName){
        $this->AppKey    = $AppKey;
        $this->AppSecret = $AppSecret;
        $this->signName = $SignName;
        AliyunConfig::load();
        $profile = DefaultProfile::getProfile("cn-hangzhou", $this->AppKey, $this->AppSecret);
        DefaultProfile::addEndpoint("cn-hangzhou", "cn-hangzhou", "Dysmsapi", "dysmsapi.aliyuncs.com");
        $this->acsClient = new DefaultAcsClient($profile);
    }



    /**
     * 发送模板短信
     * @param $templateid
     * @param $mobiles array | string
     * @param array $params
     * @return array
     */
    public function sendSMSTemplate($templateid,$mobiles,$params=[]){
        // 初始化SendSmsRequest实例用于设置发送短信的参数
        $request = new SendSmsRequest();
        if(is_array($mobiles)){
            $phone = implode(',',$mobiles);
        }else{
            $phone = $mobiles;
        }
        // 必填，设置短信接收号码
        $request->setPhoneNumbers($phone);
        // 必填，设置签名名称
        $request->setSignName($this->signName);
        // 必填，设置模板CODE
        $request->setTemplateCode($templateid);
        // 可选，设置模板参数
        if(!empty($params)) {
            $params = json_encode($params);
            $request->setTemplateParam($params);
        }
        // 发起请求
        $acsResponse =  $this->acsClient->getAcsResponse($request);
        // 默认返回stdClass，通过返回值的Code属性来判断发送成功与否
        if($acsResponse && strtolower($acsResponse->Code) == 'ok')
        {
            return ['error'=>0,'status'=>200,'message'=>'发送成功'];
        }else{
            return ['error'=>1,'status'=>422,'message'=>'发送失败','info'=>$acsResponse];
        }
    }

}

?>
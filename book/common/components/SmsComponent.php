<?php
namespace common\components;

use yii\base\Component;
use yii\helpers\Html;
use Yii;
class SmsComponent extends Component{
    public $content;
    public $apiKey;

    public function init(){
        parent::init();
        $this->apiKey=Yii::$app->params['smsApiKey'];
    }

    public function send($phone,$content=null){
        $url = 'https://smspilot.ru/api.php?send=New_BOOK&to='.$this->sanitizePhone($phone).'&apikey='.$this->apiKey;
        $res=$this->sendCurl($url);
        Yii::info($res,'sms');
        file_put_contents('sms.log',$res,FILE_APPEND);
        return $res;
    }

    public function sanitizePhone($phone){
        $phone=Html::encode($phone);
        $phone=str_replace(['(',')','-',' '],'',$phone);
        $phone=trim($phone);
        return $phone;
    }
    public function sanitizeContent($content){
        $content=Html::encode($content);
        $content=trim($content);
        return $content;
    }

    protected function sendCurl($url){
        $ch=curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        $res=curl_exec($ch);
        curl_close($ch);
        return $res;
    }
}
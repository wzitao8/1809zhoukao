<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redis;
class WxController extends Controller
{
    public function valid(){
        echo $_GET['echostr'];
    }

    public function wxEvent(){
        //接收微信服务推送
        $content =file_get_contents("php://input");
        $time = date('Y-m-d H:i:s');
        $str =$time .$content ."\n";
        file_put_contents("logs/wx_event.log",$str,FILE_APPEND);
        echo 'SUCCESS';
    }

    public function getAccessToken(){
        //是否有缓存
        $key ='wx_accsee_token';
        $token = Redis::get($key);
//        var_dump($token);
        if($token){
            echo 'Cache';
        }else{
            echo 'NoCache';
            $url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.env('WX_APPID').'&secret='.env('WX_APPSECRET');
            $response = file_get_contents($url);
//            echo $response;
            $arr = json_decode($response,true);
            //缓存
            Redis::set($key,$arr['access_token']);
            Redis::expire($key,3600); //缓存时间1小时
            $token = $arr['access_token'];
        }
        return $token;
    }
    public function test(){
        $access_token = $this->getAccessToken();
        echo 'token:'.$access_token;echo'</br>';
    }
}

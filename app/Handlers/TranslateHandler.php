<?php
namespace App\Handlers;
use GuzzleHttp\Client;
use Overtrue\Pinyin\Pinyin;

class TranslateHandler
{
    // 百度翻译
    public function baiduTranslate($text)
    {
        $http = new Client;

        $appid = "20190723000320554";
        $key = '';
        if (empty($appid) || empty($key)) {
            return $this->pingYinTranslate($text);
        }
        $url = 'http://api.fanyi.baidu.com/api/trans/vip/translate?';
        $salt = time();
        $sign = md5($appid. $text . $salt . $key);
        $query = http_build_query([
            'q' => $text,
            'from' => 'zh',
            'to' => 'en',
            'appid' => $appid,
            'salt' => $salt,
            'sign' => $sign,
        ]);
        $result = $http->get($url.$query);
        $data = json_decode($result->getBody(), true);
        if (isset($data['trans_result'][0]['dst'])) {
            return \Str::slug($data['trans_result'][0]['dst']);
        } else {
            return $this->pingYinTranslate($text);
        }

    }

    // 拼音翻译
    public function pingYinTranslate($text)
    {
        $pinyin = new Pinyin;
        return $pinyin->permalink($text);
    }
}

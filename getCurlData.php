<?php
/**
 * Created by PhpStorm.
 * User: Francisco Llanquipichun <francisco.llanquipichun@gmail.com>
 * Date: 20-01-15
 * Time: 0:18
 */

function getCurlData($url)
{
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_TIMEOUT, 10);
    curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.2.16) Gecko/20110319 Firefox/3.6.16");
    $curlData = curl_exec($curl);
    curl_close($curl);
    return $curlData;
}


function getHttp($url){
    $r = new HttpRequest($url, HttpRequest::METH_GET);
    try {
        $r->send();
        if ($r->getResponseCode() == 200) {
            file_put_contents('local.rss', $r->getResponseBody());
        }
    } catch (HttpException $ex) {
        echo $ex;
    }
}
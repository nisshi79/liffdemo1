<?php
/**
 * Created by PhpStorm.
 * User: yui
 * Date: 2018/08/03
 * Time: 3:40
 */
require ('vendor/autoload.php');
$inputs = filter_input_array(INPUT_POST);

$demoMessage = $inputs['title'].'のお知らせです:'."\r\n\r\n";
$messageBuf[]='';
for($i = 0; $i < min(count($inputs['roles_list']),count($inputs['members_list']));$i++){
    $messageBuf[$i] .= $inputs['roles_list'][$i].'は'.$inputs['members_list'][$i].'の担当です';
}

$demoMessage .= implode("\r\n",$messageBuf);

$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient(getenv('cToken'));
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => getenv('cSec')]);

$textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($demoMessage);
$response = $bot->pushMessage($inputs['group_id'], $textMessageBuilder);

echo $response->getHTTPStatus() . ' ' . $response->getRawBody();

/*$textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('test');
$response = $bot->pushMessage(Ud93e55343ff0dfaa0bd51e382521e44d, $textMessageBuilder);*/
/*Cd7e4374358e5fe9a2a25829af7742985*/
/*echo $response->getHTTPStatus() . ' ' . $response->getRawBody();*/
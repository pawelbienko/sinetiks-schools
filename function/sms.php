<?php
require_once 'smsapi/Autoload.php';

$client = new \SMSApi\Client('p1990');
$client->setPasswordHash( '05a8f2bdae0d9c84cb57fcbf2b9c74e2' );

$smsapi = new \SMSApi\Api\SmsFactory();
$smsapi->setClient($client);


try {
    $actionSend = $smsapi->actionSend();

    $actionSend->setTo('661016649');
    $actionSend->setText('Pani dziecko jest nie obecne w szkole!!');
    $actionSend->setSender('ECO'); //Pole nadawcy, lub typ wiadomości: 'ECO', '2Way'

//    //$response = $actionSend->execute();
//
//    foreach ($response->getList() as $status) {
//        echo $status->getNumber() . ' ' . $status->getPoints() . ' ' . $status->getStatus();
//    }
} catch (\SMSApi\Exception\SmsapiException $exception) {
    echo 'ERROR: ' . $exception->getMessage();
}


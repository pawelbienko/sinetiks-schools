<?php
require_once 'smsapi/Autoload.php';

function sendSms($contactNumber){
    $client = new \SMSApi\Client('p1990');
    $client->setPasswordHash( '05a8f2bdae0d9c84cb57fcbf2b9c74e2' );

    $smsapi = new \SMSApi\Api\SmsFactory();
    $smsapi->setClient($client);

    try {
        $actionSend = $smsapi->actionSend();

        $actionSend->setTo($contactNumber);
        $actionSend->setText('Pani/Pana dziecko jest nieobecne w szkole!!');
        $actionSend->setSender('ECO'); //Pole nadawcy, lub typ wiadomości: 'ECO', '2Way'

        $response = $actionSend->execute();
        
        foreach ($response->getList() as $status) {
           return $status->getNumber() . ' ' . $status->getStatus();
        }
    } catch (\SMSApi\Exception\SmsapiException $exception) {
        /*echo*/ 'ERROR: ' . $exception->getMessage();
    }
}    


<?php

$files = array(
    'class',
    'subject',
    'student',
    'mark',
    'attendance'
);

foreach ($files as $route){
    require_once(ROOTDIR . DS .$route. DS .$route. '-list.php');
    require_once(ROOTDIR . DS .$route. DS .$route. '-create.php');
    require_once(ROOTDIR . DS .$route. DS .$route. '-update.php');
}

require_once(ROOTDIR . DS . 'function'. DS . 'extra-user-field.php');
require_once(ROOTDIR . DS . 'function'. DS . 'mailer.php');
require_once(ROOTDIR . DS . 'function'. DS . 'sms.php');
require_once(ROOTDIR . DS . 'scheduler'. DS . 'class-scheduler.php');
require_once(ROOTDIR . DS . 'scheduler'. DS . 'class-scheduler-update.php');
require_once(ROOTDIR . DS . 'scheduler'. DS . 'calendar.php');
require_once(ROOTDIR . '..' .DS . '..' .DS . '..' .DS . 'wp-includes' .DS. 'class-phpmailer.php');

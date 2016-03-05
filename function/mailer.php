<?php

add_action('phpmailer_init','smtp_email');

function smtp_email( $phpmailer, $to, $name) {

$phpmailer->isSMTP();

//$phpmailer->SMTPDebug = 3; 

$phpmailer->Host = "mail.p1990.idl.pl"; // Adres serwera SMTP
$phpmailer->Port = "587"; // Nr portu, zazwyczaj: 25|465|587

$phpmailer->SMTPAuth = true; // Autoryzacja SMTP: true|false
$phpmailer->SMTPSecure = "tls"; // Typ szyfrowania, zazwyczaj: tls|ssl

$phpmailer->Username = "p1990"; // Nazwa użytkownika dla serwera SMTP
$phpmailer->Password = "21qDo5P3nl"; // Hasło użytkownika dla serwera SMTP

$phpmailer->From = "adres_email@serwerpocztowy.pl"; // Adres e-mail nadawcy
$phpmailer->FromName = "Imie lub pseudonim"; // Nazwa nadawcy
////$phpmailer->addAddress($to, $name);
//
//$phpmailer->Subject = 'Here is the subject';
//$phpmailer->Body    = 'Państwa dziecko jest nieobecne w szkole';
////$phpmailer->AltBody = 'This is the body in plain text for non-HTML mail clients';
//
//if(!$phpmailer->send()) {
//    echo 'Message could not be sent.';
//    echo 'Mailer Error: ' . $phpmailer->ErrorInfo;
//} else {
//    echo 'Message has been sent';
//}

}


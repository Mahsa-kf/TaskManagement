<?php

require("../vendor/phpmailer/phpmailer/src/PHPMailer.php");
require("../vendor/phpmailer/phpmailer/src/SMTP.php");
require("../vendor/phpmailer/phpmailer/src/Exception.php");


//namespace Model;

class Emailer {

    public function __construct() {
    }

    public static function validateEmailAddress($emailAddress) {
        
        if (filter_var($emailAddress, FILTER_VALIDATE_EMAIL) === false) {
            return false;
        } else {
            return true;
        }
    }

    public static function sendEmail($recipientAddress, $recipientName, $senderAddress, $senderName, $subject, $body, $is_body_html = false) {

        if (!self::validateEmailAddress($recipientAddress)) {
            throw new PHPMailer\PHPMailer\Exception('Recipient email address is invalid: ' .
                                htmlspecialchars($recipientAddress));
        }
        if (!self::validateEmailAddress($senderAddress)) {
            throw new PHPMailer\PHPMailer\Exception('Sender email address is invalid: ' .
                                htmlspecialchars($senderAddress));
        }

    $mail = new PHPMailer\PHPMailer\PHPMailer();
    // **** You must change the following to match your
    // **** SMTP server and account information.    
    $mail->isSMTP();                             // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';              // Set SMTP server
    $mail->SMTPSecure = 'tls';                   // Set encryption type
    $mail->Port = 587;                           // Set TCP port
    $mail->SMTPAuth = true;                      // Enable SMTP authentication
    $mail->Username = '';//insert username to use // Set SMTP username
    $mail->Password = '';//insert password to use // Set SMTP password

    // Set sender info, recipient info, subject, and body
    $mail->setFrom($senderAddress, $senderName);
    $mail->addAddress($recipientAddress, $recipientName);
    $mail->Subject = $subject;
    $mail->Body = $body;                  // Body with HTML
    $mail->AltBody = strip_tags($body);   // Body without HTML
    if ($is_body_html) {
        $mail->isHTML(true);              // Enable HTML
    }

    if(!$mail->send()) {
        throw new PHPMailer\PHPMailer\Exception('Error - unable to send email: ' .
                            htmlspecialchars($mail->ErrorInfo) );        
    }    
}



}

?>
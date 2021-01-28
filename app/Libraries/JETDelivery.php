<?php

namespace App\Libraries;

require_once __DIR__.DIRECTORY_SEPARATOR.'PHPMailer'.DIRECTORY_SEPARATOR.'PHPMailer.php';
require_once __DIR__.DIRECTORY_SEPARATOR.'PHPMailer'.DIRECTORY_SEPARATOR.'Exception.php';
require_once __DIR__.DIRECTORY_SEPARATOR.'PHPMailer'.DIRECTORY_SEPARATOR.'SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

class JETDelivery extends PHPMailer
{
    // Extend or Override PHPMailer as needed here
    
    public function setServerConfig($host, $username, $password, $port = '587', $security = 'tls')
    {
        //$mail->SMTPDebug = 3;                               
        $this->isSMTP();
        $this->Host = $host;
        $this->SMTPAuth = true;
        $this->Username = $username;
        $this->Password = $password;
        $this->SMTPSecure = $security;                           
        $this->Port = $port;
    }

    public function deliverEmail($message)
    {
        $this->FromName = $message['fromName'];
        $this->From = $message['fromEmail'];
        $this->addAddress($message['toEmail']);
        $this->isHTML($message['isHTML']);
        $this->Subject = $message['subject'];
        $this->Body = $message['body'];
        $this->AltBody = $message['subject'];
        
        try {
            if($this->send()){
                return ["status" => 1, "message" => "Email was Sent"];
            } else {
                return ["status" => 0, "message" => $this->ErrorInfo];
            }
        } catch (Exception $e) {
            return ["status" => 0, "message" => $e->getMessage()];
        }
    }
}

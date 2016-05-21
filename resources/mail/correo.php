<?php

require_once("phpmailer/PHPMailerAutoload.php");

class Correo {

    private $mail;
    private $address;
    private $subject;
    private $body;

    public function __CONSTRUCT(){
        $this->mail = new PHPMailer();
    }

    public function sendEmail(){

        //$mail->SMTPDebug = 3;                               // Enable verbose debug output
        $this->mail->isSMTP();                                      // Set mailer to use SMTP
        $this->mail->CharSet = "UTF-8";
        $this->mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
        $this->mail->SMTPAuth = true;                               // Enable SMTP authentication
        $this->mail->Username = 'titbol.kevin@gmail.com';                 // SMTP username titbol.kevin@gmail.com
        $this->mail->Password = 'chile2015';                           // SMTP password chile2015
        $this->mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $this->mail->Port = 587;                                    // TCP port to connect to

        $this->mail->setFrom('aquino.titbol@gmail.com', 'EPSAS');
        $this->mail->addAddress($this->address);     // Add a recipient
        //$this->mail->addAddress('ellen@example.com');               // Name is optional
        //$this->mail->addReplyTo('zxvega@gmail.com');
        //$this->mail->addCC('cc@example.com');
        //$this->mail->addBCC('bcc@example.com');

        //$this->mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        //$this->mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
        $this->mail->isHTML(true);                                  // Set email format to HTML

        $this->mail->Subject = $this->subject;
        $this->mail->Body    = $this->body;
        //$this->mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        return $this->mail->send();
    }

    public function setAddress($_address){
        $this->address = $_address;
    }

    public function setSubject($_subject){
        $this->subject = $_subject;
    }

    public function setBody($_body){
        $this->body = $_body;
    }

}

?>

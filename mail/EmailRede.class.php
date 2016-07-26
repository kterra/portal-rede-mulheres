<?php

/*
 * Created by PhpStorm.
 * User: emilio
 * Date: 28/05/15
 * Time: 20:24
 */
class EmailRede extends PHPMailer
{
    // Construtor para envio de email do Gmail
    public function __construct()
    {
        # Enviar email confirmando inscricao
        //SMTP needs accurate times, and the PHP time zone MUST be set
        //This should be done in your php.ini, but this is how to do it if you don't have access to that
        date_default_timezone_set('Etc/UTC');

        //Create a new PHPMailer instance
        //        $mail = new PHPMailer;
        //Tell PHPMailer to use SMTP
        $this->isSMTP();
        //Enable SMTP debugging
        // 0 = off (for production use)
        // 1 = client messages
        // 2 = client and server messages
        $this->SMTPDebug = 0;
        //Ask for HTML-friendly debug output
        $this->Debugoutput = 'html';
        //Set the hostname of the mail server
        $this->Host = 'smtp.gmail.com';
        //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
        $this->Port = 587;
        //Set the encryption system to use - ssl (deprecated) or tls
        $this->SMTPSecure = 'tls';
        //Whether to use SMTP authentication
        $this->SMTPAuth = true;
        //Username to use for SMTP authentication - use full email address for gmail
        $this->Username = "legin@ime.uerj.br";
        //Password to use for SMTP authentication
        $this->Password = "legin@123";
        //Set who the message is to be sent from
        $this->setFrom('mulheresnarede@asplande.org.br', 'MULHERES EM REDE');
        $this->isHTML(TRUE);

    }
}
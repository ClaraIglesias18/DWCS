<?php

use PHPMailer\PHPMailer\PHPMailer;

require "vendor/autoload.php";
require_once('Envio.php');

class Correo {
    private $destinatario;
    private $host;
    private $mail;

    public function __construct($host = "10.10.32.132", $destinatario = "destino@servidor.com"){
        $this->host = $host;
        $this->destinatario = $destinatario;
        
        $this->mail = new PHPMailer();

        $this->mail->IsSMTP();
        $this->mail->SMTPDebug = 2;
        $this->mail->SMTPAuth = false;
        $this->mail->Host = $host;
        $this->mail->Port= 25;
        $this->mail->Username = "";
        $this->mail->Password = "";
        $this->mail->AddAddress($destinatario, "Test");
        
    
    }

    public function enviar($envio) {

        $this->mail->SetFrom($envio->getOrigen(), 'Test');
        $this->mail->Subject = $envio->getAsunto();
        $this->mail->MsgHTML($envio->getCuerpo());

        $result = $this->mail->Send();

        return $result;
    }

}

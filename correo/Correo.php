<?php

use PHPMailer\PHPMailer\PHPMailer;

require "vendor/autoload.php";
require_once('Envio.php');

class Correo {
    private $destinatario;
    private $host;
    private $origen;
    private $asunto;
    private $cuerpo;

    public function __construct($host = "10.10.32.132", $destinatario = "destino@servidor.com"){
        $this->host = $host;
        $this->destinatario = $destinatario;
        
        $mail = new PHPMailer();

        $mail->IsSMTP();
        $mail->SMTPDebug = 2;
        $mail->SMTPAuth = false;
        $mail->Host = $host;
        $mail->Port= 25;
        $mail->Username = "";
        $mail->Password = "";
        $mail->AddAddress($destinatario, "Test");
        
    
    }

    public function enviar(Envio $envio) {

        $mail->SetFrom($envio->getOrigen(), 'Test');
        $mail->Subject = $envio->getAsunto();
        $mail->MsgHTML($envio->getCuerpo());

        $result = $mail->Send();

        return $result;
    }

}

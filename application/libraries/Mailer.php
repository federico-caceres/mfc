<?php
defined('BASEPATH') OR exit('No direct script access allowed');


require_once APPPATH."third_party/PHPMailer/PHPMailerAutoload.php";

class Mailer{
    
public function sendMail($cuerpo, $destinario, $remitente, $asunto, $adjuntos = "") {
    
    $mail = new PHPMailer(); // create a new object
    $mail->isSMTP(); // enable SMTP
    $mail->SMTPAuth = true; // authentication enabled
    $mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for Gmail
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );

    $mail->IsHTML(true);
    $mail->Username = 'notificaciones2@skytel.com.py';
    $mail->Password = 'skytel2018!!';
    $mail->SetFrom($remitente["mail"], $remitente["nombre"]);
    $mail->Subject = $asunto;
    $mail->Body = $cuerpo;

 
    if ($adjuntos) {
        foreach ($adjuntos as $adjunto) {
            $mail->addStringAttachment($adjunto["archivo"], $adjunto["nombre"] . '.pdf', 'base64', 'application/pdf');
        }
    }
        foreach($destinario as $valor){
            $mail->clearAddresses();
            $mail->AddAddress($valor);
            if (!$mail->Send()) {
                log_message('error', $mail->ErrorInfo);
                return false;
            }
            (count($destinario) > 1) ? sleep(20) : '';
        }
        return true;
    }    
}
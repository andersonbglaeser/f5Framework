<?php

/**
 * emailHelper
 * Disparos de e-mails autenticados.
 * @copyright (c) Setembro, 2015, Anderson B. Glaeser - F5 Digital
 */
class mailHelper {
    public function sendMail($mensagem, $assunto, $destinatario, $anexo = null){

        require_once('complements/phpmailer/class.phpmailer.php');

        $mail = new PHPMailer(); // defaults to using php "mail()"
        $conteudo = eregi_replace("[\]",'',$mensagem);
        
        $mail->IsSMTP();
        $mail->Host       = "HOST";
        $mail->Username   = "USERNAME";
        $mail->Password   = "PASSWORD";
        $mail->SMTPDebug  = 0;
        $mail->SMTPAuth   = true;
        $mail->Port       = 587;

        $mail->SetFrom('REMETENTE', 'NOME REMETENTE');
        $mail->AddAddress($destinatario);
        $mail->Subject    = $assunto;
        $mail->AltBody    = "Para visualizar esta mensagem, ative a visualização por HTML!";
        $mail->MsgHTML($conteudo);
        if($anexo != ''){
            $mail->AddAttachment($anexo);
        }

        if(!$mail->Send()) {
            return $mail->ErrorInfo;
        } else{
            return "E-mail enviado com sucesso.";
        }
    }
}
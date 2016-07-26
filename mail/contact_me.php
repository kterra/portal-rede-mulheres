<?php
# Incluir arquivo que é responsável pela classe PHPMailer / EmailRede
require_once 'PHPMailer/PHPMailerAutoload.php';
require_once 'EmailRede.class.php';

/* *********************************************** */
/* ETAPA DE CHECAGEM DE POST DO FORMULÁRIO         */
/* *********************************************** */
# Check for empty fields
if (empty($_POST['name']) ||
    empty($_POST['email']) ||
    empty($_POST['phone']) ||
    empty($_POST['message']) ||
    !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)
) {
    echo "No arguments Provided!";
    return false;
}

/* *********************************************** */
/* ETAPA DE PERSONALIZAÇÃO DE VARIAVEIS            */
/* *********************************************** */
# Personalizando retorno do formulário para variaveis
$name = $_POST['name'];
$email_address = $_POST['email'];
$phone = $_POST['phone'];
$message = $_POST['message'];


/* ********************************************************** */
/* Variáveis que serão utilizadas no corpo do email           */
/* ********************************************************** */
$to = 'mulheresnarede@asplande.org.br'; // Add your email address inbetween the '' replacing yourname@yourdomain.com - This is where the form will send a message to.
$email_subject = "Nova Mensagem de: $name";
$ano = date('Y');

# Mensagem HTML PERSONALIZADA - > Coloque nesse trecho o HTML/STYLE para estilizar corpo do email
$msg = <<<HTML
                    <style>

                    </style>

                    <div>

                        <h3>Você recebeu uma nova mensagem via Formulário de Contato.</h3>
                        <h3>Aqui estão os detalhes:</h3>
                        <br>
                        Nome: $name
                        <br>
                        Email: $email_address
                        <br>
                        Telefone: $phone
                        <br>
                        Mensagem: $message

                    </div>
HTML;
# BODY ANTIGO
//$email_body = "Você recebeu uma nova mensagem via Formulário de contato.\n\n"."Aqui estão os detalhes:\n\nNome: $name\n\nEmail: $email_address\n\nTelefone: $phone\n\nMensagem:\n$message";

/* ************************************************ */
/* ETAPA DE ENVIO DE EMAIL COM A CLASSE PHPMAILER   */
/* ************************************************ */
# Gera classe de email
$objMailerRede = new EmailRede();
# Assunto do Email
$objMailerRede->Subject = $email_subject;
# Email para o qual irão as informações do formulário
$objMailerRede->addAddress($to, 'MULHERES EM REDE');
# Configura CC-Copia/BCC-Cópia Oculta
//$objMailerRede->addCC('');
$objMailerRede->addBCC('pmeirelles2@gmail.com', 'Pedro Meirelles');
# Corpo do Email*/
$objMailerRede->msgHTML($msg);

# Status de envio
$status = array(
    'type' => 'success',
    'message' => 'Email enviado com sucesso!'
);

# Enviando
if ($objMailerRede->send()) {
    // Envia retorno para função chamadora no Javascript/Jquery - AJAX
    echo json_encode($status);
} else {
    die('erro de envio');
}

//echo "<pre>";
//var_dump($_POST);
//echo "</pre>";
//die;


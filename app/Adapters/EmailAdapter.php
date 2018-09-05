<?php

namespace App\Adapters;

use App\Core\AdapterAbstract;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class EmailAdapter extends AdapterAbstract
{

    private $_emailDriver;
    private $_senderEmail = 'rdimfo@gmail.com';
    private $_senderPasswordEmail = 'rdimfo-1';
    private $_senderName = 'RDI';
    private $_subject = '';
    private $_content = [];
    private $_errors = [
        'system_messages' => [],
        'error_messages' => [],
    ];

    public function __construct()
    {
        $this->_emailDriver = new PHPMailer(true);

    }

    public function setEmailSubject($subject)
    {
        $this->_subject = $subject;
    }

    public function addEmailReceiver($email, $name)
    {
        $this->_emailDriver->AddAddress($email, $name);
    }

    public function setEmailContent(array $content)
    {
        $this->_content['text'] = $content['text'];
    }

    public function send()
    {

        if (!$this->_content) {
            $this->_errors['error_messages'][] = 'Não foi configurada nenhuma mensagem para o envio';
        }

        if ($this->_errors['system_messages']) {
            return $this->_errors;
        }

        $this->_emailDriver->SMTPDebug = 2; // debugging: 1 = errors and messages, 2 = messages only
        $this->_emailDriver-> isSMTP();
        $this->_emailDriver->SMTPAuth = true; // authentication enabled
        $this->_emailDriver->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
        $this->_emailDriver->Host = "smtp.gmail.com";
        $this->_emailDriver->Port = 465; // or 587
        $this->_emailDriver->IsHTML(true);
        $this->_emailDriver->Username = $this->_senderEmail;
        $this->_emailDriver->Password = $this->_senderPasswordEmail;
        $this->_emailDriver->Subject = $this->_subject;
        $this->_emailDriver->Body = $this->_content['text'];
        $this->_emailDriver->SetFrom($this->_senderEmail, $this->_senderName);

        try {

            return $this->_emailDriver->send();

        } catch (Exception $ex) {

            $this->_errors['system_messages'][] = $ex->getMessage();
            return $this->_errors;
        }

    }

}

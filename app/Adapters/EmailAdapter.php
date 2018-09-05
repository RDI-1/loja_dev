<?php

namespace App\Adapters;

use App\Core\AdapterAbstract;
use PHPMailer;
use Exception;

class EmailAdapter extends AdapterAbstract
{

    private $_emailDriver;
    private $_senderEmail = 'rdimfo@gmail.com';
    private $_senderPasswordEmail = 'rdimfo-1';
    private $_senderName = 'RDI';
    private $_subject = '';
    private $_receivers = [];
    private $_content = [];
    private $_errors = [
        'system_messages' => [],
        'error_messages' => [],
    ];

    public function __construct()
    {
        $this->_emailDriver = new PHPMailer();
    }

    public function setEmailSubject($subject)
    {
        $this->_subject = $subject;
    }

    public function setEmailReceivers(array $names, array $emails)
    {
        $this->_receivers['names'] = $names;
        $this->_receivers['emails'] = $emails;
    }

    public function setEmailContent($text)
    {
        $this->_content['text'] = $text;
    }

    public function send()
    {

        if (!$_receivers) {
            $this->_errors['error_messages'][] = 'Não foram selecionados usuários para o envio.';
        }

        if (!$_content) {
            $this->_errors['error_messages'][] = 'Não foi configurada nenhuma mensagem para o envio';
        }

        if ($this->_errors['system_messages']) {
            return $this->_errors;
        }

        $this->_emailDriver->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
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

        foreach ($this->_receivers as $receiver) {
            $this->_emailDriver->AddAddress($receiver['email'], $reciver['email']);
        }

        try {

            $this->_emailDriver->Send();

        } catch (Exception $ex) {

            $this->_errors['system_messages'][] = $ex->getMessage();
            return $this->_errors;
        }

    }

}

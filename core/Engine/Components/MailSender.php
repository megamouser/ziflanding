<?php
namespace Core\Engine\Components;

class MailSender
{
  public $jsonData;
  public $emailTemplate;

  function __construct($jsonData)
  {
    $this->jsonData = $jsonData;
    $this->generateTemplate($this->jsonData);
  }

  protected function generateTemplate($json)
  {
    $result = "";
    $decodedJson = json_decode($json, false, 512, JSON_UNESCAPED_UNICODE);
    foreach ($decodedJson as $key => $value) {
        $result .= "<div>$key: $value </div>";
    }

    $this->emailTemplate = $result;
    return $this->emailTemplate;
  }

  public function sendEmail()
  {
    $data = json_decode($this->jsonData, true);
    $headers = 'From: zif@kompr.ru' . "\r\n" .
               'Reply-To: zif@kompr.ru' . "\r\n" .
               'Content-type: text/html; charset=utf-8' . "\r\n" .
               'X-Mailer: PHP/' . phpversion();

    $clientEmail = $data["email"];
    $ownMessage = "<div><b>Заявка с zif@kompr.ru</b></div>" . $this->emailTemplate;
    $clientMessage = "<div>Здравствуйте, вы оформили заявку на zif@kompr.ru следующего содержания: </div>" . $this->emailTemplate;
    
    mail($clientEmail, "Вы оставили заявку на сайте zif@kompr.ru", $clientMessage, $headers);
    mail("euronasos19@gmail.com", "zif@kompr.ru", $ownMessage, $headers);
  }
}
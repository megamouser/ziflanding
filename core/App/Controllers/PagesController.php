<?php
namespace Core\App\Controllers;
use Core\Engine\Components\Helper;
use Core\Engine\Database\MySQLite;
use Core\Engine\Components\MailSender;

class PagesController
{
    public function home()
    {
        return Helper::view('home');
    }

    public function test()
    {
        $testData = ['name' => 'админ', 'phone' => '89992026355', 'email' => 'art@kompr.ru', 'message' => 'test message'];
        $jsonData = Helper::arrToJson($testData);
    }

    public function email()
    {
        if($_POST)
        {
            //print_r($_POST);
            $_POST['date'] = date('m.d.y H:i:s');
            $jsonData = Helper::arrToJson($_POST);
            
            $mySQLite = new MySQLite;

            if(!$mySQLite)
            {
                echo $mySQLite->lastErrorMsg();
            }
            else
            {
                echo "Opened database successfully\n";
                $sql = "INSERT INTO MESSAGES (CONTENT) VALUES ('$jsonData')";
                $ret = $mySQLite->exec($sql);
                if(!$ret)
                {
                    echo $mySQLite->lastErrorMsg();
                }
                else
                {
                    echo "Records created successfully\n";
                }
                
                $mySQLite->close();
                $mailSender = new MailSender($jsonData);
                $mailSender->sendEmail();
            }
        }
    }
}
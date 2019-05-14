<?php
namespace Core\App\Controllers;
use Core\Engine\Components\Helper;
use Core\Engine\Database\MySQLite;

class PagesController
{
    public function home()
    {
        return Helper::view('home');
    }

    public function test()
    {
        $testData = ['name' => 'admin', 'phone' => '89992026355', 'email' => 'art@kompr.ru', 'message' => 'test message'];
        $jsonData = Helper::arrToJson($testData);

        $mySQLite = new MySQLite;
        print_r($mySQLite);

        /*
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
            $mailer = new Mailer($_POST);
            $mailer->sendEmail();
        }
        */
    }

    public function email()
    {
        if($_POST)
        {
            print_r($_POST);
            $_POST['date'] = date('Y:m:d H:i:s');
            $jsonData = Helper::arrToJson($_POST);
            print_r($jsonData);
        }
    }
}
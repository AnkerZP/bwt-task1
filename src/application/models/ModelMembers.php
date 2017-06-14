<?php

namespace Application\models;

use \PDO;
use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Validator as v;

class ModelMembers
{
    //Получение данных для таблицы All_Members
    public function getData()
    {
        $pdo = $this->getConnect();
        $sql = 'SELECT id_account, firstname, lastname, report, email, photo FROM accounts';
        $prepare = $pdo->prepare($sql);
        $prepare->execute();
        $rez = $prepare->fetchAll();
        return $rez;
    }
    //Получаем кол-во member-ов
    public function getCount()
    {
       $pdo = $this->getConnect(); 
       $sql = "SELECT COUNT(*) as count FROM accounts";
       $prepare = $pdo->prepare($sql);
       $prepare->execute();
       $count = $prepare->fetchColumn();
       return $count;
    }
    //Заполнение данными Формы_1
    public function setData()
    {

        $firstname  = $_POST['firstname'];          //text
        $lastname   = $_POST['lastname'];           //text
        $report     = $_POST['reportsubject'];      //text
        $country    = $_POST['country'];            //text
        $phone      = $_POST['phone'];              //phone
        $phone      = '+'.$phone;
        $email      = $_POST['email'];              //email
        $birthday   = $_POST['birthday'];           //date
        $newDate    = explode(".", $birthday);      //2-year 1-month 0-day
        $date    = $newDate[2].'-'.$newDate[1].'-'.$newDate[0];
        //
        $nameValid      = v::notEmpty()->alpha()->length(1, 50);
        $reportValid    = v::notEmpty()->alnum()->length(1, 255);
        $countryValid   = v::notEmpty()->alpha()->length(1, 30);
        $phoneValid     = v::notEmpty()->phone()->length(7, 17);
        $emailValid     = v::notEmpty()->email()->length(6,255);
        $dateValid      = v::notEmpty()->date() ->between('1990-01-01','now');
        try {
            $nameValid      ->assert($firstname);
            $nameValid      ->assert($lastname);
            $reportValid    ->assert($report);
            $countryValid   ->assert($country);
            $phoneValid     ->assert($phone);
            $emailValid     ->assert($email);
            $dateValid      ->assert($date);
            //
            $pdo = $this->getConnect();
            $sql = "INSERT INTO accounts (firstname, lastname, birthday, report, country, phone, email)
                                VALUES  (:firstname,:lastname,:birthday,:report,:country,:phone,:email)";
            $prepare = $pdo->prepare($sql);
            $prepare->execute(array($firstname,$lastname,$birthday,$report,$country,$phone,$email));
            $id_account = $pdo->lastInsertId();
            $_SESSION['id_account'] = $id_account;
            $_SESSION['id'] = $id_account; 
            $errors['isError'] = False;
            return json_encode($errors);
        } catch(ValidationException $exception) {
            $errors = $exception->findMessages([
                "alnum", "alpha", "length", "notEmpty", "phone","email","date","between",
            ]);
            $errors['isError'] = True;
            return json_encode($errors);
        }          
    }

    //Заполнение данными Формы_2
    public function setUpdate()
    {
        unset ($_SESSION['id']);
        $id_account = $_SESSION['id_account'];
        unset ($_SESSION['id_account']);
        //
        $company = $_POST['company'];
        $position = $_POST['position'];
        $about = $_POST['about']; 
        //
        $textValid  = v::alnum()->length(0, 30);
        $aboutValid = v::alnum()->length(0, 65000);
        $idValid    = v::intVal()->length(1, 100);
        try {
            $textValid      ->validate($company);
            $textValid      ->validate($position);
            $aboutValid     ->validate($about);
            $idValid        ->validate($id_account);
            //
            $pdo = $this->getConnect();
            $sql = "UPDATE accounts SET accounts.company=:company, accounts.position=:position, accounts.about=:about WHERE accounts.id_account=:id_account;";
            $prepare = $pdo->prepare($sql);
            $prepare->execute(array($company,$position,$about,$id_account));
            $errors['isError'] = False;
            return json_encode($errors);
        } catch(ValidationException $exception) {
            $errors = $exception->findMessages([
                'alnum', 'intVal', 'length',
            ]);
            $errors['isError'] = True;
            return json_encode($errors);
        }          
    }

    //Загрузка фотаграфий на сервер и ссылки в БД с Формы_2
    public function setPhoto()
    {
        $id_account = $_SESSION['id_account'];
        try {
            v::image()              ->assert($_FILES['image']['tmp_name']);
            v::size(null, '5mb')    ->assert($_FILES['image']['tmp_name']);

            $dir = "./upload/" . $_FILES['image']['name'] . "_" . rand(0, 999999) . "_" . time();
            move_uploaded_file($_FILES['image']['tmp_name'], $dir);

            $pdo = $this->getConnect();
            $sql = "UPDATE accounts SET accounts.photo=:dir WHERE accounts.id_account=:id_account;";
            $prepare = $pdo->prepare($sql);
            $prepare->execute(array($dir,$id_account));         

            $errors['isError'] = False;
            return json_encode($errors);
        } catch(ValidationException $exception){
            $errors = $exception->findMessages([
                "image"     => $_FILES['image']['name']." must be a valid image",
                "size"      => $_FILES['image']['name']." must be lower than 5 Mb", 
            ]);
            $errors['isError'] = True;
            return json_encode($errors);
        }
    }
    //Проверка существования
    public function isValid()
    {
        $email = $_POST['email'];
        if ($email != ''){
            $pdo = $this->getConnect();
            $sql = "select count(*) from accounts where email = :id";
            $prepare = $pdo->prepare($sql);
            $prepare->execute(array($email));
            $count = $prepare->fetch();
            if ($count['count(*)']>0){
                $rez['isValid'] = false;
                $rez['msg']     = "This email is already exist!";
            }else{
                $rez['isValid'] = true;
                $rez['msg']     = "This Email is valid!";
            }
            return json_encode($rez);
        }                  
    }

    //Подключение к БД
    public function getConnect()
    {
        include './application/config/database.php';

        $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";
        $opt = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];

        return new PDO($dsn, $user, $pass, $opt);
    }
}
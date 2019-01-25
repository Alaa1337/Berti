<?php

/** @var $link PDO */
global $link;


function opendb($file)
{
    global $link;
    $link = new PDO('sqlite:'.$file);
    $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    function init_db()
    {
        global $link;
        $link->exec(
            'CREATE TABLE IF NOT EXISTS `users` (
            `id`	INTEGER PRIMARY KEY AUTOINCREMENT UNIQUE,
            `verified`	INTEGER,
            `verification_code` TEXT UNIQUE,
            `registerdate`	TEXT,
            `email`	TEXT UNIQUE,
            `password`	TEXT,
            `firstname`	TEXT,
            `lastname`	TEXT,
            `sw_user_id`	INTEGER,
            `sw_company_id`	INTEGER
        );'
        );

        $link->exec(
            '
            CREATE TABLE IF NOT EXISTS `log` (
                `id`	    INTEGER PRIMARY KEY AUTOINCREMENT UNIQUE,
                `user_id`	INTEGER,
                `date`	    TEXT,
                `action`	TEXT
            );'
        );
    }
}

// Checks if the $email is in the database already
function check_username_free($email)
{
    global $link;


    $sql = 'SELECT email FROM users WHERE email = :email ';
    $stmt = $link->prepare($sql);
    $stmt->bindValue(':email', strtolower($email));
    $stmt->execute();

    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // var_dump($res);

    if (empty($res)) {

        return true;

    }

    return false;

}

function add_user($email, $password, $firstname, $lastname)
{
    $date = new DateTime('now');
    $now = $date->format('Y-m-d H:i:s');

    $length = 15;
    $code = substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
    var_dump($code);

    global $link;
    $sql = 'INSERT INTO users(email,password,firstname,lastname,registerdate,verified,verification_code) VALUES(:email,:password,:firstname,:lastname,:registerdate,:verified,:code)';
    /** @var  $stmt PDOStatement */
    $stmt = $link->prepare($sql);
    $stmt->bindValue(':verified' , 0);
    $stmt->bindValue(':registerdate', $now);
    $stmt->bindValue(':code', $code);
    $stmt->bindValue(':email', strtolower($email));
    $stmt->bindValue(':password', password_scramble($password));
    $stmt->bindValue(':firstname', $firstname);
    $stmt->bindValue(':lastname', $lastname);

    $stmt->execute();

    return $link->lastInsertId();

    return true;
}



// makes the pw unreadable to the admin and any 1337 h4xx0rs
function password_scramble($password)
{

    $options = [
        'memory_cost' => '65536',
        'time_cost' => '5',
        'threads' => '4',
    ];

    $password = password_hash($password, PASSWORD_ARGON2I, $options);

    return $password;
}


// - but still checkable for correctness
// possibly split into two functions to see if the user exists at all
function password_check($email, $password)
{
    global $link;
    $sql = 'SELECT password FROM users WHERE email = :email';
    $stmt = $link->prepare($sql);
    $stmt->bindValue(':email', $email);
    $stmt->execute();

    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);


    if (empty($res)) {

        return false;

    }

    $password_check = $res[0]['password'];

    return password_verify($password, $password_check);
}


function login($email, $password)
{
    global $link;

    if (password_check(strtolower($email), $password)) {


        $sql = 'SELECT * FROM users WHERE email = :email';
        $stmt = $link->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->execute();

        $res = $stmt->fetchAll(PDO::FETCH_ASSOC)[0];



        $_SESSION['logged_in'] = true;
        $_SESSION['user'] = $res;
        header('Location: ?page=start');

        return true;
    }

    return false;
}




function verification(){

if (isset($_GET['code'])&& strlen($_GET['code']) > 1) {
    global $link;


    $sql = 'UPDATE users SET verified = 1 WHERE verification_code = :code';


    $stmt = $link->prepare($sql);


    $stmt->bindValue(':code', $_GET['code']);
    $stmt->execute();

    return true;

}

}

function getcode(){

    global $link;


    $sql = 'SELECT verification_code FROM users WHERE email = :email';

    $stmt = $link->prepare($sql);

    $stmt->bindValue(':email', $_POST['email']);

    $stmt->execute();

    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);


    return $res[0]['verification_code'];

}


function delete()
{
    global $link;



    if (!empty($_SESSION['user']['email'])) {
        // @Margus Deleted = 0 = BS da DSGVO - LG tobi :3
        $sql = 'DELETE FROM users WHERE email = :email';
        $stmt = $link->prepare($sql);
        $stmt->bindValue(':email', $_SESSION['user']['email']);
        $stmt->execute();


        header('Location: ?page=start');

        return true;
    }

}



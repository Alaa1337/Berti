<?php
global $link;


function opendb($file)
{
    global $link;
    $link = new PDO('sqlite:'.$file);
    $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}

function init_db()
{
    global $link;
    $link->exec(
        'CREATE TABLE IF NOT EXISTS `users` (
	`id`	INTEGER PRIMARY KEY AUTOINCREMENT UNIQUE,
	`verified`	INTEGER,
	`registerdate`	TEXT,
	`email`	TEXT,
	`password`	TEXT,
	`firstname`	TEXT,
	`lastname`	TEXT,
	`sw_user_id`	INTEGER,
	`sw_company_id`	INTEGER,
	`deleted`	INTEGER
);'
    );

}


// Checks if the $email is in the database already
function check_username_free($email)
{

    $data = file('data.txt');

    foreach ($data as $dbentry) {
        $possible_email = substr($dbentry, 0, 127);

        if (strpos($possible_email, secure_for_db_input($email)) === 0) {
            return false;
        }
    }

    return true;
}


// Takes a string and makes it "database" "safe"
function secure_for_db_input($value)
{

    $bla = [];


    if (preg_match_all('/([A-Za-z0-9\.\-_@])/', $value, $bla) >= 1) {

        $value = preg_replace('/([^A-Za-z0-9\.\-_@])/', '', $value);


        return $value;


    }

    return false;

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
function password_check($password)
{

    $data = file('data.txt');

    foreach ($data as $dbentry) {
        $possible_password = trim(substr($dbentry, 129, 128));


        if (password_verify($password, $possible_password) === true) {


            return $password;

        }


    }


}

function email_check($email)
{
    $data = file('data.txt');

    foreach ($data as $dbentry) {
        $possible_email = trim(substr($dbentry, 0, 127));


        if ($email === $possible_email) {


            return $email;

        }
    }


}


function login($email, $password)
{

    $data = file('data.txt');

    foreach ($data as $dbentry) {
        $possible_email = trim(substr($dbentry, 0, 127));


        if ($possible_email === $email) {

            $possible_password = trim(substr($dbentry, 129, 128));
            if ($possible_password) {


            }

            return password_verify($password, $possible_password);
        }
    }

    return false;

}


function delete()
{

    $data = file('data.txt');

    $delete = false;

    foreach ($data as $key => $dbentry) {


        $possible_email = $_SESSION ['email'];

        // $delete = str_replace($dbentry, $possible_email, '');


        if ($possible_email === trim(substr($dbentry, 0, 127))) {

            $data[$key] = '';
            $delete = true;

        }


    }

    if ($delete) {
        $newData = implode('', $data);
        file_put_contents('data.txt', $newData);
    }


}




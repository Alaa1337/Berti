<html>


<head>

    <title>BERICHTSHEFT</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="sheet.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>


    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>


</head>


<?php
error_reporting(-1);
ini_set('display_errors', 1);
session_start();

include __DIR__.'/template.php';
include __DIR__.'/db_functions.php';
require_once __DIR__.'/vendor/autoload.php';

opendb('berti.sqlite3');
init_db();

switch ($_GET['page']) {

    case 'login':
        $contentHeader = "Login";
        $content = $variables['login'];
        echo '<style>#loginbtn{background-color:#549eff; } </style>';
        break;

    case 'registrieren':
        $contentHeader = "Registrieren";
        $content = $variables['register'];
        echo '<style>#registerbtn{background-color:#549eff; } </style>';
        break;

    case 'impressum':
        $contentHeader = "Impressum";
        $content = $variables['impressum'];
        echo '<style>#impressumbtn{background-color:#549eff; } </style>';
        break;

    case 'settings':
        $contentHeader = "Einstellungen";
        $content = $variables['settings'];
        echo '<style>#settingsbtn{background-color:#549eff; } </style>';
        break;

    case 'datenschutz':
        $contentHeader = "Datenschutz";
        $content = $variables['datenschutz'];
        echo '<style>#datenschutzbtn{background-color:#549eff; } </style>';
        break;

    case 'berichtsheft':
        $contentHeader = "Berichtsheft";
        $content = $variables['berichtsheft'];
        echo '<style>#berichtsheftbtn{background-color:#549eff; } </style>';
        break;

    default :
        $contentHeader = "Willkommen";
        $content = $variables['start'];
        echo '<style>#startbtn{background-color:#549eff; } </style>';
        break;
}

if (isset($_POST['registerbutton'])) {

    if (check_username_free($_POST['email'])) {
        $_POST['email'] = strtolower($_POST['email']);

        add_user(
            strtolower($_POST['email']),
            $_POST['password'],
            ucwords(strtolower($_POST['firstname'])),
            ucwords(strtolower($_POST['lastname']))
        );

        password_check($_POST['email'], $_POST['password']);

        $transport = (new Swift_SmtpTransport('sslout.de', 465))
            ->setUsername('noreply@itspoon.com')
            ->setPassword('phpgf=8EZgp9BCdK')
            ->setTimeout(5)
            ->setAuthMode('plain')
            ->setEncryption('ssl');

        $mailer = new Swift_Mailer($transport);

        $message = (new Swift_Message('Wondefdsafdsrful Subject'))
            ->setFrom(['noreply@itspoon.com' => 'test'])
            ->setTo([$_POST['email'] => 'TEST'])
            ->setBody('http://berti/?page=verify&code='.getcode());


        $result = $mailer->send($message);
    }
}

if (isset($_POST['loginbutton'])) {
    $userpassword = $_POST['loginpassword'];
    $usermail = strtolower($_POST['loginmail']);
    login($usermail, $userpassword);

    if (login($usermail, $userpassword) === true) {
        $_SESSION ['logged_in'] = true;
        $_SESSION ['email'] = $usermail;
    }
}

if (array_key_exists('email', $_SESSION)) {
    checkverification($_SESSION['email']);
}

if (array_key_exists('page', $_GET)) {
    if ($_GET['page'] === 'logout') {

        session_destroy();
        header('Location: ?page=start');


    }



    if ($_GET['page'] === 'delete') {

        delete();

        $_GET['page'] = 'logout';

        session_destroy();


    }
}

correctpage();
verification();


?>


<body>

<div class="container">


    <div class="row">

        <?php

        include('content.php');

        ?>


        <?php

        include('menu.php');
        ?>

    </div>

</div>


<?PHP if (in_array($_SERVER['REMOTE_ADDR'], array("127.0.0.1", "10.0.0.126"))) { ?>
    <div id="responsiveinfo"></div>
<?PHP } ?>




</body>

</html>
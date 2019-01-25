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
ini_set("display_errors", 1);

 session_start();
//var_dump($_SESSION);


include __DIR__.'/template.php';
include __DIR__.'/db_functions.php';
require_once __DIR__.'/vendor/autoload.php';

opendb('berti.sqlite3');
init_db();





echo $test2;



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


//If Submit Button Is Clicked Do the Following


if (isset($_POST['registerbutton'])) {





    if (check_username_free($_POST['email'])) {



        add_user($_POST['email'], $_POST['password'], $_POST['firstname'], $_POST['lastname']);

        password_check($_POST['email'],$_POST['password']);


        $transport = (new Swift_SmtpTransport('sslout.de', 465))
            ->setUsername('noreply@itspoon.com')
            ->setPassword('phpgf=8EZgp9BCdK')
            ->setTimeout(5)
            ->setAuthMode('plain')
            ->setEncryption('ssl');

        $mailer = new Swift_Mailer($transport);

        $message = (new Swift_Message('Wonderful Subject'))
            ->setFrom(['noreply@itspoon.com' => 'test'])
            ->setTo([$_POST['email'] => 'TEST'])
            ->setBody('http://berti/?page=verify&code='.getcode());

        $result = $mailer->send($message);


    }




}


if (isset($_POST['loginbutton'])) {


    $userpassword = $_POST['loginpassword'];
    $usermail = $_POST['loginmail'];


    login($usermail, $userpassword);

    if (login($usermail, $userpassword) === true) {


        $_SESSION ['logged_in'] = true;
        $_SESSION ['email'] = $usermail;

    }


}
//var_dump ($_GET);
if (array_key_exists('page', $_GET)) {
    if ($_GET['page'] === 'logout') {

        session_destroy();
        header('Location: ?page=start');


    }

//var_dump($_POST);

    if ($_GET['page'] === 'delete') {

        delete();

        $_GET['page'] = 'logout';

        session_destroy();


    }
}
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


<script>
    function makeid() {
        var text = "";
        var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

        for (var i = 0; i < 20; i++)
            text += possible.charAt(Math.floor(Math.random() * possible.length));

        return text;
    }


    /*

        function spam() {


            const data = new FormData();

            data.append('firstname', makeid());
            data.append('lastname', makeid());
            data.append('email', makeid() + "@" + makeid() + ".com\r\nbl💩a");

            data.append('password', makeid());
            data.append('registerbutton', 'registerbutton');

            axios({
                method: 'post',
                url: '/?page=registrieren',
                data: data,
                config: {headers: {'Content-Type': 'multipart/form-data'}}
            }).catch(function (error) {
                console.log(error);
            }).finally(function () {
                spam();
            });
        }


    */


</script>


</body>

</html>
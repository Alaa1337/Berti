
<html>


<head>
    <title>BERICHTSHEFT</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="sheet.css">
	
	
	
	
	
	
	
</head>


<?php
include __DIR__.'/template.php';


switch ($_GET['page']) {
    case 'login':
        $contentHeader = "Login";
        $content = $variables['login'];
		$var1 = '<h1> Login </h1>';
		echo '<style>#loginbtn{background-color:#549eff; } </style>';
        break;
    case 'registrieren':
        $contentHeader = "Registrieren";
        $content = $variables['register'];
		$var1 = '<h1> registrieren </h1>';
		echo '<style>#registerbtn{background-color:#549eff; } </style>';
        break;
	case 'impressum':
		$contentHeader = "Impressum";
		echo '<style>#impressumbtn{background-color:#549eff; } </style>';
		break;
	case 'datenschutz':
		$contentHeader = "Datenschutz";
		echo '<style>#datenschutzbtn{background-color:#549eff; } </style>';
		break;
    default:
        $contentHeader = "Willkommen";
        $content = $variables['start'];
		echo '<style>#startbtn{background-color:#549eff; } </style>';
        break;
}





?>



<body>

<div class="container">

    <div class="row">

	<?php
	
	include('menu.php');
	
	?>
	
	<?php
	
	include('content.php');
	
	?>
	
	</div>

</div>
	
</body>
</html>
<?php 
// copyright Jørn Guldberg - guld-berg.dk

require_once $_SERVER['DOCUMENT_ROOT']."/570304x/x530199.php"; // kernefilen
include $_SERVER['DOCUMENT_ROOT']."/".$sidenssti.$overmodul;
// Her tjekkes der om der skal laves  login felter, eller om brugeren er logget ind.
if(isset($_SESSION['login_user'])) {
    $loginFelt = '<form class="navbar-form navbar-right">
            <span style="color: blue;"> Du er logget ind som: '.$_SESSION['login_user'].'</span> 
            <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Min Menu<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="/570104z/index">Kontrolpanel</a></li>
            <li><a href="/logud.php">Log ud</a></li>
          </ul>
        </li></form>';
    }
else {
    $loginFelt = '
    <form class="navbar-form navbar-right">
            <div class="form-group">
              <input type="text" id="brugernavn" placeholder="Brugernavn" class="form-control">
            </div>
            <div class="form-group">
              <input type="password" id="password" placeholder="Password" class="form-control">
            </div>
            <button data-toggle="popover" data-placement="bottom" title="Fejl i login" data-content="Brugernavn eller password forkert." type="submit" id="denskalvirke" class="btn btn-default">Login</button>
          </form>'; 
}
?>
<!DOCTYPE html>
<html lang="da-DK">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title><?php echo $sidenstitel;?></title>
<meta name="description" content="sample"/>
<meta name="robots" content="noodp"/>
<link rel="canonical" href="https://www.guld-berg.dk" />
<meta property="og:locale" content="da-DK" />
<meta property="og:type" content="website" />
<meta property="og:title" content="sample" />
<meta property="og:description" content="sample" />
<meta property="og:url" content="https://www.guld-berg.dk" />
<meta property="og:site_name" content="sample" />
<meta property="og:image" content="https://www.guld-berg.dk" />
<meta name="twitter:card" content="summary" />
<meta name="twitter:description" content="sample" />
<meta name="twitter:title" content="sample" />
<meta name="twitter:image" content="https://www.guld-berg.dk" />
<link rel='dns-prefetch' href='//fonts.googleapis.com' />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="/570404v/style.css">
</head>
<body>
      <?php 
  require_once $_SERVER['DOCUMENT_ROOT']."/570904q/basicscript.php";
  ?>
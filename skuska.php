<?php
session_start();
include "Data.php";
include "IStorage.php";
include "DBStorage.php";
include "App.php";

$app = new App();
$result = $app->getAllArticleCycle('cyklistika');
$app->pagi();
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style.css" media="screen" />
    <script src="js/javaScript.js"></script>
    <title>eTuristika</title>
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/ajax.js"></script>
</head>
<body id="top">

<div id="network">


        <div class="left"><span id="dateUp"></span><span class="text-separator">|</span><span>Počet návštev: <?php echo $app->getCountOfVisitors(); ?></span> </div>
        <div class="right">
            <?php if(!isset($_SESSION['login_user'])) { ?>
            <ul class="tabbed" id="network-tabs">
                <li><a href="registration.php">Registrovat</a></li>
                <li><a href="login.php">Prihlasit</a></li>
            </ul>
            <?php } else { ?>
            <ul class="tabbed" id="network-tabs">
                <li><a href="logout.php">Odhlasit</a></li>
            </ul>
            <?php } ?>

            <div class="clearer">&nbsp;</div>

        </div>

        <div class="clearer">&nbsp;</div>


</div>

<div id="site">
    <div class="center-wrapper">

        <div id="header">



            <div class="clearer">&nbsp;</div>

            <div id="site-title">

                <h1><a href="#">eTuristika</a> <span> / Aktuality</span></h1>

            </div>

            <div id="navigation">

                <div id="main-nav">

                    <ul class="tabbed">
                        <li><a href="index.php">News</a></li>
                            <li class="current-tab"><a href="cyklistika.php?sekcia=1">Cyklistika</a></li>
                            <li><a href="autoTuristika.php?sekcia=2">Auto turistika</a></li>
                            <li><a href="cestnaTuristika.php?sekcia=3">Cestná turistika</a></li>

                        <li><a href="galeria.php">Galeria</a></li>
                    </ul>

                    <div class="clearer">&nbsp;</div>

                </div>

                <div id="sub-nav">

                    <ul class="tabbed">
                        <?php if(isset($_SESSION['login_user'])) { ?>
                            <li><a href="userArticles.php">Moje články</a></li>
                            <li><a href="pridajClanok.php">Pridať článok</a></li>
                        <?php } ?>
                    </ul>

                    <div class="clearer">&nbsp;</div>

                </div>

            </div>

        </div>

        <div class="main">

            <div class="loading-div"></div>
            <div id="results"><!-- content will be loaded here --></div>


            <div class="clearer">&nbsp;</div>

        </div>

        <div id="dashboard">

            <div class="column left" id="column-1">

                <div class="column-content">

                    <div class="column-title">Adresa</div>

                    <ul class="nice-list">
                        <li>Zilina</li>
                        <li>Národna 1452</li>
                        <li>010 01</li>
                    </ul>

                </div>

            </div>

            <div class="column left" id="column-2">

                <div class="column-content">

                    <div class="column-title">Sleduj nás</div>

                    <ul class="plain-list">
                        <li><a href="https://www.facebook.com/" class="feed">Facebook</a></li>
                        <li><a href="https://twitter.com/" class="feed">Twitter</a></li>
                        <li><a href="https://azet.sk/" class="feed">Azet</a></li>
                        <li><a href="https://www.instagram.com/" class="feed">Instagram</a></li>
                    </ul>

                </div>

            </div>

            <div class="column left" id="column-3">

                <div class="column-content">

                    <div class="column-title">Podpora</div>

                    <p>Neváhajte nás kontaktovať s problémami.</p>

                    <p>Email: podpora@turistika.com</p>

                </div>

            </div>

            <div class="column right" id="column-4">

                <div class="column-content">

                    <div class="column-title">Kontaktuj nás</div>

                    <p>Tel. čislo: +421944591101<br/>Email: turistika@slovensko.sk</p>


                </div>

            </div>

            <div class="clearer">&nbsp;</div>

        </div>
    </div>
</div>

</body>
</html>
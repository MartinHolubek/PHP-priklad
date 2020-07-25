<?php
session_start();
include "Data.php";
include "IStorage.php";
include "DBStorage.php";
include "App.php";

$app = new App();
$result = $app->getAllArticleCycle('cestna');
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style.css" media="screen" />
    <script src="js/javaScript.js"></script>
    <title>eTuristika</title>
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
                        <li><a href="cyklistika.php">Cyklistika</a></li>
                        <li><a href="autoTuristika.php">Auto turistika</a></li>
                        <li class="current-tab"><a href="cestnaTuristika.php">Cestná turistika</a></li>
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
            <?php
            if(!isset($_GET['clanok'])){
            $i = 1;
            while($row = $result->fetch_array()){
                ?>
                <div class="post">

                    <div class="post-title"><h2><?php echo $row['Nadpis'] ?></h2></div>

                    <div class="post-date">Datum pridania : <?php echo $row['Datum'] ?></div>

                    <div class="post-body">

                        <p><?php if(strlen($row['Popis']) > 260){
                            echo (substr($row['Popis'],1,260)) . "...";
                            } else {
                                echo $row['Popis'];
                            } ?>
                        </p>

                        <a href='cestnaTuristika.php?clanok=<?php echo $row['ID'] ?> ' class='more'>Read more &#187;</a>

                    </div>

                </div>

                <div class="content-separator"></div>
            <?php $i++; } ?>

            <div class="pagination" align="center">
                <br />

                <?php $app->showPagination('cestna') ?>
            </div>

            <?php } else { $app->incCountOfVisitors($_GET['clanok']); ?>
                <div class="post">

                    <a href='cestnaTuristika.php' class='back'>&#171 Späť</a>

                    <div class="post-title"><h2><?php echo $app->selectArticleID($_GET['clanok'])->nazov; ?></h2></div>

                    <div class="post-date">Datum pridania : <?php echo $app->selectArticleID($_GET['clanok'])->datum; ?></div>

                    <div class="post-body">

                        <p><?php echo $app->selectArticleID($_GET['clanok'])->popis; ?></p>

                    </div>

                </div>
            <?php } ?>

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
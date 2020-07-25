<?php
session_start();
include "Data.php";
include "IStorage.php";
include "DBStorage.php";
include "App.php";

$app = new App();
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" type="text/css" href="style.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="gallery.css" media="screen" />
    <script src="js/javaScript.js"></script>
    <script src="js/javaScriptGallery.js"></script>
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
                        <li><a href="cestnaTuristika.php">Cestná turistika</a></li>
                        <li class="current-tab"><a href="galeria.php">Galeria</a></li>
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
            <div id="myBtnContainer">
                <button class="btn active" onclick="filterSelection('all')"> Zobraz všetky</button>
                <button class="btn" onclick="filterSelection('cycle')"> Cyklistika</button>
                <button class="btn" onclick="filterSelection('cars')"> Auto Turistika</button>
                <button class="btn" onclick="filterSelection('trail')"> Cestna Turistika</button>
            </div>

            <!-- Portfolio Gallery Grid -->
            <div class="row">
                <div class="column cycle">
                    <div class="content">
                        <img src="img/downhill.jpg" alt="Mountains" style="width:100%">
                        <h4>Sutaz Skoda</h4>
                        <p>Sútaž na polom</p>
                    </div>
                </div>
                <div class="column cycle">
                    <div class="content">
                        <img src="img/tatry.jpg" alt="Lights" style="width:100%">
                        <h4>Stranavy</h4>
                        <p>dobrá cesta</p>
                    </div>
                </div>
                <div class="column cycle">
                    <div class="content">
                        <img src="img/downhill3.jpg" alt="Nature" style="width:100%">
                        <h4>Tatry okruh</h4>
                        <p>skupinka ludí jazdí okolo tatier</p>
                    </div>
                </div>

                <div class="column cars">
                    <div class="content">
                        <img src="img/auto-turistika.jpg" alt="Car" style="width:100%">
                        <h4>Afrika</h4>
                        <p>Šialený dobrodruh</p>
                    </div>
                </div>
                <div class="column cars">
                    <div class="content">
                        <img src="img/strom.jpg" alt="Car" style="width:100%">
                        <h4>Zapad slnka</h4>
                        <p>Scenéria kde zavadzia strom</p>
                    </div>
                </div>
                <div class="column cars">
                    <div class="content">
                        <img src="img/autokemp.jpg" alt="Car" style="width:100%">
                        <h4>Zraz veteránov</h4>
                        <p>Nedaleko Žiliny sa konal autokemp.</p>
                    </div>
                </div>

                <div class="column trail">
                    <div class="content">
                        <img src="img/luka.jpg" alt="Trail" style="width:100%">
                        <h4>Luka nad opavou</h4>
                        <p>Začiatok mája</p>
                    </div>
                </div>
                <div class="column trail">
                    <div class="content">
                        <img src="img/jazero.jpg" alt="Trail" style="width:100%">
                        <h4>pleso</h4>
                        <p>Pleso na Slovensku</p>
                    </div>
                </div>
                <div class="column trail">
                    <div class="content">
                        <img src="img/turi.jpg" alt="Trail" style="width:100%">
                        <h4>Zapadné Tatry</h4>
                        <p>Vyhlad na zapadne tatry. Poľsko</p>
                    </div>
                </div>
                <!-- END GRID -->
            </div>


            <div class="clearer"></div>
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
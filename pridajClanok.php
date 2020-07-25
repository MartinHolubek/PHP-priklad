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
    <link rel="stylesheet" type="text/css" href="style.css" media="screen" />
    <script src="js/javaScript.js"></script>
    <title>Prihlasenie</title>
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/ajax.js"></script>
</head>

<body id="top">

<div id="network">
    <div class="right">
        <!--kontroluje ci je uzivatel prihlaseny ak ano zobrazi button "registracia" -->
    <?php if(!isset($_SESSION["login_user"])){ ?>
        <ul class="tabbed" id="network-tabs">
            <li><a href="registration.php">Registrovat</a></li>
        </ul>
    <?php } else {  ?>
        <ul class="tabbed" id="network-tabs">
            <li><a href="logout.php">Odhlasit</a></li>
        </ul>
        <?php } ?>
        <div class="clearer">&nbsp;</div>

    </div>

	<div class="center-wrapper">

        <div class="left"><span id="dateUp"></span><span class="text-separator">|</span><span>Počet návštev: <?php echo $app->getCountOfVisitors(); ?></span> </div>
		<div class="right">



			<div class="clearer">&nbsp;</div>

		</div>

		<div class="clearer">&nbsp;</div>

	</div>
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
						<li><a href="index.php">Späť</a></li>
					</ul>

					<div class="clearer">&nbsp;</div>

				</div>

				<div id="sub-nav">

					<ul class="tabbed">
                        <li><a href="userArticles.php">Moje články</a></li>
                        <li class="current-tab"><a href="pridajClanok.php">Pridať článok</a></li>
					</ul>

					<div class="clearer">&nbsp;</div>

				</div>

			</div>

		</div>

		<div class="main">

            <div class="center">
                <?php if(!isset($_SESSION['successInsert'])) { ?>
                    <h2>Tu môžte pridať článok podľa kategorii</h2>
                    <!-- <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  -->
                        <label><p>Nadpis</p> <input type="text" id="nadpis" name="nadpis" ></label>
                        <br><br>
                        <label><input type="radio" id="sekcia" name="sekcia" value="cyklistika" checked> Cyklistika</label>
                        <br>
                        <label><input type="radio" id="sekcia" name="sekcia" value="cestna" checked> Cestná turistika</label>
                        <br>
                        <label><input type="radio" id="sekcia" name="sekcia" value="auto" checked> Auto turistika</label>
                          
                        <br><br>
                        <label><p>Obsah článku</p><textarea name="popis" id="popis" rows="5" cols="40" value="Obsah clanku"></textarea></label>
                          
                        <br><br>

                        <input class="button" id="send" type="submit" name="saveArticle" value="uloziť">
                        <br><br>

                   <!-- </form> -->


                <?php } else { ?>
                    <div class="info-text">Článok bol pridaný do sekcie</div>
                    <div class="info-text"><a href="pridajClanok.php">Pridať článok</a></div>

                <?php  unset($_SESSION['successInsert']);} ?>

            </div>


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

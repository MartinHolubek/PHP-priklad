<?php
include "reg.php";
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
    <title>Registracia</title>

</head>

<body id="top">

<div id="network">
    <div class="left"><span id="dateUp"></span><span class="text-separator">|</span> <span>Počet návštev: <?php echo $app->getCountOfVisitors(); ?></span></div>
    <div class="right">
        <!--kontroluje ci je uzivatel prihlaseny ak ano zobrazi button "odhlasit" -->
        <?php if(isset($_SESSION['login_user'])) { ?>
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
						<li><a href="index.php">Späť</a></li>
                        <li class="current-tab"><a>Registracia</a></li>
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

            <div class="center">
                <?php if(!isset($_SESSION['login_user'])) { ?>
                <h2>Registracia na stranke eTuristika</h2>
                <!-- <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  -->

                      <label>Meno: <input type="text" id="meno" name="meno" value="<?php echo $meno;?>"></label>
                      <span class="errorForm"> <?php echo $nameErr;?></span>
                      <br><br>
                      <label>Heslo: <input type="password" id="heslo" name="heslo" value="<?php echo $heslo;?>"></label>
                      <span class="errorForm"> <?php echo $hesloErr;?></span>
                      <br><br>
                      <label>E-mail: <input type="text" id="email" name="email" value="<?php echo $email;?>"></label>
                      <span class="errorForm"> <?php echo $emailErr;?></span>
                      <br><br>
                      <label>Niečo o tebe:<textarea name="popis" id="popis" rows="5" cols="40" value="ahoj"></textarea></label>
                      <span class="errorForm"> <?php echo $popisErr;?></span>
                      <br><br>

                      <input class="button" id="send" type="submit" name="submit" value="Odoslat">
                      <br><br>
                        <div class="infoText">
                            <?php if(isset($_SESSION['user_exist'])){echo "takyto uzivatel je uz zaregistrovany";
                                unset($_SESSION['user_exist']); } ?>

                        </div>

                <!-- </form> -->

                <?php } else { ?>
                <h2>Uspešne ste sa zaregistrovali. Ste prihlásený</h2>
                <?php       } ?>

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

		<div id="footer">

			<div class="left">&copy; 2017 Simple Magazine <span class="text-separator">&rarr;</span> <a href="#">Home</a> <span class="text-separator">|</span><a href="#">News</a> <span class="text-separator">|</span> <a href="#">Politics</a> <span class="text-separator">|</span> <a href="#">Culture</a> <span class="text-separator">|</span> <a href="#">Sport</a> <span class="text-separator">|</span> <a href="#">Debate</a> <span class="text-separator">|</span> <a href="#">Entertainment</a></div>
			

			<div class="clearer">&nbsp;</div>

		</div>

	</div>
</div>

</body>
</html>

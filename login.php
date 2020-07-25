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

</head>

<body id="top">

<div id="network">
    <div class="left"><span id="dateUp"></span><span class="text-separator">|</span><span>Počet návštev: <?php echo $app->getCountOfVisitors(); ?></span> </div>
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
                        <li class="current-tab"><a>Prihlasenie</a></li>
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
                <h2>Prihlasenie na stranke eTuristika</h2>
                 <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

                      <label> <p>Meno:</p> <input type="text" name="meno" ></label>
                      
                      <br><br>
                      <label> <p>Heslo:</p> <input type="password" name="heslo" ></label>
                      <br><br>
                      

                      
                      <br><br>
                        <div class="infoText">
                            <?php
                                if(isset($_SESSION['user_not_exist'])){echo "takyto uzivatel neexistuje";
                                unset($_SESSION['user_not_exist']); }

                                if(isset($_SESSION['password_incorrect'])){echo "neplatne heslo";
                                unset($_SESSION['password_incorrect']);}
                            ?>



                        </div>
                        <input class="button" type="submit" name="login" value="Prihlasit">
                </form>



                <?php } else { ?>



                    <a class="center" href="index.php"><h2>Uvodna Stranka</h2></a>
                <?php } ?>
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

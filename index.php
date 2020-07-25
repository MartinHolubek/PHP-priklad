<?php
session_start();
include "Data.php";
include "IStorage.php";
include "DBStorage.php";
include "App.php";

$app = new App();
if(!isset($_SESSION['counter'])){
    $app->counter();
}

$resultMostViewed = $app->selectMostViewed();
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
            <?php if(!isset($_SESSION['login_user'])) {  ?>
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
                        <li class="current-tab"><a href="index.php">News</a></li>
                        <li><a href="cyklistika.php?sekcia=1">Cyklistika</a></li>
                        <li><a href="cyklistika.php?sekcia=2">Auto turistika</a></li>
                        <li><a href="cyklistika.php?sekcia=3">Cestná turistika</a></li>
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

        <div class="main" id="main-three-columns">

            <div class="left" id="main-left">

                <div class="post">

                    <div class="post-title"><h2><a href="#"><?php echo $app->selectArticle(1)->nazov; ?></a></h2></div>

                    <div class="post-date"><?php echo $app->selectArticle(1)->datum; ?></div>

                    <div class="post-body">

                        <p><?php echo $app->selectArticle(1)->popis; ?></p>
                        <?php if($app->selectArticle(1)->sekcia === 'cyklistika') { ?>
                            <a href='cyklistika.php?clanok=<?php echo $app->selectArticle(1)->idClanku; ?>' class="more">Read more &#187;</a>
                        <?php } else if($app->selectArticle(1)->sekcia === 'auto') { ?>
                            <a href='autoTuristika.php?clanok=<?php echo $app->selectArticle(1)->idClanku; ?>' class="more">Read more &#187;</a>
                        <?php } else if($app->selectArticle(1)->sekcia === 'cestna') { ?>
                            <a href='cestnaTuristika.php?clanok=<?php echo $app->selectArticle(1)->idClanku; ?>' class="more">Read more &#187;</a>
                        <?php } ?>



                    </div>

                </div>

                <div class="content-separator"></div>

                <div class="col3 left">
                    <div class="column-content">

                        <div class="post">
                            <h4><a href="#"><?php echo $app->selectArticle(2)->nazov ?></a></h4>
                            <div class="post-date"><?php echo $app->selectArticle(2)->datum; ?></div>
                            <p><?php echo $app->selectArticle(2)->popis; ?></p>
                            <?php if($app->selectArticle(2)->sekcia === 'cyklistika') { ?>
                                <a href='cyklistika.php?clanok=<?php echo $app->selectArticle(2)->idClanku; ?>' class="more">Read more &#187;</a>
                            <?php } else if($app->selectArticle(2)->sekcia === 'auto') { ?>
                                <a href='autoTuristika.php?clanok=<?php echo $app->selectArticle(2)->idClanku; ?>' class="more">Read more &#187;</a>
                            <?php } else if($app->selectArticle(2)->sekcia === 'cestna') { ?>
                                <a href='cestnaTuristika.php?clanok=<?php echo $app->selectArticle(2)->idClanku; ?>' class="more">Read more &#187;</a>
                            <?php } ?>
                        </div>

                    </div>
                </div>

                <div class="col3 col3-mid left">
                    <div class="column-content">

                        <div class="post">
                            <h4><a href="#"><?php echo $app->selectArticle(3)->nazov ?></a></h4>
                            <div class="post-date"><?php echo $app->selectArticle(3)->datum; ?></div>
                            <p><?php echo $app->selectArticle(3)->popis; ?></p>
                            <?php if($app->selectArticle(3)->sekcia === 'cyklistika') { ?>
                                <a href='cyklistika.php?clanok=<?php echo $app->selectArticle(3)->idClanku; ?>' class="more">Read more &#187;</a>
                            <?php } else if($app->selectArticle(3)->sekcia === 'auto') { ?>
                                <a href='autoTuristika.php?clanok=<?php echo $app->selectArticle(3)->idClanku; ?>' class="more">Read more &#187;</a>
                            <?php } else if($app->selectArticle(3)->sekcia === 'cestna') { ?>
                                <a href='cestnaTuristika.php?clanok=<?php echo $app->selectArticle(3)->idClanku; ?>' class="more">Read more &#187;</a>
                            <?php } ?>
                        </div>

                    </div>
                </div>

                <div class="col3 right">
                    <div class="column-content">

                        <div class="post">
                            <h4><a href="#"><?php echo $app->selectArticle(4)->nazov ?></a></h4>
                            <div class="post-date"><?php echo $app->selectArticle(4)->datum; ?></div>
                            <p><?php echo $app->selectArticle(4)->popis; ?></p>
                            <?php if($app->selectArticle(4)->sekcia === 'cyklistika') { ?>
                                <a href='cyklistika.php?clanok=<?php echo $app->selectArticle(4)->idClanku; ?>' class="more">Read more &#187;</a>
                            <?php } else if($app->selectArticle(4)->sekcia === 'auto') { ?>
                                <a href='autoTuristika.php?clanok=<?php echo $app->selectArticle(4)->idClanku; ?>' class="more">Read more &#187;</a>
                            <?php } else if($app->selectArticle(4)->sekcia === 'cestna') { ?>
                                <a href='cestnaTuristika.php?clanok=<?php echo $app->selectArticle(4)->idClanku; ?>' class="more">Read more &#187;</a>
                            <?php } ?>
                        </div>

                    </div>
                </div>

                <div class="clearer">&nbsp;</div>

            </div>

            <div class="left sidebar" id="sidebar-1">

                <div class="post">

                    <h2>Cyklistika</h2>
                    <h2>Najnovší článok</h2>
                    <div class="content-separator"></div>

                    <h3><?php echo $app->selectArticle(1,'cyklistika')->nazov ?></h3>

                    <p><?php echo $app->selectArticle(1,'cyklistika')->popis ?></p>
                    <a href="cyklistika.php?clanok=<?php echo $app->selectArticle(1,'cyklistika')->idClanku; ?>" class="more">Read more &#187;</a>

                </div>

                <div class="content-separator"></div>

                <div class="post">

                    <h2>Auto turistika</h2>
                    <h2>Najnovší článok</h2>
                    <div class="content-separator"></div>

                    <h3><?php echo $app->selectArticle(1,'auto')->nazov ?></h3>

                    <p><?php echo $app->selectArticle(1,'auto')->popis ?></p>
                    <a href="autoTuristika.php?clanok=<?php echo $app->selectArticle(1,'auto')->idClanku; ?>" class="more">Read more &#187;</a>

                </div>

                <div class="content-separator"></div>

                <div class="post">

                    <h2>Cestná turistika</h2>
                    <h2>Najnovší článok</h2>
                    <div class="content-separator"></div>

                    <h3><?php echo $app->selectArticle(1,'cestna')->nazov ?></h3>

                    <p><?php echo $app->selectArticle(1,'cestna')->popis ?></p>
                    <a href="cestnaTuristika.php?clanok=<?php echo $app->selectArticle(1,'cestna')->idClanku; ?>" class="more">Read more &#187;</a>

                </div>

            </div>


            <div class="right sidebar" id="sidebar-2">

                <div class="section">

                    <div class="section-title">Najčitanejšie</div>

                    <div class="section-content">

                        <ul class="nice-list">
                           <?php $i = 1; while($row = $resultMostViewed->fetch_object()) {
                               if($row->Sekcia === 'cyklistika'){
                                   echo "<li>
                                            <span class=\"quiet\">{$i}</span>
                                            <a href=\"cyklistika.php?clanok={$row->ID}\">{$row->Nadpis}</a><br>
                                            {$row->pocet_navstev} zhliadnutí
                                         </li>";
                               } else if($row->Sekcia === 'auto'){
                                   echo "<li>
                                            <span class=\"quiet\">{$i}</span>
                                            <a href=\"autoTuristika.php?clanok={$row->ID}\">{$row->Nadpis}</a><br>
                                            {$row->pocet_navstev} zhliadnutí
                                         </li>";
                               } else if($row->Sekcia === 'cestna'){
                                   echo "<li>
                                            <span class=\"quiet\">{$i}</span>
                                            <a href=\"cestnaTuristika.php?clanok={$row->ID}\">{$row->Nadpis}</a><br>
                                            {$row->pocet_navstev} zhliadnutí
                                         </li>";
                               }
                                $i++;
                           } ?>

                        </ul>

                    </div>

                </div>

            </div>

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
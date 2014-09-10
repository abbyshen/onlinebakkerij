<?php
$gelukt = gebruikerservice::logincheck();
if ($gelukt == "loggedin") {
    $logged = "in";
} else {
    $logged = "out";
}
?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta charset=utf-8>
        <link rel="stylesheet" href="css/stylesheetbakkerij.css">
        <title>over ons</title>
    </head>
    <body class="home">
        <header>
            <img src ="images/Vromans.bmp" alt="bakkerij vromans" id="logobakkerij">
            <?php if ($logged == "out") {
                ?>
                <form method="post" action="process_login.php?action=inloggen" id="inlogform">
                    <table>
                        <tr>
                            <td>emailadres:</td>
                            <td>
                                <input type="text" name="email" />
                            </td>
                        </tr>
                        <tr>
                            <td>wachtwoord:</td>
                            <td>
                                <input type="password" name="p" />
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <input type="submit" value="inloggen" />
                            </td>
                        </tr>
                    </table>
                    <a href="aanmelden.php"> aanmelden </a>
                </form>

            <?php } if ($logged == "in") { ?><h2 id="logout"><a href="logout.php">log out</a></h2><?php }
            ?>
            <div id="headercontainer">
                <nav id="kopnav">
                    <ul id="hoofdmenu">
                        <li><a href="home.php">home</a></li>
                        <li><a href="assortiment.php">ons assortiment</a></li>
                        <li><a href="overons.php">over ons</a></li>
                        <?php if ($logged == "in") {
                            ?><li><a href="mijnprofiel.php">mijn profiel</a></li>
                            <li><a href="bestellingopnemen.php">bestellen</a></li><?php }
                        ?>
                        <?php if ($logged == "out") {
                            ?><li>mijn profiel</li>
                            <li>bestellen</li><?php }
                        ?>
                    </ul>
                </nav>
            </div>
        </header>
        <h1 id="hoofd">over ons</h1>
        <section>
            <div id="wie">
                <h3>wie</h3>
                <div id="soortdeel">
                    <p>ik ben niels vroman en bakker in Bavikhove (Harelbeke). </p>
                </div>
            </div>
            <div id="wat">
                <h3>wat</h3>
                <div id="soortdeel">
                    <p>bakkerij vroman!</p> <p>we zijn elke dag van de week open en staan klaar voor u het beste van het beste te geven.</p>
                    <p>elke dag vers brood die u besteld heeft of en in de bakkerij komt afhalen of in de winkel zelf.</p>
                    <p>als u inlogd kan u <a href="bestellingopnemen.php">hier</a> bestellen indien u nog moet aanmelden druk op aanmelden maak een account en bestel!</p>
                    <p>u kan enkel bestellen voor morgen, overmorgen of voor binnen 3 dagen.</p>
                    <p>on assortiment vind u <a href="assortiment.php">hier</a>.</p>
                </div>
            </div>
            <div id="waar">
                <h3>waar</h3>
                <div id="soortdeel">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2517.2866601320816!2d3.316514599999991!3d50.881404599999904!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c33bfde33c50a3%3A0xb596d46666a0b93a!2sKorenstraat%2C+8531+Harelbeke!5e0!3m2!1snl!2sbe!4v1410350570790" width=100% height="450" frameborder="0" style="border:0"></iframe>
                </div>
            </div>
        </section>
        <footer>
            <article id="footer1">
                <h3>Bakkerij vroman</h3>
                <p>korenstraat 6  </p>
                <p>8531 Bavikhove</p>
                <p>tel:0494906333</p>
                <p>email:niels.vroman@hotmail.com</p>
            </article>
            <article id="footer2">
                <h3>alle dagen open:</h3>
                <p>maandag tem vrijdag: 7u30 - 18u30</p>
                <p>zaterdag           : 8u30 - 17u30</p>
                <p>zondag             : 7u30 - 12u30</p>
            </article>
        </footer>
    </body>
</html>


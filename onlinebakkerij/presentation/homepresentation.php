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
        <meta charset=utf-8 />
        <link rel="stylesheet" href="css/stylesheetbakkerij.css">
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
        <div id="inhoud" class="container">
            <img src="images/homeafb1edit1.png" alt="pistoles" id="topimage"/>
            <section id ="welkom">
                <h1>welkom bij bakkerij vroman!</h1>
                <img src="images/homeafb1edit2.png" alt="pistoles" id="bottomimage"/>
            </section>
            <section id="nieuwassortiment">
                <h3>nieuw in ons assortiment:cupcakes</h3>
                <div id="lijstnieuweproducten">
                    <?php
                    foreach ($productenLijst as $product) {
                        ?><p><?php
                            print($product->getNaam());
                            print(":      ");
                            print($product->getPrijs());
                            print("€");
                            ?></p><?php
                    }
                    ?>
                </div>
                <img src="images/cupcakes.jpg" alt="cupcakes" id="cupcakes"/>
            </section>
            <section id="bestellen">
                <h3>bestellen?</h3>
                <p>om je bestelling te plaatsen gelieve je aan te melden en in te loggen</p>
                <p>als je ingelogd bent. Dan kan je naar bestelling gaan! en uw bestelling plaatsen</p>
                <p>of klik <a href="bestellingopnemen.php">hier</a> en ga naar bestelling (enkel als je ingelogd bent)</p>
            </section>
        </div>
        <footer>
            <article id="footer1">
                <h3>Bakkerij vroman</h3>
                <p>blablastraat 6  </p>
                <p>8623 bakkersgemeente</p>
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
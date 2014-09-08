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
        <title>assortiment</title>
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
        <h1 id="hoofd">assortiment</h1>
        <div id="assortiment">
            <?php
            foreach ($soortenLijst as $soort) {
                ?>
                <div id="soort">
                    <h3> <?php print($soort->getOmschrijving()); ?> </h3> <?php
                    $productLijst = $productenSvc1->getproductenpersoort($soort->getId());
                    foreach ($productLijst as $product) {
                        $Pnaam = $product->getNaam();
                        ?><div id="soortdeel"><h4><?php print($Pnaam); ?></h4>
                            <p><?php
                                print($product->getPrijs());
                                print("€");
                                ?></p>
                        </div>
                    <?php }
                    ?></div><?php
            }
            ?>
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


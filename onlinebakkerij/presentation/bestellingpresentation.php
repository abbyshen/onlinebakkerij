<?php
$name = 0;
$gelukt = gebruikerservice::logincheck();
if ($gelukt == "loggedin") {
    $logged = "in";
} else {
    $logged = "out";
    header("location:process_login.php");
}
?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta charset=utf-8 />
        <link rel="stylesheet" href="css/stylesheetbakkerij.css">
        <title>bakkerij vroman</title>
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
        <section>
            <h1>bestel hier</h1>
            <h3>schrijf onder hetgeen u wil het aantal dat u wil.</h3>
            <form method="post" action="bestellingopnemen.php?action=bestellingfase1&aantalarray=<?php $aantalarray ?>">
                <?php
                if (isset($error) and $error == "datumalingebruik") {
                    ?> <p id="error"><?php print("u heeft op die datum al iets bestelt, ga naar mijn profiel om het te bekijken"); ?></p><?php
                }
                if (isset($error) and $error == "geenveldeningevult") {
                    ?> <p id="error"><?php print("u heeft een veld verkeerd ingevuld gelieve enkel bij de producten die u wil het cijfer te veranderen");?></p><?php
                }
                foreach ($soortenLijst as $soort) {
                    
                    ?><div id="soort"> <h3> <?php print($soort->getOmschrijving()); ?> </h3> <?php
                    $productLijst = $productenSvc1->getproductenpersoort($soort->getId());
                    foreach ($productLijst as $product) {
                       ?> <div class="soortdeel"><?php
                        $Pnaam = $product->getNaam();
                        $Pid = ($productenSvc1->productidmetnaam($Pnaam));?>
                           <h4><?php print($Pnaam); ?></h4>
                            <p><?php print($product->getPrijs()); ?></p>
                            <input type="text" value="0" name="aantal<?php echo $Pid ?>">
                            </div>
                    <?php
                    }?></div><?php
                }
                ?>
                <p></p>
                <select name="datum" id="selectdatum">
                    <option value="morgen">Morgen</option>
                    <option value="overmorgen">Overmorgen</option>
                    <option value="3dagen">binnen 3 dagen</option>
                </select>
                <input type="submit" value="bestel!" id="selectdatum">
            </form>
        </section>
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

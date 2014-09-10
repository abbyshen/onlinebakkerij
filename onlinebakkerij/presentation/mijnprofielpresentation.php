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
            <?php if ($logged == "in") { ?><h2 id="logout"><a href="logout.php">log out</a></h2><?php }
            ?>
            <div class="headercontainer">
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
            <h1 id="hoofd"> mijn profiel</h1>
            <div id="gegevensenpass">
                <section id="mijngegevens">
                    <form method="post" action="mijnprofiel.php?action=updateprofiel" id="formupdate">
                        <h3>mijn gegevens:</h3>
                        <table>
                            <tr>
                                <td>naam:</td>
                                <td>
                                    <input type="text" name="txtNaam" value="<?php echo($naam) ?>" />
                                </td>
                            </tr>
                            <tr>
                                <td>voornaam:</td>
                                <td>
                                    <input type="text" name="txtVoornaam" value="<?php echo($voornaam) ?>" />
                                </td>
                            </tr>
                            <tr>
                                <td>telefoonnummer:</td>
                                <td>
                                    <input type="text" name="txtTelefoonnummer" value="<?php echo($telefoonnummer) ?>" />
                                </td>
                            </tr>
                            <tr>
                                <td>woonplaats:</td>
                                <td>
                                    <input type="text" name="txtWoonplaats" value="<?php echo($woonplaats) ?>" />
                                </td>
                            </tr>
                            <tr>
                                <td>postcode:</td>
                                <td>
                                    <input type="text" name="txtPostcode" value="<?php echo($postcode) ?>" />
                                </td>
                            </tr>
                            <tr>
                                <td>straat:</td>
                                <td>
                                    <input type="text" name="txtStraat" value="<?php echo($straat) ?>" />
                                </td>
                            </tr>
                            <tr>
                                <td>nummer:</td>
                                <td>
                                    <input type="text" name="txtNummer" value="<?php echo($nummer) ?>" />
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <input type="submit" value="aanpassen" />
                                </td>
                            </tr>
                        </table>
                    </form>
                </section>
                <section id="mijnpass">
                    <h3>mijn wachtwoord:</h3>
                    <?php
                        if ($error == "foutinw8woord") {
                            ?> <p id="error"><?php print("uw nieuw wachtwoord is hetzelfde als uw oud dit mag niet");?></p><?php
                        }
                        if ($error == "foutinw8woord12") {
                            ?> <p id="error"><?php print("wachtwoord 1 en wachtwoord 2 zijn niet gelijk");?></p><?php
                        }
                        if ($error == "foutinoudw") {
                            ?> <p id="error"><?php print("uw oude wachtwoord is niet correct");?></p><?php
                        }
                        ?>
                    <form method="post" action="mijnprofiel.php?action=updatewachtwoord" id="formpass">
                        
                        <label>nieuw wachtwoord:</label><input type="password" name="nieuwwachtwoord1"/>
                        <label>nieuw wachtwoord:</label><input type="password" name="nieuwwachtwoord2"/>
                        <label>huidig wachtwoord:</label><input type="password" name="oudwachtwoord"/>
                        <input type="submit" value="wachtwoord veranderen" />
                    </form>
                </section>
            </div>
            <section id="bestellingen">
                
                    <p></p>
                    <?php
                    if ($maxbestellingen == 0) {
                        print("er zijn geen bestellingen voor de volgende 3 dagen");
                    } else {
                        while ($j < $maxbestellingen) {
                            $datum = $bestellingen[$j]->getDatum();
                            $datetime = new DateTime();
                            $datetime->format('Y-m-d');
                            $date = $datetime->format('Y-m-d');
                            $datetime->modify('+1 day');
                            $date1 = $datetime->format('Y-m-d');
                            $datetime->modify('+1 day');
                            $date2 = $datetime->format('Y-m-d');
                            $datetime->modify('+1 day');
                            $date3 = $datetime->format('Y-m-d');
                            if ($datum == $date or $datum == $date1 or $datum == $date2 or $datum == $date3) {
                                ?><form method="post" id="eenbestelling" action="mijnprofiel.php?action=bestellingverwijderen&datum=<?php echo ("$datum") ?>"> <?php
                                    $aantalarray = unserialize($bestellingen[$j]->getAantal());
                                    ?><h3><?php print("bestelling:");
                                        print($j + 1);?></h3><?php
                                    while ($i <= $maxaantal) {
                                        if ($aantalarray[$i] != 0) {
                                            $productnaam = $productsvc->productnaammetid($i);
                                            $productprijs = $productsvc->productprijsmetid($i);
                                            $prijs = $productprijs * $aantalarray[$i];
                                            ?><h4>artikelnaam : <?php echo $productnaam ?></h4><p>aantal: <?php echo $aantalarray[$i] ?></p> <p>prijs: <?php echo $prijs ?>€</p>
                                            <?php
                                        }
                                        $i++;
                                    }
                                    print("datum afhalen: ");
                                    print($datum);
                                    ?><p></p><?php
                                    if ($datum == $date) {
                                        print("deze bestelling kan u niet meer anuleren");
                                    } else {
                                        ?><p></p><input type="submit" value="bestelling annuleren" /> <?php } ?>
                                </form><?php
                            } else {
                                bestellingservice::bestellingverwijderen($datum, $_SESSION["gebruikerid"]);
                            }
                            $j++;
                            $i = 1;
                        }
                    }
                    ?>

            </section>
        </div>
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
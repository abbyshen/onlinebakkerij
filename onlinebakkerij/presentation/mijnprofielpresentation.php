<?php
?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta charset=utf-8 />

        <title>bakkerij vroman</title>
        <style>
            #hoofdmenu {
                list-style: none;
                font-size: 0.875em; /* 14px = 1em */
                font-weight: bold;
                padding: 0; /* 0.5em = 6px */
                margin: 0 1em;
                width:auto;
            }
            #hoofdmenu li:nth-child(1n+0) {
                width: 16.4%;
                padding:0.3em 0;
                border-top: 1px solid LavenderBlush;
                border-right: 1px solid LavenderBlush;
                border-bottom: none;
                border-left: none;
                text-align: center;
            }
            #hoofdmenu li:first-child {
                border-left:1px solid LavenderBlush;
            }
            #hoofdmenu a {
                display: inline;
                cursor: pointer;
            }
            #hoofdmenu li:hover {
                color:white;
                background-color:darkseagreen;
            }

        </style>
    </head>
    <body class="home">
        <header>
            <?php if ($logged == "in") { ?><h2><a href="logout.php">log out</a></h2><?php }
            ?>
            <div class="container">
                <h1><a href="home.php" id="logo">Bakkerij vroman</a></h1>
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
            <form method="post" action="mijnprofiel.php?action=updateprofiel">
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
            <form method="post" action="mijnprofiel.php?action=updatewachtwoord">
                
                <label>nieuw wachtwoord</label><input type="password" name="nieuwwachtwoord1">
                <label>nieuw wachtwoord</label><input type="password" name="nieuwwachtwoord2">
                <label>huidig wachtwoord<input type="password" name="oudwachtwoord1">
                <input type="submit" value="wachtwoord veranderen" />
            </form>
            
        </section>
    </body>
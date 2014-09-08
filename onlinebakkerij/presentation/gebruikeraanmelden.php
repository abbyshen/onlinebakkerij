<!DOCTYPE HTML>
<html>
    <head>
        <meta charset=utf-8>
        <link rel="stylesheet" href="css/stylesheetbakkerij.css">
        <title>aanmelden</title>

    </head>
    <body class="home">
        <header>
            <img src ="images/Vromans.bmp" alt="bakkerij vromans" id="logobakkerij">
            <div id="headercontainer">
                <nav id="kopnav">
                    <ul id="hoofdmenu">
                        <li><a href="home.php">home</a></li>
                        <li><a href="assortiment.php">ons assortiment</a></li>
                        <li><a href="overons.php">over ons</a></li>
                        
                    </ul>
                </nav>
            </div>
        </header>
        <h1>nieuwe gebruiker toevoegen</h1>
        <?php
        if ($error == "emailexists") {
            ?>
            <p style="color: red">emailadres bestaat al</p>
            <?php
        }
        if ($error == "fail2mail") {
            ?>
            <p style="color: red">er is een fout met het emailadres probeer het met een ander emailadres</p>
            <?php
        }
        if ($error == "dtbfail") {
            ?>
            <p style="color: red">alles met ingevuld zijn</p>
            <?php
        }
        ?>
        <form method="post" action="aanmelden.php?action=process" >
            <table>
                <tr>
                    <td>naam:</td>
                    <td>
                        <input type="text" name="txtNaam" required />
                    </td>
                </tr>
                <tr>
                    <td>voornaam:</td>
                    <td>
                        <input type="text" name="txtVoornaam" required />
                    </td>
                </tr>
                <tr>
                    <td>telefoonnummer:</td>
                    <td>
                        <input type="text" name="txtTelefoonnummer" required />
                    </td>
                </tr>
                <tr>
                    <td>emailadres:</td>
                    <td>
                        <input type="email" name="txtEmailadres" required>
                    </td>
                </tr>
                <tr>
                    <td>woonplaats:</td>
                    <td>
                        <input type="text" name="txtWoonplaats" required/>
                    </td>
                </tr>
                <tr>
                    <td>postcode:</td>
                    <td>
                        <input type="text" name="txtPostcode" required/>
                    </td>
                </tr>
                <tr>
                    <td>straat:</td>
                    <td>
                        <input type="text" name="txtStraat" required/>
                    </td>
                </tr>
                <tr>
                    <td>nummer:</td>
                    <td>
                        <input type="text" name="txtNummer" required/>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="submit" value="Toevoegen" required/>
                    </td>
                </tr>
            </table>

        </form>
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
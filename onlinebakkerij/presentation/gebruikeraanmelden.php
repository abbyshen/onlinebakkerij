<!DOCTYPE HTML>
<html>
    <head>
        <meta charset=utf-8>
        <title>aanmelden</title>
    </head>
    <body>
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
        ?>
        <form method="post" action="aanmelden.php?action=process">
            <table>
                <tr>
                    <td>naam:</td>
                    <td>
                        <input type="text" name="txtNaam">
                    </td>
                </tr>
                <tr>
                    <td>voornaam:</td>
                    <td>
                        <input type="text" name="txtVoornaam"
                    </td>
                </tr>
                <tr>
                    <td>telefoonnummer:</td>
                    <td>
                        <input type="text" name="txtTelefoonnummer"
                    </td>
                </tr>
                <tr>
                    <td>emailadres:</td>
                    <td>
                        <input type="text" name="txtEmailadres"
                    </td>
                </tr>
                <tr>
                    <td>woonplaats:</td>
                    <td>
                        <input type="text" name="txtWoonplaats"
                    </td>
                </tr>
                <tr>
                    <td>postcode:</td>
                    <td>
                        <input type="text" name="txtPostcode"
                    </td>
                </tr>
                <tr>
                    <td>straat:</td>
                    <td>
                        <input type="text" name="txtStraat"
                    </td>
                </tr>
                <tr>
                    <td>nummer:</td>
                    <td>
                        <input type="text" name="txtNummer"
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="submit" value="Toevoegen">
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>
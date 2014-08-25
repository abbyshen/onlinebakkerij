<!DOCTYPE HTML>
<html>
    <head>
        <meta charset=utf-8>
        <title>producten</title>
        <style>
            table { border-collapse: collapse;}
            td, th { border: 1px solid black; padding: 3px; }
            th { background-color: #ddd}
        </style>
    </head>
    <body>
        <h1>productenlijst</h1>
        <?php foreach ($productenLijst as $product) { 
                print($product->getSoort()->getOmschrijving());?>
            <table>
                <tr> 
                    <th>naam</th>
                    <th>prijs</th>
                </tr>
                <?php
                foreach ($productenLijst as $product) {
                    ?>
                    <tr>
                        <td>
                            <?php print($product->getNaam()) ?>
                        </td>
                        <td>
                            <?php print($product->getPrijs()) ?>€
                        </td>
                    </tr>
                    <?php
                }
            }
            ?>
        </table>
    </body>
</html>


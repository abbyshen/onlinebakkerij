<!DOCTYPE HTML>
<html>
    <head>
        <meta charset=utf-8>
        <title>producten</title>
        <style>
            table { border-collapse: collapse; }
            td, th { border: 1px solid black; padding: 3px; }
            th { background-color: #ddd}
        </style>
    </head>
    <body>
        <h1>productenlijst</h1>
        <table>
            <tr>
                <th>id</th>
                <th>naam</th>
                <th>prijs</th>
                <th>soort</th>
            </tr>
            <?php
            foreach ($productenLijst as $product) {
                ?>
                <tr>
                    <td>
                        <?php print($product->getId());?>
                    </td>
                    <td>
                        <?php print($product->getNaam())?>
                    </td>
                    <td>
                        <?php print($product->getPrijs())?>
                    </td>
                    <td>
                        <?php print($product->getSoort()->getOmschrijving())?>
                    </td>
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>


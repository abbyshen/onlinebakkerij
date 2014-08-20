<!DOCTYPE HTML>
<html>
    <head>
        <meta charset=utf-8>
        <title>soorten</title>
        <style>
            table { border-collapse: collapse; }
            td, th { border: 1px solid black; padding: 3px; }
            th { background-color: #ddd}
        </style>
    </head>
    <body>
        <h1>soortenlijst</h1>
        <table>
            <tr>
                <th>id</th>
                <th>soorrten</th>
            </tr>
            <?php
            foreach ($soortenLijst as $soort) {
                ?>
                <tr>
                    <td>
                        <?php print($soort->getId());?>
                    </td>
                    <td>
                        <?php print($soort->getOmschrijving())?>
                    </td>
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>



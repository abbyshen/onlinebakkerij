<?php
session_start();
$gelukt = gebruikerservice::logincheck();
if($gelukt==true){
    $logged= "in";
    echo 'logged is in';
} else {
    $logged = "out";
    echo 'logged is out';
}
?>
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
    <header>
         <body class="home">
        <header>
            <?php if ($logged=="out") {
                ?>
              <form method="post" action="process_login.php?action=inloggen">
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
                </form>
            <?php } else{}if ($logged == "in") { ?><h2><a href="logout.php">log out</a></h2><?php
        }else{} ?>
    </header>
    <body>
        <h1>productenlijst</h1>
        <?php if($logged == "out") {
            print($gelukt);
        } else {}
        foreach ($productenLijst as $product) { 
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


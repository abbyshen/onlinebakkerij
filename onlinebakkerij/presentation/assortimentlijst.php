<?php
$gelukt = gebruikerservice::logincheck();
if ($gelukt =="loggedin") {
    $logged = "in";
} else {
    $logged = "out";
}
?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta charset=utf-8>
        <title>assortiment</title>
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
            <a href="aanmelden.php"> aanmelden </a>
            <?php } if ($logged=="in") { ?><h2><a href="logout.php">log out</a></h2><?php
        } ?>
            <div class="container">
                <h1><a href="home.php" id="logo">Bakkerij vroman</a></h1>
                <nav id="kopnav">
                    <ul id="hoofdmenu">
                        <li><a href="home.php">home</a></li>
                        <li><a href="assortiment.php">ons assortiment</a></li>
                        <li><a href="overons.php">over ons</a></li>
                            <?php if ($logged == "in") {
                                ?><li><a href="mijnprofiel.php">mijn profiel</a></li>
                            <li><a href="bestellingopnemen.php">bestellen</a></li><?php 
                            } ?>
                            <?php if ($logged == "out") {
                                ?><li>mijn profiel</li>
                            <li>bestellen</li><?php 
                            } ?>
                    </ul>
                </nav>
            </div>
        </header>
    <body>
        <h1>assortiment</h1>
        <?php 
        foreach ($soortenLijst as $soort) {
                    ?> <h3> <?php print($soort->getOmschrijving()); ?> </h3> <?php
                    $productLijst = $productenSvc1->getproductenpersoort($soort->getId());
                    foreach ($productLijst as $product) {
                        $Pnaam = $product->getNaam();
                        ?><div class="bestelling"><p><?php print($Pnaam); ?></p>
                            <p><?php print($product->getPrijs());print("€"); ?></p>
                            <p>--------------------------</p></div>
                    <?php }
                }
            ?>
        </table>
    </body>
</html>

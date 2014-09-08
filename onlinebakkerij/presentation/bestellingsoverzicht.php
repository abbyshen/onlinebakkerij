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
            <h1>is uw bestelling in orde?</h1>
            <form method="post" action="bestellingopnemen.php?action=bestellingfase2">
                <?php
                $prijstot = 0;
                while ($i <= $maxaantal) {
                    if ($aantalarray[$i] != 0) {
                        $productnaam = $productenSvc1->productnaammetid($i);
                        $productprijs = $productenSvc1->productprijsmetid($i);
                        $prijs = $productprijs * $aantalarray[$i];
                        $prijstot = $prijstot + $prijs;
                        ?><p>artikelnaam : <?php echo $productnaam ?> aantal: <?php echo $aantalarray[$i] ?> prijs: <?php echo $prijs ?>€</p>
                        <?php
                    }
                    $i++;
                }
                ?>
                <p>dit is uw bestelling voor <?php echo $datum ?></p>
                <p>de totale prijs bedraagt <?php echo $prijstot ?>€</p>
                <input type="submit" value="in orde!">
            </form>
            <form method="post" action="bestellingopnemen.php">
                <input type="submit" value="cancel">
            </form>
        </section>
    </body>
</html>

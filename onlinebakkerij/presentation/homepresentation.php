<?php
$gelukt = gebruikerservice::logincheck();
if ($gelukt == "loggedin") {
    $logged = "in";
} else {
    $logged = "out";
}
?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta charset=utf-8 />
        <style>
            .home{
                
                    background-color: #FFD696;
                    /* For WebKit (Safari, Chrome, etc) */
                    background: #FFD696 -webkit-gradient(linear, left top, left bottom, from(#734600), to(#FFD696)) no-repeat;
                    /* Mozilla,Firefox/Gecko */
                    background: #FFD696 -moz-linear-gradient(top, #734600, #FFD696) no-repeat;
                    /* IE 5.5 - 7 */
                    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=#734600, endColorstr=#FFD696) no-repeat;
                    /* IE 8 */
                    -ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr=#734600, endColorstr=#734600)" no-repeat;
                
            }
            header {
                height:120px;
            }
            #kopnav {
                padding:0;
                float:left;
                
            }
            #kopnav li {
                display:inline;
                font-family:Arial;
                font-size:15px;
                float:left;
                padding:10px;
                background-color: #333333;
                color:#ffffff;
                border-bottom:1px;
                border-bottom-color:#000000;
                border-bottom-style:solid;
            }

            #kopnav li a{
                font-family:Arial;
                font-size:12px;
                text-decoration: none;
                float:left;
                padding:10px;
                background-color: #333333;
                color:#ffffff;
                border-bottom:1px;
                border-bottom-color:#000000;
                border-bottom-style:solid;
            }
            #kopnav li a:hover {
                background-color:#9B1C26;
                padding-bottom:12px;
                border-bottom:2px;
                border-bottom-color:#000000;
                border-bottom-style:solid;
                margin:-1px;
            }
            #logobakkerij {
                float:left;
            }
            #inlogform {
                margin-right: 60px;
                clear: right;
                float:right;
            }
            #inlogform td{
                color:#ffffff;
            }
            #inlogform a {
                text-decoration: none;
                font-family:Arial;
                font-size:12px;
                color: #ffffff;
            }
            #inlogform a:hover {
                color: #9B1C26;
            }
            #logout{
                float: right;
                margin-right: 60px;
            }
            #logout a {
                text-decoration: none;
                font-family:Arial;
                color: #ffffff;
            }
            #logout a:hover {
                color: #9B1C26;
            }
            #headercontainer { 
                width: 540px;
                height: 100px;
                float: left;
                margin-left: 50px ;

            }
            .container{
                width: 100%;
                clear: both;
            }
            #logobakkerij{
                margin-top: 14px;
                margin-left: 120px;
                margin-right: 40px;
            }
            #welkom h1{
                width: 300px;
                margin-left: auto;
                margin-right: auto;
                color: white;
            }
            footer{
                width: 100%;
                float: left;
                clear: both;
                border-color: #333333;
                border-style: solid;
            }
            #footer1{
                width: 300px;
                float: left;
                margin-left:60px;
            }
            #footer1 p{
                margin-right: auto;
                margin-left: auto;
            }
            #footer2{
                width: 300px;
                float: right;
                margin-right: 60px;
            }
            #footer2 p{
                margin-right: auto;
                margin-left: auto;
            }
        </style>
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
        <div id="inhoud" class="container">
            <img src="images/homeafb1edit1.png" alt="pistoles">
            <section id ="welkom">
                <h1>welkom bij bakkerij vroman!</h1>
                <img src="images/homeafb1edit2.png" alt="pistoles">
                <p>nieuw in ons assortiment:cupcakes</p>
                <p>gebakjes:</p>

                <?php
                foreach ($productenLijst as $product) {
                    ?><p><?php
                        print($product->getNaam());
                        print("      ");
                        print($product->getPrijs());
                        ?></p><?php
            }
                    ?>
            </section>
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
        </div>
    </body>
</html>
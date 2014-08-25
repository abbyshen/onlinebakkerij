<!DOCTYPE HTML>
<html>
    <head>
        <meta charset=utf-8>

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
            <div class="container">
                <h1><a href="home.php" id="logo">Bakkerij vroman</a></h1>
                <nav id="kopnav">
                    <ul id="hoofdmenu">
                        <li><a href="home.php">home</a></li>
                        <li><a href="assortiment.php">ons assortiment</a></li>
                        <li><a href="overons.php">over ons</a></li>
                    </ul>
                </nav>
            </div>
        </header>
        <div id="inhoud" class="container">
            <section id ="welkom">
                <h1>welkom bij bakkerij vroman!</h1>
                <p>nieuw in ons assortiment:cupcakes</p>
                <p>gebakjes:</p>

                <?php
                foreach ($productenLijst as $product) {
                    ?><p><?php print($product->getNaam());print("      ");print($product->getPrijs());?></p><?php
                }
                ?>
                <img src="../../../../../C:/Users/user/Desktop/fotos bkkerij/cupcakes.jpg" alt="cupcakes">
            </section>
        </div>
    </body>
</html>

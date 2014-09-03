<!DOCTYPE HTML>
<html>
    <head>
        <meta charset=utf-8>
        <title>aanmelden</title>
        <style>
            input:required:invalid, input:focus:invalid {
                background-image: url(images/invalid.png);
                background-position: right top;
                background-repeat: no-repeat;
            }
            input:required:valid {
                background-image: url(images/valid.png);
                background-position: right top;
                background-repeat: no-repeat;
            }
            /*#hoofdmenu {
                list-style: none;
                font-size: 0.875em; /* 14px = 1em */
            /*font-weight: bold;
            padding: 0; /* 0.5em = 6px */
            /*margin: 0 1em;
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
        }*/
            #kopnav {
                padding:0;
            }
            #kopnav li {
                display:inline;
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
        </style>
    </head>
    <body>
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
        <form method="post" action="aanmelden.php?action=process" />
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
</body>
</html>
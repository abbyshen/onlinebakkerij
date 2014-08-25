<?php
include_once ("data/DBconfig.php");
include_once ("business/gebruikerservice.php");

$gebruikersvc = new gebruikerservice;
$gebruikersvc->sec_session_start();

if($gebruikersvc->logincheck()==true){
    $logged= "in";
} else {
    $logged = "out";
}
?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta charset=utf-8>
        <title>inloggen</title>
    </head>
    <body>
        <h1>inloggen</h1>
        <form method="post" action="process_login.php?action=inloggen">
            <table>
                <tr>
                    <td>emailadres:</td>
                    <td>
                        <input type="text" name="email"
                    </td>
                </tr>
                <tr>
                    <td>wachtwoord:</td>
                    <td>
                        <input type="password" name="p">
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="submit" value="inloggen">
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>
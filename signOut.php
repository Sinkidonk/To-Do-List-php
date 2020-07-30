<?php
session_start();
require 'includes/pdo_connect.php';

if ($_SESSION['userID']) {
    
    // Clear the variable:
    
    // Clear the session data:
    $_SESSION = array();
    
    // Clear the cookie:
    //setcookie(session_name(), false, time()-3600);
    /*
     * Thank you poke and Doug
    https://stackoverflow.com/questions/2310558/how-to-delete-all-cookies-of-my-website-in-php
*/    
    //$past = time() - 3600;
foreach ( $_COOKIE as $key => $value )
{
    setcookie( $key, $value, 1, '/' );
}
    
    //setcookie("id", "", time() -3600);
    //setcookie("user", $_SESSION['username'], time() -3600);
    //setcookie("fName", $_SESSION['fName'], time() -3600);
    //setcookie("lName", $_SESSION['lName'], time() -3600);
    
    // Destroy the session data:
    session_destroy();
    
} // End of $user IF.

Header('Location: ' . 'index.php'); // To keep from getting dups in the database
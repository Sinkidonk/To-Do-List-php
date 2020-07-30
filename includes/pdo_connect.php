<?php

try {
    $db = new PDO('mysql:host=localhost;dbname=parysa2_AdvPhpFinal', '', ''); /* username and password removed */
    //$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $ex) {
    echo "<p>$ex</p>";
}

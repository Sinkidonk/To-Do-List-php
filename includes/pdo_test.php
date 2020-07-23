<?php 
try {
    require_once './pdo_connect.php';
} catch (Exception $ex) {
    $error = $e->getMessage();
}
?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Test database</title>
    </head>
    <body>
        <h1>Connecting with PDO</h1>
7        <?php
        if ($db) {
            echo "<p>Connection successful.</p>";
        } elseif (isset($error)) {
            echo "<p>$error</p>";
        }
        ?>
    </body>
</html>

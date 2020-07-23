<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <!--
        Author: Alex Parys 
        Date: 7/19/2018
        -->
        <meta charset="UTF-8">
        <meta name="author" content="Alex Parys">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Bootstrap css -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
        <link rel="stylesheet" href="http://apollo.gtc.edu/~aparys/adv-php/final-project/css/styles.css">
        <title><?php echo (isset($pageTitle)) ? $pageTitle : 'Some Content Site'; ?></title>
        <!-- code from unit 9 apply -->
    </head>
    <body>
                <?php
                /*
        if ($db) {
            echo "<p>Connection successful.</p>";
        } elseif (isset($error)) {
            echo "<p>$error</p>";
        }
                 * 
                 */
       //print_r($_SESSION);
        ?>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar_brand" href="index.php"><img src="./img/notepad.svg" width="30"></a>
            <!--<div class="collapse navbar-collapse" id="navbarNavDropdown">-->
            <ul class="nav nav-pills">
                <!-- add php code to move the active class around -->
                <li class="nav-item<?php if($pageTitle == 'Home'){ echo " active";}?>">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <?php
                    if(!isset($_SESSION['userID'])) {
                        if($pageTitle == 'Register'){
                            $act = 'active';
                        }
                        echo '<li class="nav-item';
                        if($pageTitle == 'Register'){
                             echo $act.'">';
                        } else {
                           echo '">';
                        }
                        echo '<a class="nav-link" href="register.php">Register</a>';
                        echo '</li>';
                        
                    }
                    if(isset($_SESSION['userID'])) {
                        if($pageTitle == 'To Do List') {
                            $act = 'active';
                        }
                        echo '<li class="nav-item';
                      if($pageTitle == 'To Do List'){
                             echo $act.'">';
                        } else {
                           echo '">';
                        }
                        echo '<a class="nav-link" href="list.php">TO DO LIST</a>';
                        echo '</li>';
                    }
                ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php 
                        if (isset($_SESSION['userID'])) {
                            echo 'Hi '.$_SESSION['fName'];
                        }
                        if (!isset($_SESSION['userID'])) {
                            echo 'Hi User';
                        }
                        ?>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        
                        <a class="dropdown-item" href="
                            <?php if(isset($_SESSION['userID'])) {echo 'signOut.php';} else {
                                echo 'signIn.php';
                            };?>">
                            <?php if(isset($_SESSION['userID'])) {
                                echo 'Log Out';
                            }
                                else {
                                    echo 'Log In';
                                }
                            ?>
                        </a> <!-- have it be Sign out when someone is sign in -->
                            <?php if(isset($_SESSION['userID'])) {
                                echo '<a class="dropdown-item" href="dashboard.php">Display Profile Info</a>';} ?>
                            
                         <!-- show only if user is log in -->
                    </div>
                </li>
            </ul>
        <!--</div>-->
    </nav>
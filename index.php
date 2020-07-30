<?php
session_start();

require 'includes/pdo_connect.php';
$pageTitle = "Home";

include './includes/inc_header.php';
?>
<main>
                
    <div class="wrapper">
        <img class="mobileResize" src="./img/notepad.svg">
    <h1>Welcome to The To Do List</h1>
    <p>Had you ever wished for a simple website to 
        help you keep track of the things you need to do.</p>
    <p>Had you wish you have a To Do List within the cloud that always there when you need it</p>
    <p>Well now Thanks to the To Do List Website you can have all of that and more</p>

    <p>Unlike other task keeping website we pride ourself on selling all of your data to big data companies 
        so they can target you with more specific ads related to stuff you might need to complete your tasks at hand</p>

    <p>With knowing all of that make an account with us today and help keep your mind on track, and our wallet heavy</p>
    <p>All at no cost to you join today</p>
    
    <p> you see the cool little picture I made that for fun just for this project
        because I was bored</p>
    <p> I made it using inkscape and it only took about 15 min of my time to make
        and after running through a svg minify program it only 6k of data</p>
    </div>

</main>


<?php include './includes/inc_footer.php'; ?>
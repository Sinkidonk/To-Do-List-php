<?php
session_start();
require "./includes/pdo_connect.php";
$pageTitle = "Register";

include "./includes/inc_header.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Handle the form submission
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $username = $_POST["username"];
    $passwd = $_POST["password"];
    $passwdVerify = $_POST['verifyPassword'];
//$verifyPassword = $_POST["verifyPassword"];

    
    /* Add valideate to this page */
    
    /* Thank you to the maker of phpdelusions.net it had been a great helper */

    /* might make the select statement into a class */

    /* Thank you Feyornowa from Stackover 
     * https://stackoverflow.com/questions/51461984/pdo-select-statement-not-giving-correct-data
     */

    $stmt = $db->prepare("SELECT username FROM user_info WHERE username=:username");
    $stmt->execute([":username" => $username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);



    if ($user['username'] == $username) {
        echo 'user already exist';
        
    } else if($passwd == $passwdVerify) {
		$encryptpasswd = sha1($passwd);
        $sql = "INSERT INTO user_info (username, password, firstName, lastName) VALUES (?, ?, ?, ?)";
        $stmt = $db->prepare($sql);
        $stmt->execute([$username, $encryptpasswd, $fname, $lname]);
        Header('Location: ' . 'index.php');
    }
    else if($passwd != $passwdVerify) {
        echo 'Password is not the same in both passwords boxes';

    }
    
}
?> 
<main>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="form-group">
            <label for="fName">First Name:</label>
            <input type="text" class="form-control" id="fname" name="fname" aria-describedby="First Name" placeholder="First Name">
        </div>
        <div class="form-group">
            <label for="=lName">Last Name:</label>
            <input type="text" class="form-control" id="lname" name="lname" aria-describedby="Last Name" placeholder="Last Name">
        </div>
        <div class="form-group">
            <label for="user">Username</label>
            <input type="text" class="form-control" id="username" name="username" aria-describedby="Username" placeholder="Username">
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password" aria-describedby="Password" placeholder="Password">
        </div>
        
        <div class="form-group">
            <label for="verifyPassword">Verify Password:</label>
            <input type="password" class="form-control" id="verifyPassword" name="verifyPassword" aria-describedby="Verify Password" placeholder="Verify Password">
        </div>
        
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</main>
<?php
include "./includes/inc_footer.php";
?>
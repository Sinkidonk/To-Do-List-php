<?php
session_start();
require 'includes/pdo_connect.php';
$pageTitle = "Sign In";

include './includes/inc_header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $passwd = $_POST['password'];
    $encryptpasswd = sha1($passwd);
    
    
    $stmt = $db->prepare("SELECT * FROM user_info WHERE username=:username");
    $stmt->execute([":username" => $username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    

    if (empty($user)) {
        echo "Username don't exist";
    } elseif ((($user["username"] == $username) && ($encryptpasswd == $user["password"]))) {
        echo "Good job you remember your username and password";
        $_SESSION['userID'] = $user['userID'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['fName'] = $user['firstName'];
        $_SESSION['lName'] = $user['lastName'];
        
        // Cookie code
        $cookie_id = $_SESSION['userID'];
        Header('Location: ' . 'index.php');
    }
    
}
?>
<main>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <div class="form-group">
        <label for="user">Username:</label>
        <input type="text" class="form-control" id="username" name="username" aria-describedby="Username" placeholder="Username">
    </div>
    <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password" aria-describedby="Password" placeholder="Password">
        </div>
    <button type="submit" class="btn btn-primary">Login</button>
</form>
</main>
<?php include './includes/inc_footer.php';?>


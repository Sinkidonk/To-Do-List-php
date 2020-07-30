<?php
session_start();
require 'includes/pdo_connect.php';
$pageTitle = "Dashboard";

include './includes/inc_header.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Handle the form submission
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $passwd = $_POST["password"];
    $passwdVerify = $_POST['verifyPassword'];
    $encryptpasswd = sha1($passwd);
    if (empty($passwd)) {
        $sql = "UPDATE user_info SET firstName=:fName,lastName=:lName WHERE userID=:id";
        $stmt = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $stmt->execute(array(':fName' => $fname, ':lName' => $lname, ':id' => $_SESSION['userID']));
        $_SESSION['fName'] = $fname;
        $_SESSION['lName'] = $lname;
        
    }
    if ((!empty($passwd)) && ($passwd == $passwdVerify)) {
        $sql = "UPDATE user_info SET firstName=:fName,lastName=:lName, password=:passwd  WHERE userID=:id";
        $stmt = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $stmt->execute(array(':fName' => $fname, ':lName' => $lname, ':passwd' => $encryptpasswd, ':id' => $_SESSION['userID']));
        
        $_SESSION['fName'] = $fname;
        $_SESSION['lName'] = $lname;
    } else {
        echo 'passwords did not match try again.';
    }
}
?>
<main>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="form-group">
            <label for="fName">First Name:</label>
            <input type="text" class="form-control" id="fname" name="fname"
                   aria-describedby="First Name" placeholder="First Name"
                   value="<?php echo $_SESSION['fName'] ?>">
        </div>
        <div class="form-group">
            <label for="=lName">Last Name:</label>
            <input type="text" class="form-control" id="lname" name="lname"
                   aria-describedby="Last Name" placeholder="Last Name"
                   value="<?php echo $_SESSION['lName'] ?>">
        </div>

        <div class="form-group">
            <label for="password">New Password:</label>
            <input type="password" class="form-control" id="password" name="password"
                   aria-describedby="Password" placeholder="Password">

        </div>
                <div class="form-group">
            <label for="verifyPassword">Verify New Password:</label>
            <input type="password" class="form-control" id="verifyPassword" name="verifyPassword" aria-describedby="Verify Password" placeholder="Verify Password">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</main>

<?php include './includes/inc_footer.php'; ?>

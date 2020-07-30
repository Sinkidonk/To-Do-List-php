<?php
session_start();
require 'includes/pdo_connect.php';
$pageTitle = "To Do List";

include './includes/inc_header.php';
require './includes/listsClass.php';
?>
<main>

    <?php
	/* as future me is now reading this code over to remake the database I relized I should
	had added more comments to make it easier to read */
    if (!empty($_SESSION['userID'])) {
        $stmt = $db->prepare("SELECT * FROM tasks WHERE userID=:id");
        $stmt->execute([":id" => $_SESSION['userID']]);
        $list = $stmt->fetchAll();
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $btnVal = $_REQUEST['btnInput'];

            if ($btnVal == 'add') {
                $enteredInput = $_POST["userInput"];

                if (!empty($enteredInput)) {
                    $addSql = "INSERT INTO tasks (userID,lists,done) VALUES(:id, :list, :done)";
                    $addStmt = $db->prepare($addSql);

                    $addStmt->execute([":id" => $_SESSION['userID'], ":list" => $enteredInput, ":done" => 0]);
                    
                    Header('Location: ' . $_SERVER['PHP_SELF']); // To keep from getting dups in the database
                }
            }
            if ($btnVal == 'delete') {
                $checkedList = $_POST['listItem'];

                for ($i = 0; $i <= count($checkedList) - 1; $i++) {
                    $delSql = "DELETE FROM tasks WHERE id=?";
                    $delStmt = $db->prepare($delSql);
                    $delStmt->execute([$checkedList[$i]]);
                }
                Header('Location: ' . $_SERVER['PHP_SELF']); // To keep from getting dups in the database
            }

            if ($btnVal == 'update') {
                $checkedList = $_POST['listItem'];
                $checkedCount = count($checkedList);
                $enteredInput = $_POST["userInput"];
                if ($checkedCount == 1) {
                    $updateSql = "UPDATE tasks SET lists=:change WHERE id=:id";
                    $updateStmt = $db->prepare($updateSql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $updateStmt->execute(array(':change' => $enteredInput, ':id' => $checkedList[0],));
                    Header('Location: ' . $_SERVER['PHP_SELF']); // To keep from getting dups in the database
                } else {
                    echo '<p>Must select only one value for update';
                }

            }

            if ($btnVal == 'done') {
                $checkedList = $_POST['listItem'];
                $checkedCount = count($checkedList);

                for ($i = 0; $i <= $checkedCount - 1; $i++) {
                    $markAsDoneSql = "UPDATE tasks SET done=:markAs WHERE id=:id";
                    $markAsDoneStmt = $db->prepare($markAsDoneSql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $markAsDoneStmt->execute(array(':markAs' => 1, ':id' => $checkedList[$i],));
                }
                Header('Location: ' . $_SERVER['PHP_SELF']); // To keep from getting dups in the database


                
            }
        }
        /* Add if statment to check if user have any data from the select statement
         * if not just display add a task
         * if they do display all tasks
         * and display display add a task
         */
        echo '<form method="post" action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '">';
        // Keep from throwing an error if user have no data in the database yet
        if (count($list) != 0) {
            $listClass = new listsClass();
            for ($x = 0; $x <= count($list) - 1; $x++) {
                
                
                echo '<div class="form-group listscolor">';
                echo '<input type="checkbox" class="form-control" name="listItem[]" value="' . $list[$x]['id'] . '">';
                echo '<span class="' . $listClass->markAsDone($list[$x]['done']) . ' clearfloat">' . $list[$x]['lists'] . '</span>';
                echo '</div>';
            }
            echo '<input type="text" class="form-control" id="userInput" name="userInput">';
            echo '<button type="submit" class="btn" value="update" name="btnInput">Update</button>';
            echo '<button type="submit" class="btn" value="delete" name="btnInput">Delete</button>';
            echo '<button type="submit" class="btn" value="add" name="btnInput">Add</button>';
            echo '<button type="submit" class="btn" value="done" name="btnInput">Mark as Done</button>';
        } else {
            echo '<h2>You don&#39;t have any tasks yet to show add one below</h2>';
            echo '<input type="text" class="form-control" id="userInput" name="userInput">';
            echo '<button type="submit" class="btn" value="add" name="btnInput">Add</button>';

        }

        echo '</form>';
    } else {
        echo "<p>how did you get onto this page begone hacker</p>";
    }
    ?>

</main>
<?php include './includes/inc_footer.php'; ?>

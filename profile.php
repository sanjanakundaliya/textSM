<?php
require_once("lib/header.php");
if (isset($_POST["deactivate"])) {
    $query = "UPDATE users SET isaccountdisabled = 'false' WHERE username = \"" . $username . "\"; ";
    $conn->query($query);
    header("location:logout.php");
}
if (isset($_POST["delete"])) {
    $query = "DELETE FROM  users WHERE username = \"" . $username . "\"; ";
    $conn->query($query);
    header("location:logout.php");
}
if (isset($_GET["following"])) {
    $following = $_GET["following"];
    $query = "insert into follow values(\"" . $following . "\",\"" . $username . "\")";
    $conn->query($query);
}
if (isset($_GET["unfollowing"])) {
    $unfollowing = $_GET["unfollowing"];
    $query = "delete from follow where following=\"" . $unfollowing . "\" AND follower=\"" . $username . "\"";
    // echo $query;
    $conn->query($query);
}
if (isset($_POST["posttext"])) {
    $content = $_POST["posttext"];
    // INSERT INTO post(content, username) VALUES ()
    $query = "INSERT INTO post(content, username) VALUES (\"".$content."\",\"".$username."\")";
    // echo $query;
    $conn->query($query);
}
?>
<div class="container-fluid row">
    <div class="col-sm-8 p-2">
        <?php echo $username; ?>
        <!-- Button to Open the Modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#viewFollowers">
            ViewFollowers
        </button>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPost">
            Add Post
        </button>

        <!-- The Modal -->
    </div>
    <div class="modal" id="viewFollowers">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">FOLLowers</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <?php

                    $query = "select * from users where username <> \"" . $username . "\";";
                    $result = $conn->query($query);
                    if (isset($result->num_rows) && $result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $uname = $row["username"]; ?>

                            <h1><?php echo $uname; ?></h1>
                            <?php $query2 = "select * from follow where following=\"" . $uname . "\" AND follower=\"" . $username . "\"";
                            $checkfollow = $conn->query($query2);
                            // echo $query2;
                            // echo $checkfollow->num_rows;
                            if (!isset($checkfollow->num_rows) || $checkfollow->num_rows == 0) { ?>
                                <form action="" method="GET">
                                    <input type="hidden" name="following" value="<?php echo $row['username']; ?>">
                                    <input type="submit" value="follow">
                                </form>
                            <?php } else { ?>
                                <form action="" method="GET">
                                    <input type="hidden" name="unfollowing" value="<?php echo $row['username']; ?>">
                                    <input type="submit" value="unfollow">
                                </form>
                    <?php }
                        }
                    }
                    ?>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>
    <div class="modal" id="addPost">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Add Post</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form action="" method="post">
                        <textarea name="posttext" cols="30" rows="10" class="form-control"></textarea>
                        <input type="submit" value="post" class="btn btn-success">
                    </form>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>
    <div class="col-sm-4 row">
        <form action="" class="col-sm-5" method="post">
            <input type="submit" value="deactivate" class="btn btn-warning" name="deactivate">
        </form>
        <div class="col-sm-2"></div>
        <form action="" class="col-sm-5" method="post">
            <input type="submit" value="delete" class="btn btn-danger" name="delete">
        </form>
    </div>
</div>

<div class="container-fluid row">
    <?php 
    $query = "select * from post where username = \"" . $username . "\";";
    $result = $conn->query($query);
    if (isset($result->num_rows) && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            ?>
    <div class="col-sm-4 p-3">
        <div>
         <?php
         echo $row["content"] ;
         ?>
        </div>
    </div>
    <?php
        }
    }
    ?>
</div>

<?php
require_once("lib/footer.php");
?>
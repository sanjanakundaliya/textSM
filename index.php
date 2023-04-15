<?php
require_once("lib/header.php");
?>
<div class="container-fluid row">
    <?php
    $query = "select * from post;";
    $result = $conn->query($query);
    if (isset($result->num_rows) && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $query2 = "select * from follow where following = \"" . $row['username'] . "\" AND follower=\"" . $username . "\" ";
            $result2 = $conn->query($query2);
            if (isset($result2->num_rows) && $result2->num_rows > 0) { ?>
                <div class="col-sm-4 p-3">
                    <div>
                        <?php
                        echo $row["content"];
                        ?>
                    </div>
                </div>

    <?php }
        }
    }
    ?>
</div>
<?php
require_once("lib/footer.php");
?>
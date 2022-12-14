<?php

session_start();
if (isset($_SESSION["id"])) :
    $user_id = $_SESSION["id"];
    include("../connections.php");
    include("fetch.php");
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../plugins/bootstrap/css/bootstrap.min.css">
        <script src="../plugins/bootstrap/js/bootstrap.bundle.js"></script>
        <title>CHMSU TMS</title>

    </head>

    <body>
        <div class="container">
            <?php include("inc/top_nav.php") ?>
            <br><br>

            <?php
            while ($row = mysqli_fetch_assoc($get_profile)) {
                $db_first_name = $row["first_name"];
                $db_last_name = $row["last_name"];
                $db_user = $row["username"];
                $db_date = $row["date"];
            }

            $fullname = ucfirst($db_first_name) . " " . ucfirst($db_last_name);

            ?>
            <h3>Profile</h3>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Date</th>
                        <td><?php echo date('M d, Y', strtotime($db_date)) ?></td>
                    </tr>
                    <tr>
                        <th>Name:</th>
                        <td><?php echo $fullname ?></td>
                    </tr>
                    <tr>
                        <th>Username:</th>
                        <td><?php echo $db_user ?></td>
                    </tr>
                </thead>
            </table>
            <button title="Logout" type='submit' name="logoutUser" data-bs-toggle="modal" data-bs-target="#profile_edit" class='btn btn-info'>Edit Profile</button>
            <?php include("inc/modals.php"); ?>
        </div>

    </body>

    </html>
<?php
else :
    @include "../error.php";
endif;
?>
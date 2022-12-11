<?php

session_start();
include("../connections.php");
if (isset($_SESSION["id"])) :
    $user_id = $_SESSION["id"];
    include("../connections.php");

    $get_record = mysqli_query($connections, "SELECT * FROM users WHERE id='$user_id' ");
    while ($row = mysqli_fetch_assoc($get_record)) {
        $db_first_name = $row["first_name"];
    }


?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../plugins/bootstrap/css/bootstrap.min.css">
        <script src="../plugins/bootstrap/js/bootstrap.bundle.js"></script>
        <title>Applicants</title>
    </head>

    <body>
        <div class="container">
            <?php include("inc/top_nav.php") ?>
            <br>
            <?php
            include("../connections.php");
            ?>
            <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
            <div class="container bg-light" style="margin-top: 60px;">
                <br>
                <br>
                <p>List of coordinators</p>
                <hr>
                <table id="fetch_result" class="table-sm table table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Contact</th>
                            <th>Date Created</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $view_query = mysqli_query($connections, "SELECT * FROM users WHERE account_type='coordinator' ");

                        while ($row = mysqli_fetch_assoc($view_query)) :
                            $user_id = $row["id"];
                            $db_first_name = $row["first_name"];
                            $db_middle_name = $row["middle_name"];
                            $db_last_name = $row["last_name"];
                            $db_email = $row["email"];
                            $db_contact = $row["contact"];
                            $db_date    = $row['date'];
                        ?>
                            <?php $db_fullname = $db_first_name . " " . $db_middle_name . " " . $db_last_name ?>
                            <tr>
                                <td><?php echo $db_fullname ?></td>
                                <td><?php echo $db_email ?></td>
                                <td><?php echo $db_contact ?></td>
                                <td><?php echo date('M d, Y', strtotime($db_date)) ?></td>
                                <td colspan='3'>
                                    <a class='btn-sm btn btn-primary' href='#'>View</a>
                                    <a class='btn-sm btn btn-info' href='process.php?update=<?php echo $row["id"] ?>'>Edit</a>
                                    <a class='btn-sm btn btn-outline-danger' href='process.php?delete=<?php echo $row["id"] ?>'>Deactivate</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Contact</th>
                            <th>Date Created</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>

            </div>
            <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
            <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
            <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
            <script>
                $(document).ready(function() {
                    $('#fetch_result').DataTable();
                });
            </script>
        </div>
    </body>

    </html>

    <!--Logout Modal-->
    <div class="modal fade" id="modalLogout" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body p-4 text-center">
                    <h5 class="mb-0">Warning!</h5>
                    <p class="mb-0">Are you sure you want to logout?</p>
                </div>
                <form method="post">
                    <div class="modal-footer flex-nowrap p-0">
                        <button type="button" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 m-0 rounded-0 border-end" data-bs-dismiss="modal">Cancel</button>
                        <a href="logout.php" name="logoutUser" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 m-0 rounded-0">Logout</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php
else :
    @include "../error.php";
endif;
?>
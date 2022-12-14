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
        <title>Applicants</title>
        <link rel="stylesheet" href="../plugins/bootstrap/css/bootstrap.min.css">
        <script src="../plugins/bootstrap/js/bootstrap.bundle.js"></script>
    </head>

    <body>
        <div class="container">
            <?php include("inc/top_nav.php") ?>
            <br>
            <br>
            <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
            <div class="container bg-light">

                <br>
                <p>List of Pending Applicants</p>
                <hr>
                <table id="fetch_result" class="table-sm table table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Contact #</th>
                            <th>Address</th>
                            <th>Business Type</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // $get_applicants = mysqli_query($connections, "SELECT * FROM tenants WHERE status='pending'");
                        while ($row = mysqli_fetch_assoc($get_applicants)) :
                            $db_fname = $row["fname"];
                            $db_midname = $row["midname"];
                            $db_lname = $row["lname"];
                            $db_email = $row["email"];
                            $db_contact = $row["contact"];
                            $db_type = $row["business_type"];
                            $db_address = $row["address"];
                            $db_status = $row["status"];
                            $fullname = ucfirst($db_fname) . " " . ucfirst($db_midname[0]) . ". " . ucfirst($db_lname);

                        ?>
                            <tr>
                                <td><?php echo $fullname ?></td>
                                <td><?php echo $db_email ?></td>
                                <td><?php echo $db_contact ?></td>
                                <td><?php echo substr($db_address, 0, -15) . "..." ?></td>
                                <td><?php echo $db_type ?></td>
                                <td>
                                    <p class='badge rounded-pill text-bg-danger'><?php echo $db_status ?></p>
                                </td>
                                <td>
                                    <a href='applicant_info.php?view=<?php echo $row['id'] ?>' name='btnAccept' class='btn-sm btn btn-info'>View</a>
                                    <a href='mailer.php?accept=<?php echo $row['id'] ?>' name='btnAccept' class='btn-sm btn btn-success'>Accept</a>
                                    <a href="mailer.php?reject=<?php echo $row['id'] ?>" name='btnReject' class='btn-sm btn btn-warning'>Reject</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Contact #</th>
                            <th>Address</th>
                            <th>Business Type</th>
                            <th>Status</th>
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
        </div>
        <?php include("inc/modals.php") ?>

    </body>

    </html>
<?php
else :
    @include "../error.php";
endif;
?>
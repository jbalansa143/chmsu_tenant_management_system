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
        <title>Payments</title>
    </head>

    <body>
        <div class="container">
            <?php
            include("inc/top_nav.php");
            include("inc/modals.php");
            ?>
            <br><br>
            <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
            <div class="container">
                <br>
                <?php
                $report = mysqli_query($connections, "SELECT SUM(amount) AS `amount` FROM payment");
                while ($payments = mysqli_fetch_assoc($report)) {
                    $amounts = $payments["amount"];
                }

                ?>
                <h5>Payment Reports</h5>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <td>Total this month:</td>
                            <td><?php echo "₱ " . $amounts; ?></td>
                        </tr>
                    </thead>
                </table>
                <table id="fetch_result" class="table-sm table table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Amount</th>
                            <th>Ref. No</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $get_record = mysqli_query(
                            $connections,
                            "SELECT users.username, tenants.fname, payment.amount, payment.refno, payment.date
                             FROM ((users INNER JOIN payment ON payment.user_id = users.id) INNER JOIN tenants ON users.user_id = tenants.id)"
                        );
                        while ($row = mysqli_fetch_assoc($get_record)) :
                            $db_first_name = $row["fname"];
                            $db_amount = $row["amount"];
                            $db_refno = $row["refno"];
                            $db_date = $row["date"];
                        ?>
                            <tr>
                                <td><?php echo $db_first_name  ?></td>
                                <td><?php echo $db_amount ?></td>
                                <td><?php echo $db_refno ?></td>
                                <td><?php echo date("F j, Y", strtotime($db_date)) ?></td>

                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Amount</th>
                            <th>Ref. No</th>
                            <th>Date</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
            <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
            <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
            <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
            <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
            <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
            <script>
                $(document).ready(function() {
                    $('#fetch_result').DataTable({
                        dom: 'Bfrtip',
                        buttons: [{
                            extend: 'print'
                        }]
                    });
                });
            </script>
        </div>
    </body>

    </html>
<?php
else :
    @include "../error.php";
endif;
?>
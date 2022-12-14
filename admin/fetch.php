<?php
include("../connections.php");

//Fetch Index Summary /Applicants
$result = mysqli_query($connections, "SELECT COUNT(*) AS `count` FROM tenants WHERE status='pending'");
$row = mysqli_fetch_assoc($result);
$pending = $row['count'];

//Fetch Index Summary /Tenants
$result = mysqli_query($connections, "SELECT COUNT(*) AS `count` FROM tenants WHERE status='active'");
$row = mysqli_fetch_assoc($result);
$tenants = $row['count'];

//Fetch Users user_name/ 
$get_record = mysqli_query($connections, "SELECT * FROM users WHERE id='$user_id' ");
while ($row = mysqli_fetch_assoc($get_record)) {
    $db_username = $row["username"];
    $db_id = $row["user_id"];
}

// fetch user logs
$get_logs = mysqli_query($connections, "SELECT * FROM logs");

// fetch profile
$get_profile = mysqli_query(
    $connections,
    "SELECT users.username, users.date, coordinators.first_name, coordinators.last_name 
    FROM users JOIN coordinators ON coordinators.user_id = users.user_id"       
);

// Fetch applicants
$get_applicants = mysqli_query($connections, "SELECT * FROM tenants WHERE status='pending'");
// Fetch Applicants Info

<?php
session_start();

include "./connectDB.php";

$sql = "DELETE FROM tbl_resumes WHERE student_id=?";

$stmt = mysqli_stmt_init($conn);

if ( ! mysqli_stmt_prepare($stmt, $sql)) {
 
    die(mysqli_error($conn));
}

mysqli_stmt_bind_param($stmt, "s", $_SESSION["student_id"]);

mysqli_stmt_execute($stmt);

header("location: resumes.php");
exit;

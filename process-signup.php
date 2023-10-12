<?php

if (empty($_POST["stud_username"])) {
    die("Name is required");
}

if ( ! filter_var($_POST["stud_email"], FILTER_VALIDATE_EMAIL)) {
    die("Valid email is required");
}

if (strlen($_POST["stud_password"]) < 8) {
    die("Password must be at least 8 characters");
}

if ( ! preg_match("/[a-z]/i", $_POST["stud_password"])) {
    die("Password must contain at least one letter");
}

if ( ! preg_match("/[0-9]/", $_POST["stud_password"])) {
    die("Password must contain at least one number");
}

if ($_POST["stud_password"] !== $_POST["stud_password_conformation"]) {
    die("Passwords must match");
}

$password_hash = password_hash($_POST["stud_password"], PASSWORD_DEFAULT);
 
require __DIR__ . "/connectDB.php";

$sql = "INSERT INTO usr_table (stud_username,stud_email, stud_password)
        VALUES (?, ?, ?)";
        
$stmt = $conn->stmt_init();

if ( ! $stmt->prepare($sql)) {
    die("SQL error: " . $conn->error);
}

$stmt->bind_param("sss",
                  $_POST["stud_username"],
                  $_POST["stud_email"],
                  $password_hash);
                  
if ($stmt->execute()) {

    header("Location: signup-success.html");
    exit;
    
} else {
    
    if ($conn->errno === 1062) {
        die("email already taken");
    } else {
        die($conn->error . " " . $conn->errno);
    }
}
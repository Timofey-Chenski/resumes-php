<?php
session_start();
include "./connectDB.php";

$fname = $_POST["firstname"];
$sname = $_POST["surname"]; 
$patronymic = $_POST["patronymic"];
$date_birth = $_POST["date_birth"];
$current_city = $_POST["current_city"];
$citizenship = $_POST["citizenship"];
$email = $_POST["email"];
$phone = $_POST["phone"];
$beginning_work = $_POST["beginning_work"];
$end_work = $_POST["end_work"];
$job_title = $_POST["job_title"];
$company = $_POST["company"];
$responsibilities = $_POST["responsibilities"];
$name_institution = $_POST["name_institution"];
$level_education = $_POST["level_education"];
$faculty = $_POST["faculty"];
$speciality = $_POST["speciality"];
$year_graduation = $_POST["year_graduation"];
$course_name = $_POST["course_name"];
$host_organization = $_POST["host_organization"];
$course_end_year = $_POST["course_end_year"];
$choose_language = $_POST["choose_language"];
$proficiency_level = $_POST["proficiency_level"];
$skill_description = $_POST["skill_description"];
$quality = $_POST["quality"];
$activity_name = $_POST["activity_name"];
$year_activity = $_POST["year_activity"];
$activity_course = $_POST["activity_course"];
$activity_description = $_POST["activity_description"];
$publication_title = $_POST["publication_title"];
$publication_month = $_POST["publication_month"];
$publication_year = $_POST["publication_year"];
$about_myself = $_POST["about_myself"];

$sql = "UPDATE tbl_resumes SET first_name =?, 
                                surname=?, 
                                patronymic=?, 
                                date_birth=?,
                                current_city=?, 
                                citizenship=?, 
                                email=?, 
                                phone=?, 
                                beginning_work=?, 
                                end_work=?, 
                                job_title=?, 
                                company=?, 
                                responsibilities=?, 
                                name_institution=?, 
                                level_education=?, 
                                faculty=?, 
                                speciality=?, 
                                year_graduation=?, 
                                course_name=?, 
                                host_organization=?, 
                                course_end_year=?, 
                                choose_language=?, 
                                proficiency_level=?, 
                                skill_description=?, 
                                quality=?, 
                                activity_name=?, 
                                year_activity=?, 
                                activity_course=?, 
                                activity_description=?, 
                                publication_title=?, 
                                publication_month=?, 
                                publication_year=?, 
                                about_myself=? WHERE student_id=?";

$stmt = mysqli_stmt_init($conn);

if ( ! mysqli_stmt_prepare($stmt, $sql)) {
 
    die(mysqli_error($conn));
}


mysqli_stmt_bind_param(
    $stmt,
    "ssssssssssssssssssssssssssssssssss",
    $fname,
    $sname,
    $patronymic,
    $date_birth,
    $current_city,
    $citizenship,
    $email,
    $phone,
    $beginning_work,
    $end_work,
    $job_title,
    $company,
    $responsibilities,
    $name_institution,
    $level_education,
    $faculty,
    $speciality,
    $year_graduation,
    $course_name,
    $host_organization,
    $course_end_year,
    $choose_language,
    $proficiency_level,
    $skill_description,
    $quality,
    $activity_name,
    $year_activity,
    $activity_course,
    $activity_description,
    $publication_title,
    $publication_month,
    $publication_year,
    $about_myself,
    $_SESSION["student_id"]
);
mysqli_stmt_execute($stmt);
header("location: resumes.php");
?>
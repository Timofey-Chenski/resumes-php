<?php
session_start();
include "./connectDB.php";
include "./dompdf/vendor/autoload.php";
use Dompdf\Dompdf;
use Dompdf\Options;
$options = new Options;
$options->set('defaultFont', 'DejaVu Sans');
$options->setChroot(__DIR__);

$sql = sprintf("SELECT * FROM tbl_resumes
        WHERE student_id = '%s'", $_SESSION["student_id"]);

$auth_result = $conn->query($sql);
$data = $auth_result->fetch_assoc();

$name = $data["first_name"];
$lname = $data["surname"];
$patronymic = $data["patronymic"];
$date_birth = $data["date_birth"];
$current_city = $data["current_city"];
$citizenship = $data["citizenship"];
$email = $data["email"];
$phone = $data["phone"];
$beginning_work = $data["beginning_work"];
$end_work = $data["end_work"];
$job_title = $data["job_title"];
$company = $data["company"];
$responsibilities = $data["responsibilities"];
$name_institution = $data["name_institution"];
$level_education = $data["level_education"];
$faculty = $data["faculty"];
$speciality = $data["speciality"];
$year_graduation = $data["year_graduation"];
$course_name = $data["course_name"];
$host_organization = $data["host_organization"];
$course_end_year = $data["course_end_year"];
$choose_language = $data["choose_language"];
$proficiency_level = $data["proficiency_level"];
$skill_description = $data["skill_description"];
$quality = $data["quality"];
$activity_name = $data["activity_name"];
$year_activity = $data["year_activity"];
$activity_course = $data["activity_course"];
$activity_description = $data["activity_description"];
$publication_title = $data["publication_title"];
$publication_month = $data["publication_month"];
$publication_year = $data["publication_year"];
$about_myself = $data["about_myself"];

$dompdf = new Dompdf($options);
$dompdf->setPaper("A4","letter");

$html = file_get_contents("template.html");
$html = str_replace("{{ name }}", $name, $html);
$html = str_replace("{{ lname }}", $lname, $html);
$html = str_replace("{{ patronymic }}", $patronymic , $html);
$html = str_replace("{{ date_birth }}", $date_birth , $html);
$html = str_replace("{{ current_city }}", $current_city , $html);
$html = str_replace("{{ citizenship }}", $citizenship , $html);
$html = str_replace("{{ email }}", $email , $html);
$html = str_replace("{{ phone }}", $phone , $html);
$html = str_replace("{{ beginning_work }}", $beginning_work , $html);
$html = str_replace("{{ end_work }}", $end_work , $html);
$html = str_replace("{{ job_title }}", $job_title , $html);
$html = str_replace("{{ company }}", $company , $html);
$html = str_replace("{{ responsibilities }}", $responsibilities , $html);
$html = str_replace("{{ name_institution }}", $name_institution , $html);
$html = str_replace("{{ level_education }}", $level_education , $html);
$html = str_replace("{{ faculty }}", $faculty , $html);
$html = str_replace("{{ speciality }}", $speciality , $html);
$html = str_replace("{{ year_graduation }}", $year_graduation, $html);
$html = str_replace("{{ course_name }}", $course_name, $html);
$html = str_replace("{{ host_organization }}", $host_organization, $html);
$html = str_replace("{{ course_end_year }}", $course_end_year, $html);
$html = str_replace("{{ choose_language }}", $choose_language, $html);
$html = str_replace("{{ proficiency_level }}", $proficiency_level, $html);
$html = str_replace("{{ skill_description }}", $skill_description, $html);
$html = str_replace("{{ quality }}", $quality, $html);
$html = str_replace("{{ activity_name }}", $activity_name, $html);
$html = str_replace("{{ year_activity }}", $year_activity, $html);
$html = str_replace("{{ activity_course }}", $activity_course, $html);
$html = str_replace("{{ activity_description }}", $activity_description, $html);
$html = str_replace("{{ publication_title }}", $publication_title, $html);
$html = str_replace("{{ publication_month }}", $publication_month, $html);
$html = str_replace("{{ publication_year }}", $publication_year, $html);
$html = str_replace("{{ about_myself }}", $about_myself, $html);


$dompdf->loadHtml($html);
$dompdf->render();

$dompdf->stream("myresume.pdf",["Attachment" => 0]);

?>